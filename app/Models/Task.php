<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\categorie;


class Task extends Model
{
    protected $table="Tasks";
    protected $fillable=[
        'name',
        'due_date',
        'Priority',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_task');
    }
}
