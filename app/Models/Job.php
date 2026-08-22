<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * Named "job_postings" to avoid colliding with Laravel's built-in
     * queue "jobs" table.
     */
    protected $table = 'job_postings';

    protected $fillable = [
        'company_id',
        'posted_by',
        'title',
        'slug',
        'description',
        'requirements',
        'location',
        'job_type',
        'experience_level',
        'salary_min',
        'salary_max',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
