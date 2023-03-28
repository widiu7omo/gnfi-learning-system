<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use phpDocumentor\Reflection\Types\This;

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
        return $this->belongsToMany(User::class, 'class_registrations')->withPivot('status');
    }

    public function class_registrations(): HasMany
    {
        return $this->hasMany(ClassRegistration::class);
    }

    public function class_registration(User $student): Model|null
    {
        return $this->class_registrations()->where('user_id', '=', $student->id)->first();
    }

    public function is_user_registered(User $user)
    {
        return $this->students->contains($user);
    }
}
