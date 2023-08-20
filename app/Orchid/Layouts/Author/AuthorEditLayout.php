<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Author;

use App\Models\Section;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class AuthorEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('author.full_name')
                ->type('text')
                ->required()
                ->title(__('Full name')),

            Input::make('author.country')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Country')),

            TextArea::make('author.comment')
                ->rows(10)
                ->required()
                ->title(__('Comment')),
        ];
    }
}
