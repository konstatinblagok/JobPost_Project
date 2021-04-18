<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class JobPosting extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'job_postings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'content',
        'url',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'shorten_url'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function jobPostPostHistories()
    {
        return $this->hasMany(PostHistory::class, 'job_post_id', 'id');
    }

    public function post_locations()
    {
        return $this->belongsToMany(PostLocation::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
