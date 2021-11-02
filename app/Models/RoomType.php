<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id', 'room_Type_id');
    }
}
