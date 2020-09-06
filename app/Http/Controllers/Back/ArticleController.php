<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Article;
use App\models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->post()); yoxlama meqsedi ile melumatlarin gelmesine baxiriq
       $request->validate([
           'title'=>'min:3'
          // 'image'=>'image|mimes:jpeg,png,jpg|max:100'
           
       ]);

       $article= new Article;
       $article->title=$request->title;
       $article->category_id=$request->category;
       $article->content=$request->content;
       $article->slug=Str::slug($request->title);

       if($request->hasFile('image')){
           $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
           $request->image->move(public_path('uploads'),$imageName);
           $article->image='uploads/'.$imageName;
       }
       $article->save();
       //toastr()->success('Uğurlu !', 'Yazı uğurla yaradıldı');
       return redirect()->route('admin.yazilar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::find($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3'
        ]);
 
        $article= Article::findOrFail($id);
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);
 
        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image='uploads/'.$imageName;
        }
        $article->save();
       // toastr()->success('Uğurlu !', 'Yazı uğurla dəyişdirildi');
        return redirect()->route('admin.yazilar.index');
    
    
    }
    public function switch(Request $request){
        $article=Article::findOrFail($request->id);
        $article->status=$request->statu=="true" ? 1 : 0 ;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){

        Article::find($id)->delete();
        return redirect()->route('admin.yazilar.index');
    }

    public function destroy($id)
    {
        
    }
    public function trashed(){
        $articles=Article::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.articles.trashed',compact('articles'));
    }
    public function recover($id){
        Article::onlyTrashed()->onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }
    public function hardDelete($id){
        $article=Article::onlyTrashed()->find($id);
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        return redirect()->back();
    }
}
