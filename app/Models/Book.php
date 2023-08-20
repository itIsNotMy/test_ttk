<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Screen\AsMultiSource;

class Book extends Model
{
    use HasFactory, AsMultiSource;

    protected $guarded = ['id'];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
