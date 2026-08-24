<?php

namespace App\Repositories\InterviewQuestion;

use App\Helpers\QueryFilterHelper;
use App\Models\InterviewQuestion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class InterviewQuestionEloquent implements InterviewQuestionContract
{
    protected $interviewQuestion,$queryFilterHelper;
    public function __construct(InterviewQuestion $interviewQuestion,QueryFilterHelper $queryFilterHelper)
    {
        $this->interviewQuestion = $interviewQuestion;
        $this->queryFilterHelper = $queryFilterHelper;
    }

    public function all(array $filters = []): Collection
    {
        $query = $this->interviewQuestion->query()->with(['skill', 'programmingLanguage']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['question', 'category']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['difficulty', 'skill_id', 'programming_language_id']);
        return $query->latest()->get();
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->interviewQuestion->query()->with(['skill', 'programmingLanguage']);
        $query = $this->queryFilterHelper->applySearch($query, $filters['search'] ?? null, ['question', 'category']);
        $query = $this->queryFilterHelper->applyFilters($query, $filters, ['difficulty', 'skill_id', 'programming_language_id']);
        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function find(int $id): ?InterviewQuestion
    {
        return $this->interviewQuestion->query()->with(['skill', 'programmingLanguage'])->find($id);
    }

    public function create(array $data): InterviewQuestion
    {
        return $this->interviewQuestion->create($data);
    }

    public function update(InterviewQuestion $interviewQuestion, array $data): InterviewQuestion
    {
        $interviewQuestion->update($data);

        return $interviewQuestion->fresh(['skill', 'programmingLanguage']);
    }

    public function delete(InterviewQuestion $interviewQuestion): bool
    {
        return (bool) $interviewQuestion->delete();
    }
}
