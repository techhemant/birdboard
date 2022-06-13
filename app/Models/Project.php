<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Readline\Userland;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path(): string
    {
        return '/projects/' . $this->id;
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function addTask(string $body): Model
    {
        return $this->tasks()->create(compact('body'));
    }
}
