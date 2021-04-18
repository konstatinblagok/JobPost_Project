<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class PostHistory extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'post_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'Successful' => 'Successful',
        'Failed'     => 'Failed',
        'Error'      => 'Error',
        'Pending'    => 'Pending',
    ];

    protected $fillable = [
        'title',
        'job_post_id',
        'post_location_id',
        'created_at',
        'url',
        'status',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function instanceClicks()
    {
        return $this->hasMany(Click::class, 'instance_id', 'id');
    }

    public function job_post()
    {
        return $this->belongsTo(JobPosting::class, 'job_post_id');
    }

    public function post_location()
    {
        return $this->belongsTo(PostLocation::class, 'post_location_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
