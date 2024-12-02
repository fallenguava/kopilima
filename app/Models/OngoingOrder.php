<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OngoingOrder extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id'; // Define primary key as order_id

    public $incrementing = false; // Set to false if order_id is not auto-incrementing
    protected $keyType = 'int';   // Specify the data type if necessary (e.g., 'int')

    protected $fillable = [
        'order_id', 
        'all_items', 
        'final_price', 
        'customer_name', 
        'email',
        'table_number'
    ];
}
