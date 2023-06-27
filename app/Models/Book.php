<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = ['title', 'author'];

    /**
     * Obtient tous les emprunts associés au livre.
     */
    public function emprunts(): HasMany
    {
        return $this->hasMany(Emprunt::class);
    }
}
