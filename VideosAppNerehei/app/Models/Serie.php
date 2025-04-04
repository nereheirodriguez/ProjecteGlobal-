<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image', 'user_id'];

    // Relación 1:N con Video
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    // Función testedBy
    public function testedBy($userId)
    {
        return $this->videos()->whereHas('tests', function ($query) use ($userId) {
            $query->where('tested_by', $userId);
        })->get();
    }

    // Atributo formateado created_at
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }

    // Atributo formateado para humanos created_at
    public function getFormattedForHumansCreatedAtAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    // Atributo timestamp created_at
    public function getCreatedAtTimestampAttribute(): int
    {
        return $this->created_at->timestamp;
    }
}
