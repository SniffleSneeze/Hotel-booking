<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'room_id',
        'start',
        'end',
        'is_reservation',
        'is_paid',
        'notes',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);

    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'bookings_users',
            'booking_id',
            'user_id')
            ->withTimestamps();
    }

}
