<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'discount',
        'date_active_from',
        'date_active_to',
        'project_id',
        'preview_text',
        'name'
    ];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_discount');
    }

}
