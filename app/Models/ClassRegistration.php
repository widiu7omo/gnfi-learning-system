<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function study_class(): BelongsTo
    {
        return $this->belongsTo(StudyClass::class);
    }
}
