<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Author;

use App\Models\Author;
use App\Orchid\Layouts\Author\AuthorListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AuthorListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'author' => Author::query()->paginate(10),
        ];
    }

    public function name(): ?string
    {
        return 'Author list';
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
                ->route('platform.author.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            AuthorListLayout::class,
        ];
    }

    public function remove(Author $author, Request $request): void
    {
        $author->delete();

        Toast::info(__('Author was removed'));
    }
}
