<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [ 'category','Item_code', 'Item_description','alert_quantity','purchasePrice', 'saleprice' ];
}
