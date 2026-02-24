<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPassword extends Model
{
    protected $fillable = [
        'name',
        'password',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = ['password'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
