<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Driver extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'drivers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function driverPostLocations()
    {
        return $this->hasMany(PostLocation::class, 'driver_id', 'id');
    }

    public function driverCredentials()
    {
        return $this->belongsToMany(Credential::class);
    }
}
