<?php

namespace App\Http\Controllers\adm;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories= Category::all();
        return view('adm.categories.index',['categories'=>$categories]);
    }
    public function create(){
        return view('adm.categories.create',['categories'=>Category::all()]);
    }
    public function store(Request $request){
        $validated = $request->validate([
           'name'=>'required|max:50',
           'code'=>'required|max:15',
            'name_kz'=>'required|max:50',
            'name_ru'=>'required|max:50',
            'name_en'=>'required|max:50',
        ]);
        Category::create($validated);
        return redirect()->route('adm.categories.index',['categories'=>Category::all()])->with('Successfully','Added a new category');
    }
    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('adm.categories.index');
    }
}
