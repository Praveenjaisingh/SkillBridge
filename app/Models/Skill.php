<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category', 
        'description',
    ];

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_skill');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_skill');
    }

    public function codingProblems(): HasMany
    {
        return $this->hasMany(CodingProblem::class);
    }

    public function interviewQuestions(): HasMany
    {
        return $this->hasMany(InterviewQuestion::class);
    }
}
