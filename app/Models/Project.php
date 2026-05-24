<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'priority',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
