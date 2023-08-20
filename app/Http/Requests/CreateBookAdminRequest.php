<?php

namespace App\Http\Requests;

class CreateBookAdminRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'book.name' => 'string',
            'book.year' => 'numeric|digits:4',
            'book.description' => 'string|max:500',
            'book.cover' => 'file|max:500|mimes:jpg,jpeg,png',
        ];
    }
}
