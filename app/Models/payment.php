<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = ['order_id', 'payment_amount', 'payment_method', 'payment_date'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
