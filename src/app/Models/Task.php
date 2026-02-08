<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table='tasks';
    protected $fillable = [
        "user_id",
        "name",
        'description',
        'priority'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
}
