<?php
namespace App\Repositories\Contact;

use App\Repositories\EloquentRepository;
use App\Models\Contact;
use Cviebrock\EloquentSluggable\Services\SlugService;
class ContactRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Contact::class;
    }
    public function sendService($request)
    {
        $Contact = new Contact();
        $Contact->full_name = $request->full_name;
        $Contact->email = $request->email;
        $Contact->title = $request->title;
        $Contact->phone = $request->phone;
        $Contact->body = $request->body;
        $Contact->type_contact = $request->type_contact;
        if($Contact->save()){
            return true;
        }return false;
    }
    public function sendContact($request)
    {
        $Contact = new Contact();
        $Contact->full_name = $request->full_name;
        $Contact->email = $request->email;
        $Contact->title = $request->title;
        $Contact->phone = $request->phone;
        $Contact->body = $request->body;
        if($Contact->save()){
            if(setting()->contact_status=='on'){
                $this->senMail($request);
            }
            return true;
        }return false;
    }
    public function datLichTuVan($request)
    {

        $Contact = new Contact();
        $Contact->type_contact = 'tu_van';
        $Contact->full_name = $request->full_name;
        $Contact->email = $request->email;
        $Contact->phone = $request->phone;
        $Contact->date = $request->date;
        $Contact->realestate_id = intval($request->realestate_id);
        if($Contact->save()){
            if(setting()->contact_status=='on'){
                $this->senMailDatLichTuVan($request);
            }
            return true;
        }return false;
    }
    public function senMailDatLichTuVan($request)
    {
        configMail();
        $rs =  _sendMail([
            "template"=>"web.pages.contact.template-tuvan",
            "data"=>[
                "full_name"=>$request->full_name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "date"=>$request->date,
                "link"=>$request->link,
                "realestate_title"=>$request->realestate_title,
            ],
            "mailSend"=>[setting()->MAIL_RECEIVE],
            "subject"=>"ĐẶT LỊCH TƯ VẤN"
        ]);

    }
    public function senMail($request)
    {
        configMail();
        $rs =  _sendMail([
            "template"=>"web.pages.contact.template",
            "data"=>[
                "full_name"=>$request->full_name,
                "title"=>$request->title,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "body"=>$request->body,
            ],
            "mailSend"=>[setting()->MAIL_RECEIVE],
            "subject"=>"MAIL LIÊN HỆ"
        ]);

    }
    public function getContactList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Contact::leftjoin('realestate_view','realestate_view.id','=','contact.realestate_id')
            ->Where(function($query)use($search){
                $query->where('contact.id', 'LIKE', "%{$search}%")
                ->orWhere('contact.full_name', 'LIKE',"%{$search}%")
                ->orWhere('contact.email', 'LIKE',"%{$search}%")
                ->orWhere('contact.body', 'LIKE',"%{$search}%")
                ->orWhere('contact.date', 'LIKE',"%{$search}%")
                ->orWhere('contact.created_at', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->select('contact.*',
             'realestate_view.cate_type',
             'realestate_view.cate_slug',
             'realestate_view.province_slug',
             'realestate_view.district_slug',
             'realestate_view.ward_slug',
             'realestate_view.realestate_slug',
             'realestate_view.realestate_title'
            )
            ->orderBy('id','desc')
            ->paginate(10);
            return $result;
        }else{
            $result =  Contact::leftjoin('realestate_view','realestate_view.id','=','contact.realestate_id')
            ->select('contact.*',
             'realestate_view.cate_type',
             'realestate_view.cate_slug',
             'realestate_view.province_slug',
             'realestate_view.district_slug',
             'realestate_view.ward_slug',
             'realestate_view.realestate_slug',
             'realestate_view.realestate_title'
            )
            ->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            return $result;
        }

    }
    public function deleteContact($request)
    {
        $Contact = Contact::find($request->id);
        if($Contact->delete()){
            return true;
        }return false;
    }
    public function statusContact($request)
    {
        $result =  Contact::find($request->id);
        if($result){
            $result->status = 'on';
            if($result->save())return true;
            return false;
        }return false;
    }

}
