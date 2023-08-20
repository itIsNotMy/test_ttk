<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Screen\AsMultiSource;

class Section extends Model
{
    use HasFactory, AsMultiSource;

    protected $guarded = ['id'];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
