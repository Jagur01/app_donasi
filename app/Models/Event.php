<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'description', 'date'];

    public function category()
    {
        return $this->belongsTo(CategoryEvent::class);
    }
}
