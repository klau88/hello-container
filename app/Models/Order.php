<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(OrderObserver::class)]
class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['bl_release_date', 'bl_release_user_id', 'freight_payer_self', 'contract_number', 'bl_number', 'notification_sent'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @var string[]
     */
    protected $casts = ['notification_sent' => 'boolean'];
}
