<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprunt extends Model
{
    use HasFactory;

    /**
     * Obtient l'utilisateur associé à l'emprunt.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtient le livre associé à l'emprunt.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
