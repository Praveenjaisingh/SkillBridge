<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterviewQuestion extends Model
{
    use HasFactory;

    protected $casts = [
        'follow_up_questions' => 'array',
        'related_topics' => 'array',
    ];

    protected $fillable = [
        'skill_id',
        'programming_language_id', 
        'question',
        'answer',
        'difficulty',
        'category',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function programmingLanguage(): BelongsTo
    {
        return $this->belongsTo(ProgrammingLanguage::class);
    }
}
