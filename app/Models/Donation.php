<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'campaign_id', 'amount', 'status_id', 'proof_image', 'rejected_reason'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
