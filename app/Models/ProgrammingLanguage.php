<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammingLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
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
