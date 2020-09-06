<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Category;
use App\models\Article;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }
    public function create(Request $request){
        $isExist=Category::whereSlug(Str::slug($request->category))->first();
        if($isExist){
             return redirect()->back();
            
        }
        $category =  new Category;
        $category->name=$request->category;
        $category->slug=str::slug($request->$category);
        $category->save();
        return redirect()->back();
    }
    public function update(Request $request){
        $isSlug=Category::whereSlug(Str::slug($request->slug))->whereNotIn(['id',$request->id])->first();
        $isName=Category::whereName($request->category)->whereNotIn(['id',$request->id])->first();
        if($isSlug or $isName){
             return redirect()->back();
            
        }
        $category = Category::find($request->id);
        $category->name=$request->category;
        $category->slug=str::slug($request->$slug);
        $category->save();
        return redirect()->back();
    }
    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        if($category->id==1){
            return redirect()->back();
        }
        if($category->articleCount()>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
        }
        $category->delete();
        return redirect()->back();
    }

    public function switch(Request $request){
        $category=Category::findOrFail($request->id);
        $category->status=$request->statu=="true" ? 1 : 0 ;
        $category->save();    
    }
}
