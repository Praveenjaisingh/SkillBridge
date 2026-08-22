<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            ['company' => 'Nimbus Cloud', 'title' => 'Backend Engineer (Go)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'San Francisco, CA', 'skills' => ['REST APIs', 'Microservices', 'Docker'], 'salary' => [110000, 150000]],
            ['company' => 'Brightline Health', 'title' => 'Frontend Developer (React)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Boston, MA', 'skills' => ['React', 'Tailwind CSS', 'REST APIs'], 'salary' => [95000, 130000]],
            ['company' => 'Ledgerly', 'title' => 'Full Stack Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'New York, NY', 'skills' => ['Laravel', 'React', 'MySQL'], 'salary' => [130000, 170000]],
            ['company' => 'Pixel Forge Studios', 'title' => 'Gameplay Programmer (C++)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Austin, TX', 'skills' => ['Problem Solving', 'System Design'], 'salary' => [90000, 125000]],
            ['company' => 'GreenGrid Energy', 'title' => 'Data Engineer', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Denver, CO', 'skills' => ['Data Analysis', 'PostgreSQL', 'Pandas'], 'salary' => [100000, 140000]],
            ['company' => 'Retailio', 'title' => 'DevOps Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Seattle, WA', 'skills' => ['AWS', 'Kubernetes', 'CI/CD'], 'salary' => [125000, 165000]],
            ['company' => 'Skyline Robotics', 'title' => 'Embedded Software Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Detroit, MI', 'skills' => ['System Design', 'Problem Solving'], 'salary' => [115000, 150000]],
            ['company' => 'DataForge Analytics', 'title' => 'Machine Learning Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Chicago, IL', 'skills' => ['Machine Learning', 'TensorFlow', 'Data Analysis'], 'salary' => [135000, 180000]],
            ['company' => 'EduSpark', 'title' => 'Junior Frontend Developer', 'type' => 'full-time', 'experience' => 'junior', 'location' => 'Remote', 'skills' => ['React', 'HTML5', 'CSS3'], 'salary' => [65000, 85000]],
            ['company' => 'Voyage Travel Co.', 'title' => 'Mobile Engineer (Flutter)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Miami, FL', 'skills' => ['Flutter'], 'salary' => [100000, 135000]],
            ['company' => 'SecureNet Systems', 'title' => 'Security Software Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Washington, DC', 'skills' => ['System Design', 'REST APIs'], 'salary' => [130000, 175000]],
            ['company' => 'Harborline Logistics', 'title' => 'Backend Developer Intern', 'type' => 'internship', 'experience' => 'junior', 'location' => 'Long Beach, CA', 'skills' => ['REST APIs', 'MySQL'], 'salary' => [25, 35]],
            ['company' => 'Nimbus Cloud', 'title' => 'Site Reliability Engineer', 'type' => 'remote', 'experience' => 'senior', 'location' => 'Remote', 'skills' => ['Kubernetes', 'AWS', 'Linux Administration'], 'salary' => [140000, 185000]],
            ['company' => 'Retailio', 'title' => 'Product Designer / Frontend Hybrid', 'type' => 'contract', 'experience' => 'mid', 'location' => 'Seattle, WA', 'skills' => ['React', 'Responsive Design'], 'salary' => [80, 110]],
        ];

        foreach ($jobs as $job) {
            $company = Company::query()->where('slug', Str::slug($job['company']))->first();

            if (! $company) {
                continue;
            }

            $posting = Job::query()->updateOrCreate(
                [
                    'company_id' => $company->id,
                    'slug' => Str::slug($job['title'] . '-' . $company->slug),
                ],
                [
                    'posted_by' => null,
                    'title' => $job['title'],
                    'description' => "{$company->name} is hiring a {$job['title']} to join our growing engineering team. You'll work closely with product and design to ship high-quality software.",
                    'requirements' => 'Strong problem-solving skills, solid communication, and hands-on experience with the listed technologies.',
                    'location' => $job['location'],
                    'job_type' => $job['type'],
                    'experience_level' => $job['experience'],
                    'salary_min' => $job['salary'][0],
                    'salary_max' => $job['salary'][1],
                    'is_active' => true,
                ],
            );

            $skillIds = Skill::query()
                ->whereIn('slug', array_map(fn ($s) => Str::slug($s), $job['skills']))
                ->pluck('id');

            if ($skillIds->isNotEmpty()) {
                $posting->skills()->sync($skillIds);
            }
        }
    }
}
