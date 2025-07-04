<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['bl_release_date', 'bl_release_user_id', 'freight_payer_self', 'contract_number', 'bl_number'];

    protected $hidden = ['created_at', 'updated_at'];
}
