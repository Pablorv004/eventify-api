<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'category_id',
        'start_date',
        'end_date',
        'location',
        'latitude',
        'longitude',
        'max_attendees',
        'price',
        'image_url',
        'deleted',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class);
    }
}
