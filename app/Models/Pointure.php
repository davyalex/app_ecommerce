<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pointure extends Model
{
    use HasFactory;
    protected $fillable = [
        'pointure',
        'product_id'
        ];

        public function product(){
            return $this->belongsTo(Product::class);
        }

}
