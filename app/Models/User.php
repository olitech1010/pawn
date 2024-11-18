<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'identification_type',
        'identification_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }



    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }



}
