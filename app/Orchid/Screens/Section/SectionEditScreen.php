<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Section;

use App\Models\Section;
use App\Orchid\Layouts\Section\SectionEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SectionEditScreen extends Screen
{
    public $section = null;

    public function query(Section $section): iterable
    {
        return [
            'section' => $section,
        ];
    }

    public function name(): ?string
    {
        return $this->section->exists ? 'Edit Section' : 'Create Section';
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
                ->route('platform.section'),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            SectionEditLayout::class
        ];
    }

    public function save(Section $section, Request $request): void
    {
        $sectionRequest = $request->input('section');

        $section->fill($sectionRequest)->save();

        Toast::info(__('Section save'));
    }
}
