<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'invoices';

    protected $fillable=[
        'id',
        'customer_id',
        'amount',
        'status',
        'billed_deted',
        'paid_deted',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
