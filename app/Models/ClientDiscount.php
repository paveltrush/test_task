<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDiscount extends Model
{
    use HasFactory;

    protected $table = 'client_discount';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
