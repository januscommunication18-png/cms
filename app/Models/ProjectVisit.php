<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectVisit extends Model
{
    protected $fillable = [
        'project_id',
        'visitor_name',
        'ip_address',
        'user_agent',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
