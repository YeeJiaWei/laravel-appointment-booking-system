<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon as Time;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
	use HasFactory;

	protected $guarded = [];

	// Declare public accessors
	public $hour, $minute;

	public function __construct(array $attributes = array()) {
		// Run parent Eloquent model construct method before setup
		parent::__construct($attributes);

		// Set public accessors
		$this->hour = Time::parse($this->duration)->hour;
		$this->minute = Time::parse($this->duration)->minute;
	}

    /**
	 * Get bookings from activity
	 *
	 * @return \App\Booking
	 */
	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}
}
