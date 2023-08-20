<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('bookcreate')->only(['create', 'store']);

        $this->middleware('bookupdate')->only(['edit', 'update']);
    }

    public function index(Request $request): Response
    {
        $search = $request->input('search');

        $books = Book::query()
            ->when(! is_null($request->input('search')), function (Builder $builder) use ($request) {
                $builder->where('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhereRelation('author', 'full_name', 'like', '%' . $request->input('search') . '%');
            })
            ->paginate(4);

        $user = auth()->user();

        return Inertia::render('Book/Index', compact('books', 'user', 'search'));
    }

    public function create(): Response
    {
        $sections = Section::all();

        $authors = Author::all();

        return Inertia::render('Book/Create', compact('sections', 'authors'));
    }

    public function store(CreateBookRequest $request): RedirectResponse
    {
        $path = $request->file('cover')->store('covers');

        $validArray = $request->validated();

        $validArray['cover'] = $path;

        $validArray['user_id'] = auth()->user()->id;

        $book = Book::query()->create($validArray);

        $book->sections()->attach($request->input('sections'));

        return redirect()->route('books.index');
    }

    public function show(Book $book): Response
    {
        $book->load(['sections', 'author']);

        return Inertia::render('Book/Show', compact('book'));
    }

    public function edit(Book $book): Response
    {
        $book->load(['sections', 'author']);

        $sections = Section::all();

        $authors = Author::all();

        foreach ($sections as $section) {
            if($book->sections()->where('id', $section->id)->exists()) {
                $section->setAttribute('use', true);

            } else {
                $section->setAttribute('use', false);

            }
        }

        return Inertia::render('Book/Edit', compact('book', 'sections', 'authors'));
    }

    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $validArray = $request->validated();

        if (is_null($request->validated('cover'))) {
            unset($validArray['cover']);

        } else {
            $path = $request->file('cover')->store('covers');

            $validArray['cover'] = $path;
        }

        $book->update($validArray);

        $book->sections()->detach();

        $book->sections()->attach($request->input('sections'));

        return redirect()->route('books.index');
    }
}
