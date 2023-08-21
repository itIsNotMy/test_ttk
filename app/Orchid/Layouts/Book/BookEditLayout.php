<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use App\Models\Author;
use App\Models\Section;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class BookEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('book.cover')
                ->required(! $this->query->get('book')->cover)
                ->type('file')
                ->title(__('Cover'))
                ->placeholder(__('Cover')),

            Input::make('book.name')
                ->type('text')
                ->max(150)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('book.year')
                ->type('text')
                ->maxlength(4)
                ->required()
                ->title(__('Year'))
                ->placeholder(__('Year')),

            TextArea::make('book.description')
                ->required()
                ->rows(10)
                ->max(2000)
                ->title(__('Description'))
                ->placeholder(__('Description')),

            Relation::make('book.author_id')
                ->fromModel(Author::class, 'full_name')
                ->allowEmpty()
                ->title(__('Author')),

            Relation::make('book.sections')
                ->fromModel(Section::class, 'name')
                ->multiple()
                ->allowEmpty()
                ->title(__('Section')),
        ];
    }
}
