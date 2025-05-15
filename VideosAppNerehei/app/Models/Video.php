<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'published_at',
        'previous',
        'next',
        'user_id',
        'serie_id'

    ];

    public function series()
    {
        return $this->belongsTo(Serie::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
    protected $dates = ['published_at'];

    public function getFormattedPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->translatedFormat('d \d\e F \d\e Y');
    }

    public function getFormattedForHumansPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    public function getPublishedAtTimestampAttribute()
    {
        return Carbon::parse($this->published_at)->timestamp;
    }
}
