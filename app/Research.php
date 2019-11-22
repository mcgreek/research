<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
	protected $fillable = [
		'title'
	];

	/**
	 * Get related polls
	 * 
	 * @return 
	 */
	public function polls()
	{
		return $this->hasMany(Poll::class);
	}
}
