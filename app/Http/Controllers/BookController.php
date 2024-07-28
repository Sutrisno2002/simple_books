<?php
// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->with('category')->get();
        $categories = Category::all();

        return view('books', compact('books', 'categories'));
    }

    public function index2(Request $request)
    {
        $query = Book::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->with('category')->get();
        $categories = Category::all();

        return view('tabelBook', compact('books', 'categories'));
       
    }

    public function indexFilter(Request $request, Book $book)
    {
        $query = Book::query();
        if ($request->has('category_id') && $request->category_id != "semua") {
            $query->where('category_id', $request->category_id);
        }

        $categories = Category::all();
        $books = $query->with('category')->get();


        return view('tabelBook', compact('books', 'categories'));
       
    }

    public function viewEdit(Request $request)
    {
    $r_data = Book::where('id', $request->id)->get();
    return response()->json($r_data, 200);
    }


    public function store(Request $request, Book $book)
    {
        $inputan = $request->inputan;
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
        ]);
        if($inputan == 'input'){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book = Book::create($data);

        return response()->json(['success' => 'Book created successfully.', 'book' => $book]);
        }elseif($inputan == "update"){
            $data = [
                'title' => $request->title,
                'author' => $request->author,
                'category_id' => $request->category_id,
            ];
            if ($request->hasFile('image')) {
                if ($book->image) {
                    \Storage::delete($book->image);
                }
                $data['image'] = $request->file('image')->store('books', 'public');
            } else {
                unset($data['image']);
            }
    
            $book->where('id', $request->id)->update($data
            );
    
            return response()->json(['success' => 'Book updated successfully.']);
        }

    }

    public function destroy(Request $request, Book $book)
    {
        if ($book->image) {
            \Storage::delete($book->image);
        }
        $book->where('id', $request->id)->delete();

        return response()->json(['success' => 'Book deleted successfully.']);
    }
}
