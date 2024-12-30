<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesCampaigns extends Model
{
    use HasFactory;

    protected $table = 'categories_campaign'; // Nama tabel harus sesuai

    protected $guarded = [];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'category_id');
    }
}
