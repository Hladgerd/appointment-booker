<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'frequency_id',
        'day',
    ];

    public function type(): HasOne
    {
        return $this->hasOne(Frequency::class, 'id', 'frequency_id');
    }
}
