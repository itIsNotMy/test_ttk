<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Author;

use App\Models\Author;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AuthorListLayout extends Table
{

    public $target = 'author';

    public function columns(): array
    {
        return [
            TD::make('full_name', __('Full name')),

            TD::make('country', __('Country')),

            TD::make('comment', __('Comment')),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Author $author) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.author.edit', $author->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Are you sure?'))
                            ->method('remove', [
                                'author' => $author->id,
                            ]),
                    ])),
        ];
    }
}
