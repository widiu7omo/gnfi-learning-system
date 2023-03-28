<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class StudyClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'status'
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'class_registrations');
    }

    public function class_registrations(): HasMany
    {
        return $this->hasMany(ClassRegistration::class);
    }
}
