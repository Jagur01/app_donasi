<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'goal_amount',
        'total_collected',
        'description',
        'expired',
        'category_id',
        'status',
        'file_qr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
{
    return $this->belongsTo(CategoriesCampaigns::class, 'category_id');
}
public function donations()
{
    return $this->hasMany(Donation::class);
}

public function totalDonations()
{
    return $this->donations()->sum('amount');
}

public function isCompleted()
{
    return $this->totalDonations() >= $this->goal_amount;
}
public function donors()
{
    return $this->hasMany(Donation::class); // Assuming Donor is the model for donors
}

}
