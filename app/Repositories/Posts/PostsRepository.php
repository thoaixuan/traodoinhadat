<?php
namespace App\Repositories\Posts;

use App\Models\Follows;
use App\Repositories\EloquentRepository;
use App\Models\Posts;
use App\Models\Tags;
use App\Views\PostsView;
use App\Models\Categorys;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use DOMDocument;
use voku\helper\HtmlDomParser;
use Carbon\Carbon;
class PostsRepository  extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Posts::class;
    }
    public function getPostPageHome($request)
    {
        $result =  PostsView::orderBy('id','desc')->paginate(setting()->post_page_number);
        // dd();
        return $result;
    }
    public function getWeekPost($limit =10)
    {
        $now = Carbon::now();
        $start = $now->startOfWeek()->format('Y-m-d');
        $end = $now->endOfWeek()->format('Y-m-d');
        $result =  PostsView::orderBy('id','desc')->whereBetween('created_at',[$start,$end])->where('post_status','=','published')->limit($limit)->get();
        return $result;
    }
    public function getSharePost($limit =10)
    {
        $result =  PostsView::orderBy('post_share','desc')->where('post_status','=','published')->limit($limit)->get();
        return $result;
    }

    public function randomPosts($limit =10)
    {
        $result =  PostsView::where('post_status','=','published')->inRandomOrder()->take($limit)->get();
        return $result;
    }
    public function getPostHots($limit=10)
    {
        $result =  PostsView::where('post_view_type','=','POST')
        ->where('post_status_hot','=','on')
        ->where('post_status','=','published')
        ->limit($limit)
        ->get();
        return $result ;
    }
    public function getPostList($request)
    {
        $where = array(
            ['post_view_type','=',"POST"],
            ['post_status','=',$request->post_status]
        );
        if($request->post_status=='hot'){
            unset($where[1]);
            $where[]=['post_status','=','published'];
            $where[]=['post_status_hot','=','on'];
        }

        if(isset($request->c)&&!empty($request->c)){
            $cate =  Categorys::where('id','=',$request->c)->first();
            $whereIn = array();
            if($cate->cate_parentID==null){
                $catesID = Categorys::where('cate_parentID','=',$cate->id)->pluck('id')->toArray();
                if(count($catesID)>0){
                    $whereIn = $catesID;
                }else{
                    $whereIn[]=$request->c;
                }
            }else{
                $whereIn[]=$request->c;
            }

            if(!empty($request->q)){
                $search = $request->q;
                $result =  PostsView::where($where)
                ->whereIn('category_id',$whereIn)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('post_title', 'LIKE',"%{$search}%");
                })
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
            }else{
                $result =  PostsView::where($where)
                ->whereIn('category_id',$whereIn)
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
            }

        }else{
            if(!empty($request->q)){
                $search = $request->q;
                $result =  PostsView::where($where)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('post_title', 'LIKE',"%{$search}%");
                })
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
            }else{
                $result =  PostsView::where($where)
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
            }
        }
    }

    public function getPostByID($request)
    {
        $result = Posts::where('id','=',$request->id)->first();
        if($result)return $result ;
        return false;
    }
    public function updatePost($request)
    {
        $post =  Posts::where('id','=',$request->id)->first();
        if(!$post)return false;
        $post->post_title = $request->post_title;
        $category_id = $request->category_id;
        if($request->category_sub_id!=""){
            $category_id =  $request->category_sub_id;
        }
        $path = $this->uploadImage($request,'update');
        if($path->post_image_max&&$path->post_image_min){
            $post->post_image_max = $path->post_image_max;
            $post->post_image_min = $path->post_image_min;
        }
        $post->category_id = $category_id;
        $post->post_slug = $this->getSlug($request,'update');
        $post->post_status = $request->post_status;
        $post->post_des = $request->post_des;
        $post->post_keywords = $request->post_keywords;
        if($post->save()){
            $request['user_id']= $post->user_id;
            $this->uploadImageContent($request,'update');
            return true;
        }return false;
    }
    public function insertPost($request)
    {
        $post = new Posts();
        $post->user_id = user()->id;
        $post->post_title = $request->post_title;
        $category_id = $request->category_id;
        if($request->category_sub_id!=""){
            $category_id =  $request->category_sub_id;
        }
        $path = $this->uploadImage($request,'insert');
        if($path->post_image_max&&$path->post_image_min){
            $post->post_image_max = $path->post_image_max;
            $post->post_image_min = $path->post_image_min;
        }
        $post->category_id = $category_id;
        $post->post_slug = $this->getSlug($request,'insert');
        $post->post_status = $request->post_status;
        $post->post_des = $request->post_des;
        $post->post_keywords = $request->post_keywords;
        $post->post_time = time();
        $post->save();
        if($post){
            $request['id']= $post->id;
            $request['user_id']= $post->user_id;
            $this->uploadImageContent($request,'insert');
            return true;
        }return false;
    }

    public function uploadImage($request,$type)
    {
        $row = new \stdClass;
        $max_path  = "/uploads/_posts/max";
        $min_path  = "/uploads/_posts/min";
        $file      = $request->file('file_post_image');
        if($type=='insert'){
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $picture   = time().uniqid().'.'.$extension;
                $max = Image::make($file);
                $max->save(public_path("{$max_path}/{$picture}"));
                $min = Image::make($file);
                $min->resize(1017,620);
                $min->save(public_path("{$min_path}/{$picture}"));
                $row->post_image_max ="{$max_path}/{$picture}";
                $row->post_image_min ="{$min_path}/{$picture}";
                return  $row;
            }
            $row->post_image_max =false;
            $row->post_image_min =false;
            return $row;
        }else{
            $result =  Posts::find($request->id);
            if ($file) {
                if (file_exists(public_path($result->post_image_max))) {
                    \File::delete(public_path($result->post_image_max));
                }
                if (file_exists(public_path($result->post_image_min))) {
                    \File::delete(public_path($result->post_image_min));
                }
                $extension = $file->getClientOriginalExtension();
                $picture   =  time().uniqid().'.'.$extension;
                $max = Image::make($file);
                $max->save(public_path("{$max_path}/{$picture}"));
                $min = Image::make($file);
                $min->resize(1017,620);
                $min->save(public_path("{$min_path}/{$picture}"));
                $row->post_image_max ="{$max_path}/{$picture}";
                $row->post_image_min ="{$min_path}/{$picture}";
                return  $row;
            }
            $row->post_image_max =false;
            $row->post_image_min =false;
            return $row;
        }
        $row->post_image_max =false;
        $row->post_image_min =false;
        return $row;
    }
    public function uploadImageContent($request,$type)
    {
        $postID = $request->id;
        $userID = $request->user_id;
        $FOLDER  = "/uploads/posts/postID{$postID}";

        $post_content= $request->post_content;

        $dom = HtmlDomParser::str_get_html($post_content);
        $images = $dom->getElementsByTagName('img');
        $arrayImage = [];
        if($type=='insert'){
            \File::makeDirectory(public_path($FOLDER));
        }
        foreach($images as $img){
            $src = $img->getAttribute('src');
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid().$postID;
                $filepath = "{$FOLDER}/$filename.$mimetype";

                // @see http://image.intervention.io/api/
                Image::make($src)
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)
                  ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $arrayImage[] = $filename.".".$mimetype;
            }else{
                if($src!=""){
                    $src = explode("/",$src);
                    $srcIndex = count($src);
                    $arrayImage[]=$src[$srcIndex-1];
                }
            }
        }

        $this->removeFileImageContent($FOLDER,collect($arrayImage));
        $post =  Posts::where('id','=',$request->id)->first();

        $post->post_content = $dom->save();
        // dd($post);
        $post->save();

    }
    public function removeFileImageContent($FOLDER,$arrayImage)
    {

        $path = public_path($FOLDER);
        $files = \File::allFiles($path);
        foreach($files as $item){
            if($arrayImage->contains($item->getFileName())==false){
                \File::delete($item->getPathname());
            }
        }
    }
    public function getSlug($request,$type)
    {
        if($type=='update'){
            $count = Posts::where('post_slug','=',to_slug($request->post_title))->where('id','!=',$request->id)->count();
            if($count>0) return SlugService::createSlug(Posts::class, 'post_slug', $request->post_title,['unique' => true]);
            return false;
        }else{
            return SlugService::createSlug(Posts::class, 'post_slug', $request->post_title,['unique' => true]);
        }
    }
    public function getPostSingleBySlug($post_slug)
    {

        $result =  PostsView::where('post_slug','=',$post_slug)
        ->where('post_status','=','published')
        ->first();
        if( $result){
            $previous = PostsView::where('id', '<', $result->id)->orderBy('id','desc')->first();
            $next = PostsView::where('id', '>', $result->id)->orderBy('id')->first();
            $result->previous = $previous;
            $result->next = $next;
        }
        if($result){
            $this->updatePostView($result->id);
        }

        return $result;
    }
    public function updatePostView($postID)
    {
        $Post = Posts::find($postID);
        $Post->post_view = $Post->post_view+1;
        if($Post->save())return true;
        return false;
    }
    public function getPostByCategoryID($cate)
    {
        if($cate->cate_parentID==null){
            $catesID = Categorys::where('cate_parentID','=',$cate->id)->pluck('id')->toArray();
            if(count($catesID)>0){
                $result =  PostsView::whereIn('category_id',$catesID)
                ->where('post_status','=','published')
                ->where('post_status_admin','=','published')
                ->orderBy('id','desc')
                ->paginate(setting()->post_page_number);
                return $result;
            }else{
                $result =  PostsView::where('category_id','=',$cate->id)
                ->where('post_status','=','published')
                ->where('post_status_admin','=','published')
                ->orderBy('id','desc')
                ->paginate(setting()->post_page_number);
                return $result;
            }

        }else{
           $result =  PostsView::where('category_id','=',$cate->id)
            ->where('post_status','=','published')
            ->where('post_status_admin','=','published')
            ->orderBy('id','desc')
            ->paginate(setting()->post_page_number);
            return $result;
        }

    }
    public function postStatusHot($request)
    {
        $result =  Posts::find($request->id);
        if($result){
            if($result->post_status_hot=='on'){
                $result->post_status_hot = 'off';
            }else{
                $result->post_status_hot = 'on';
            }
            if($result->save())return true;
            return false;
        }return false;
    }
    public function getSearchPost($request)
    {
        $search = $request->q;
        if($search!=""){
            $posts = PostsView::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('post_title', 'LIKE',"%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('full_name','LIKE',"%{$search}%");
            })
            ->where('post_status','=','published')
            ->orderBy('created_at','desc')
            ->paginate(setting()->post_page_number);
            $posts->withPath(\URL::current()."?q=$request->q");
            return $posts;
        }else{
            return [];
        }

    }
}
