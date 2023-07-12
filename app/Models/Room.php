<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room';

    protected $primaryKey = 'room_id';

    protected $guarded= [];

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'reservation_id');
    }
}
