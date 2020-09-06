<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\category;
use App\models\Article;
use App\models\Page;
use App\models\Contact;
use App\models\Config;
use Validator;
use Mail;


class Homepage extends Controller
{
    public function __construct(){
        if(Config::find(1)->active==0){
            return redirect()->to('aktiv-deyil')->send();
        }
        view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->InRandomOrder()->get());
    }

    public function index(){
        $data['articles']=Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(10);
        $data['articles']->withPath(url('sehife'));
        return view('front.homepage',$data);
    }

public function single($category,$slug){
    $category=Category::whereSlug($category)->first() ?? abort(403,'Belə bir kateqoriya tapılmadı');
    $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Belə bir yazı tapılmadı');
    $article->increment('hit');
    $data['article']=$article;
    $data['categories']=Category::InRandomOrder()->get();
       return view('front.single',$data);
}    
public function category($slug){
    $category=Category::whereSlug($slug)->first() ?? abort(403,'Belə bir kateqoriya tapılmadı');
    $data['category']=$category;
    $data['articles']=Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(1);
    return view('front.category',$data);
}
public function page($slug){
    $page=Page::whereSlug($slug)->first() ?? abort(403,'Belə bir səhifə tapılmadı.');
    $data['page']=$page;
    return view('front.page',$data);
}
public function contact(){
    return view('front.contact');
}
public function contactpost(Request $request){
  $rules=[
      'name'=>'required|min:5',
      'email'=>'required|email',
      'topic'=>'required',
      'message'=>'required|min:10'
  ];
  $validate=Validator::make($request->post(),$rules);
  if($validate->fails()){
      return redirect()->route('contact')->withErrors($validate)->withInput();
  }
  Mail::send([],[],function($message)use($request){
        $message->from('rehmanblog@gmail.com','Bloq Sayti');
        $message->to('nurullayevrehman@gmail.com');
        $message->setBody('Mesajı göndərən :'.$request->name.'<br/>
        Mesajı göndərən mail:'.$request->mail.'<br/>
        Mesajı tema :'.$request->topic.'<br/>
        Mesajı :'.$request->message.'<br/><br/>
        Mesajı göndərilmə tarixi :'.now().'','text/html');
        $message->subject($request->name.'mesaj gəldi');
            });

  //$contact = new Contact;
  //$contact->name=$request->name;
  //$contact->email=$request->email;
  //$contact->topic=$request->topic;
  //$contact->message=$request->message; 
  //$contact->save();
  
  return redirect()->route('contact')->with('success','Mesajınız uğurla göndərildi.');
 }
}
