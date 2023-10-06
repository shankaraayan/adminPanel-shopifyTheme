<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_customers extends Model
{
    use HasFactory;
	protected $guarded = [];
	
	public function Orders(){
        return $this->belongsTo(Orders::class);
    }
}
