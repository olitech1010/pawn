<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'price',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
