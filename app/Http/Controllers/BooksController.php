<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
    // Відображення списку книг
    public function index()
    {
        $books = Books::all();
        return view('books.index', compact('books'));
    }

    // Відображення форми для створення нової книги
    public function create()
    {
        return view('books.create');
    }

    // Збереження нової книги
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'cover_image_url' => 'nullable|url',
            'comment' => 'nullable|string',
            'description' => 'required|string',
            'language' => 'required|string|max:255',
            'age_recommendation' => 'nullable|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:9999',
        ]);

        Books::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Відображення конкретної книги
    public function show($id)
    {
        $book = Books::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Відображення форми для редагування конкретної книги
    public function edit($id)
    {
        $book = Books::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Оновлення конкретної книги
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'cover_image_url' => 'nullable|url',
            'comment' => 'nullable|string',
            'description' => 'required|string',
            'language' => 'required|string|max:255',
            'age_recommendation' => 'nullable|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:9999',
        ]);

        $book = Books::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Видалення конкретної книги
    public function destroy($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
