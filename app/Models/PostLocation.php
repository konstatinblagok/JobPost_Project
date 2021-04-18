<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PostLocation extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'post_locations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'url',
        'created_at',
        'driver_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function postLocationPostHistories()
    {
        return $this->hasMany(PostHistory::class, 'post_location_id', 'id');
    }

    public function postLocationsJobPostings()
    {
        return $this->belongsToMany(JobPosting::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
