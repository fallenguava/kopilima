<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedOrder extends Model
{
    use HasFactory;

    protected $table = 'finished_orders';

    protected $fillable = [
        'order_id',
        'all_items',
        'final_price',
        'customer_name',
        'email',
        'table_number',
    ];
}
