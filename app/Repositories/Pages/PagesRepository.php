<?php
namespace App\Repositories\Pages;

use App\Models\Follows;
use App\Repositories\EloquentRepository;
use App\Models\Posts;
use App\Views\PostsView;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use DOMDocument;
use App\Repositories\Posts\PostsRepository;
class PagesRepository  extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Posts::class;
    }
    public function getPageList($request)
    {
        // dd(Posts::get());
        $where = array(
            ['post_view_type','=','PAGE']
        );
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Posts::where($where)
            ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('post_title', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(20);
            return $result;
        }else{
            $result =  Posts::where($where)
            ->sortable()
            ->paginate(20);

            return $result;
        }

    }
    public function getPageByID($request)
    {
        $result = Posts::where('post_view_type','=','PAGE')->where('id','=',$request->id)->first();
        if($result){
            return $result;
        }return false;
    }
    public function addPage($request)
    {
        $Posts = new PostsRepository();
        $post = new Posts();
        $post->user_id = user()->id;
        $post->post_view_type = 'PAGE';
        $post->post_title = $request->post_title;
        $post->page_link = $request->page_link;
        $post->page_link_type = $request->page_link_type;
        $post->page_status_header = $request->page_status_header;
        $post->page_status_footer = $request->page_status_footer;
        $post->post_slug = $Posts->getSlug($request,'insert');
        $post->post_status = $request->post_status;
        $post->post_des = $request->post_des;
        $post->post_keywords = $request->post_keywords;
        $post->post_time = time();
        $post->save();
        if($post){
            $request['id']= $post->id;
            $request['user_id']= $post->user_id;
            $Posts->uploadImageContent($request,'insert');
            return true;
        }return false;

    }
    public function getPageSingleBySlug($slug)
    {
        $result = Posts::where('post_view_type','=','PAGE')->where('post_slug','=',$slug)
        ->where('post_status','=','published')
        ->first();
        if($result)return $result;
        return false;
    }
    public function editPage($request)
    {
        $Posts = new PostsRepository();
        $post =  Posts::where('id','=',$request->id)->first();
        if(!$post)return false;
        $post->post_title = $request->post_title;
        $post->page_link = $request->page_link;
        $post->page_link_type = $request->page_link_type;
        $post->page_status_header = $request->page_status_header;
        $post->page_status_footer = $request->page_status_footer;
        $post->post_slug = $Posts->getSlug($request,'update');
        $post->post_status = $request->post_status;
        $post->post_des = $request->post_des;
        $post->post_keywords = $request->post_keywords;
        if($post->save()){
            $request['user_id']= $post->user_id;
            $Posts->uploadImageContent($request,'update');
            return true;
        }return false;
    }
    public function deletePage($request)
    {
        $result =  Posts::find($request->id);
        if($result->delete()){
            \File::deleteDirectory(public_path("/uploads/posts/postID".$request->id));
            return true;
        }return false;
    }
    public function statusPage($request)
    {
        $result =  Posts::find($request->id);
        if($result){
            if($result->post_status=='published'){
                $result->post_status = 'lock';
            }else{
                $result->post_status = 'published';
            }
            if($result->save())return true;
            return false;
        }return false;
    }
}
