<?php

namespace App\Services;

use Weidner\Goutte\GoutteFacade as Goutte;
use App\Models\User;
use App\Models\Address;

class AddressService
{
	protected $user;
	protected $address;

	function __construct()
	{
		$this->user = new User;
		$this->address = new Address;
	}

	public function findLine($name)
	{
		$user = $this->user->where('name', $name)->first();
		$q = $user->addresses()->where('address_name', 'line')->first();
		$line = $q->address;

		return $line;
	}
    //
}
