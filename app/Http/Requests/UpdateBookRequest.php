<?php

namespace App\Http\Requests;

class UpdateBookRequest extends BaseRequest
{
    public function prepareForValidation(): void
    {
        $sections = $this->input('sections') ?? [];

        foreach ($sections as $key => $value) {
            if(is_null($value))
                unset($sections[$key]);
        }

        $this->merge(['sections' => $sections]);
    }

    public function rules(): array
    {
        return [
            'author_id' => 'numeric|nullable',
            'name' => 'string|required',
            'year' => 'numeric|required|digits:4',
            'description' => 'string|max:500|required',
            'cover' => 'file|max:500|mimes:jpg,jpeg,png|nullable',
        ];
    }
}
