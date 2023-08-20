<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Book;

use App\Models\Book;
use App\Orchid\Layouts\Book\BookListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class BookListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'books' => Book::query()
                ->with(['author', 'sections'])
                ->paginate(10),
        ];
    }

    public function name(): ?string
    {
        return 'Book list';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('platform.book.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            BookListLayout::class,
        ];
    }

    public function remove(Book $book, Request $request): void
    {
        $book->delete();

        Toast::info(__('Book was removed'));
    }
}
