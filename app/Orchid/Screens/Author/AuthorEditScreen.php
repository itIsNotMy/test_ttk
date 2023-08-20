<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Author;

use App\Models\Author;
use App\Orchid\Layouts\Author\AuthorEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AuthorEditScreen extends Screen
{
    public $author = null;

    public function query(Author $author): iterable
    {
        return [
            'author' => $author,
        ];
    }

    public function name(): ?string
    {
        return $this->author->exists ? 'Edit Author' : 'Create Author';
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
                ->route('platform.author'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            AuthorEditLayout::class
        ];
    }

    public function save(Author $author, Request $request): void
    {
        $authorRequest = $request->input('author');

        $author->fill($authorRequest)->save();

        Toast::info(__('Author save'));
    }
}
