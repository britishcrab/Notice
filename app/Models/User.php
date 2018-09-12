<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

class User extends Model
{
	protected $fillable = ['name'];

	public function addresses()
	{
		return $this->hasMany('\App\Models\Address');
	}
    //
}
