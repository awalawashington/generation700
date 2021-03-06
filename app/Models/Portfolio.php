<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'portfolio_category_id'
    ];

    public function portfolio_category()
    {
        return $this->belongsTo(PortfolioCategory::class);
    }
}
