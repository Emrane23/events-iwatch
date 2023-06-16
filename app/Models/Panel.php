<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory ;

    protected $fillable = [
        'name','description'
    ];

    public function Event()
    {
        return $this->belongsTo(Event::class);
    }

    public function users(){
        return $this->belongsToMany(User::class , 'participations', 'panel_id','user_id')->withTimestamps();
    }


   
}
