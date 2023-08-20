<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Book;

use App\Http\Requests\CreateBookAdminRequest;
use App\Models\Book;
use App\Orchid\Layouts\Book\BookEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use function Laravel\Prompts\error;

class BookEditScreen extends Screen
{
    public $book = null;

    public function query(Book $book): iterable
    {
        return [
            'book' => $book,
        ];
    }

    public function name(): ?string
    {
        return $this->book->exists ? 'Edit Book' : 'Create Book';
    }

    public function permission(): ?iterable
    {
        return [];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Back'))
                ->icon('bg.box-arrow-in-right')
                ->route('platform.book'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            BookEditLayout::class
        ];
    }

    public function save(Book $book, CreateBookAdminRequest $request): void
    {
        $bookRequest = $request->input('book');

        if(! is_null($request->file('book.cover'))) {
            $bookRequest['cover'] = $request->file('book.cover')->store('covers');
        }

        $book->fill($bookRequest)->save();

        $book->sections()->detach();

        $book->sections()->attach($request->input('book.sections'));

        Toast::info(__('Book save'));
    }
}
