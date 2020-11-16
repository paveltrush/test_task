<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'second_name',
        'last_name',
        'last_login',
        'personal_mobile',
        'personal_phone'
    ];

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'client_discount');
    }
}
