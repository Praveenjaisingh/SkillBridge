<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodingProblem extends Model
{
    use HasFactory;
    
    protected $casts = [
        'examples' => 'array',
        'hints' => 'array',
    ];

    protected $fillable = [
        'skill_id',
        'programming_language_id',
        'title',
        'slug',
        'description',
        'difficulty',
        'sample_input',
        'sample_output',
        'constraints',
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
