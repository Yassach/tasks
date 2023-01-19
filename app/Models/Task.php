<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'status',
        'priority',
        'description',
        'context',
        'url',
    ];

    protected $casts = [
        'lastActivity' => 'datetime'
    ];

    protected function type(): Attribute
    {
        return Attribute::make(function ($value){
            switch ($value) {
                case '1': return 'problème graphique';
                case '2': return 'problème de connexion';
                case '3': return 'problème d\'export CSV';
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeWithLastActivity($query)
    {
        $query->addSubSelect('lastActivity', Comment::select('created_at')
            ->whereRaw('task_id = tasks.id')
            ->latest()
        );
    }
}
