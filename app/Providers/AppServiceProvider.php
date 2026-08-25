<?php

namespace App\Providers;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmailMail;
use App\Repositories\Skill\SkillContract;
use App\Repositories\Skill\SkillEloquent;
use App\Services\Skill\SkillInterface;
use App\Services\Skill\SkillService;
use App\Repositories\ProgrammingLanguage\ProgrammingLanguageContract;
use App\Repositories\ProgrammingLanguage\ProgrammingLanguageEloquent;
use App\Services\ProgrammingLanguage\ProgrammingLanguageInterface;
use App\Services\ProgrammingLanguage\ProgrammingLanguageService;
use App\Repositories\Company\CompanyContract;
use App\Repositories\Company\CompanyEloquent;
use App\Services\Company\CompanyInterface;
use App\Services\Company\CompanyService;
use App\Repositories\Course\CourseContract;
use App\Repositories\Course\CourseEloquent;
use App\Services\Course\CourseInterface;
use App\Services\Course\CourseService;
use App\Repositories\Lesson\LessonContract;
use App\Repositories\Lesson\LessonEloquent;
use App\Services\Lesson\LessonInterface;
use App\Services\Lesson\LessonService;
use App\Repositories\Quiz\QuizContract;
use App\Repositories\Quiz\QuizEloquent;
use App\Services\Quiz\QuizInterface;
use App\Services\Quiz\QuizService;
use App\Repositories\CodingProblem\CodingProblemContract;
use App\Repositories\CodingProblem\CodingProblemEloquent;
use App\Services\CodingProblem\CodingProblemInterface;
use App\Services\CodingProblem\CodingProblemService;
use App\Repositories\InterviewQuestion\InterviewQuestionContract;
use App\Repositories\InterviewQuestion\InterviewQuestionEloquent;
use App\Services\InterviewQuestion\InterviewQuestionInterface;
use App\Services\InterviewQuestion\InterviewQuestionService;
use App\Repositories\Job\JobContract;
use App\Repositories\Job\JobEloquent;
use App\Services\Job\JobInterface;
use App\Services\Job\JobService;
use App\Repositories\JobApplication\JobApplicationContract;
use App\Repositories\JobApplication\JobApplicationEloquent;
use App\Services\JobApplication\JobApplicationInterface;
use App\Services\JobApplication\JobApplicationService;
use App\Repositories\Resume\ResumeContract;
use App\Repositories\Resume\ResumeEloquent;
use App\Services\Resume\ResumeInterface;
use App\Services\Resume\ResumeService;
use App\Repositories\Bookmark\BookmarkContract;
use App\Repositories\Bookmark\BookmarkEloquent;
use App\Services\Bookmark\BookmarkInterface;
use App\Services\Bookmark\BookmarkService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SkillContract::class, SkillEloquent::class);
        $this->app->bind(SkillInterface::class, SkillService::class);
        $this->app->bind(ProgrammingLanguageContract::class, ProgrammingLanguageEloquent::class);
        $this->app->bind(ProgrammingLanguageInterface::class, ProgrammingLanguageService::class);
        $this->app->bind(CompanyContract::class, CompanyEloquent::class);
        $this->app->bind(CompanyInterface::class, CompanyService::class);
        $this->app->bind(CourseContract::class, CourseEloquent::class);
        $this->app->bind(CourseInterface::class, CourseService::class);
        $this->app->bind(LessonContract::class, LessonEloquent::class);
        $this->app->bind(LessonInterface::class, LessonService::class);
        $this->app->bind(QuizContract::class, QuizEloquent::class);
        $this->app->bind(QuizInterface::class, QuizService::class);
        $this->app->bind(CodingProblemContract::class, CodingProblemEloquent::class);
        $this->app->bind(CodingProblemInterface::class, CodingProblemService::class);
        $this->app->bind(InterviewQuestionContract::class, InterviewQuestionEloquent::class);
        $this->app->bind(InterviewQuestionInterface::class, InterviewQuestionService::class);
        $this->app->bind(JobContract::class, JobEloquent::class);
        $this->app->bind(JobInterface::class, JobService::class);
        $this->app->bind(JobApplicationContract::class, JobApplicationEloquent::class);
        $this->app->bind(JobApplicationInterface::class, JobApplicationService::class);
        $this->app->bind(ResumeContract::class, ResumeEloquent::class);
        $this->app->bind(ResumeInterface::class, ResumeService::class);
        $this->app->bind(BookmarkContract::class, BookmarkEloquent::class);
        $this->app->bind(BookmarkInterface::class, BookmarkService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // Use our branded Mailable instead of Laravel's default verification email.
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new VerifyEmailMail($notifiable, $url))
                ->to($notifiable->getEmailForVerification());
        });

        // Use our branded Mailable instead of Laravel's default reset-password email.
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new ResetPasswordMail($notifiable, $url))
                ->to($notifiable->getEmailForPasswordReset());
        });
    }
}