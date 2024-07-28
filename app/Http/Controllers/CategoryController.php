<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }
    
    public function index2()
    {
        $categories = Category::all();
        return view('tabelCategories', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $inputan = $request->inputan;
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if($inputan == 'input'){
            $category = Category::create($request->all());
            return response()->json(['success' => 'Category created successfully.', 'category' => $category]);
        }elseif($inputan == "update"){
            $category->where('id', $request->id)->update([
                'name' => $request->name,
            ]);
            return response()->json(['success' => 'Category updated successfully.']);
        }   
        
       
    }

    public function destroy(Request $request, Category $category)
    {
        $category->where('id', $request->id)->delete();

        return response()->json(['success' => 'Category deleted successfully.']);
    }

    public function viewEdit(Request $request)
    {
    $r_data = Category::where('ID', $request->id)->get();
    return response()->json($r_data, 200);
    }
}
