<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Section;

use App\Models\Section;
use App\Orchid\Layouts\Section\SectionListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SectionListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'section' => Section::query()->paginate(10),
        ];
    }

    public function name(): ?string
    {
        return 'Section list';
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
                ->route('platform.section.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            SectionListLayout::class,
        ];
    }

    public function remove(Section $section, Request $request): void
    {
        $section->delete();

        Toast::info(__('Section was removed'));
    }
}
