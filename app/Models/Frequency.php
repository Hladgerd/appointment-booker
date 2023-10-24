<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Frequency extends Model
{
    use HasFactory;

    protected $fillable = ['frequency'];

    public function events(): HasMany
    {
        return $this->hasMany(Appointment::class, 'frequency_id', 'id');
    }
}
