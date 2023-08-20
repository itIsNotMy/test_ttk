<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Section;

use App\Models\Author;
use App\Models\Section;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SectionListLayout extends Table
{

    public $target = 'section';

    public function columns(): array
    {
        return [
            TD::make('name', __('Name')),

            TD::make('description', __('Description')),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Section $section) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.section.edit', $section->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Are you sure?'))
                            ->method('remove', [
                                'section' => $section->id,
                            ]),
                    ])),
        ];
    }
}
