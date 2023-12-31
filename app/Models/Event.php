<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','date', 'image', 'description'
    ];

    public function panels()
    {
        return $this->hasMany(Panel::class);
    }

    public function images()
    {
        return $this->hasOne(Attachment::class, 'id', 'image')->withDefault();
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (int)$value[0],
        );
    }
}
