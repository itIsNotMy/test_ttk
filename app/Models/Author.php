<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Screen\AsMultiSource;

class Author extends Model
{
    use HasFactory, AsMultiSource;

    protected $guarded = ['id'];

    public function book(): HasOne
    {
        return $this->hasOne(Book::class);
    }
}
