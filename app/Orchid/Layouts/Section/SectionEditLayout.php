<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Section;

use App\Models\Section;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class SectionEditLayout extends Rows
{
    public function fields(): array
    {
        return [
            Input::make('section.name')
                ->type('text')
                ->maxlength(150)
                ->required()
                ->title(__('Name')),

            TextArea::make('section.description')
                ->rows(10)
                ->maxlength(500)
                ->required()
                ->title(__('Description')),
        ];
    }
}
