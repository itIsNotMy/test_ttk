<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use App\Models\Book;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BookListLayout extends Table
{

    public $target = 'books';

    public function columns(): array
    {
        return [
            TD::make('name', __('Name')),

            TD::make('year', __('Year')),

            TD::make('description', __('Description')),

            TD::make('cover', __('Cover'))
                ->render(fn (Book $book) => '<img style=width:50px; src=' . asset($book->cover) . ' />'),

            TD::make('author.full_name', __('Author')),

            TD::make('sections', __('Sections'))
                ->render(function(Book $book) {
                    $sectionsName = '';

                    $sectionsArray = $book->sections->toArray();

                    foreach ($book->sections as $key => $section) {
                        if ($book->sections->last()->id === $section->id) {
                            $sectionsName .= $section->name;
                        } else {
                            $sectionsName .= $section->name . ', ';
                        }
                    }

                    return $sectionsName;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Book $book) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.book.edit', $book->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Are you sure?'))
                            ->method('remove', [
                                'book' => $book->id,
                            ]),
                    ])),
        ];
    }
}
