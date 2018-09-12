<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $fillable = ['address_name', 'address'];

	public function user()
	{
		return $this->belongsTo('Models\User');
	}
    //
}
