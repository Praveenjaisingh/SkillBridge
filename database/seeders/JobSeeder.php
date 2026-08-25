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
            [
                'company' => 'Nimbus Cloud', 'title' => 'Backend Engineer (Go)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'San Francisco, CA', 'skills' => ['REST APIs', 'Microservices', 'Docker'], 'salary' => [110000, 150000],
                'responsibilities' => ['Design and build REST APIs and internal microservices in Go', 'Own the reliability and performance of services you ship', 'Participate in on-call rotation and incident response', 'Collaborate with product and SRE teams on system design'],
                'nice_to_have' => ['Experience with Kubernetes in production', 'Familiarity with gRPC', 'Contributions to open-source Go projects'],
                'benefits' => ['Health, dental & vision insurance', 'Unlimited PTO', 'Remote-friendly', '401(k) match'],
            ],
            [
                'company' => 'Brightline Health', 'title' => 'Frontend Developer (React)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Boston, MA', 'skills' => ['React', 'Tailwind CSS', 'REST APIs'], 'salary' => [95000, 130000],
                'responsibilities' => ['Build accessible, responsive patient-facing interfaces in React', 'Collaborate with designers to implement pixel-accurate UI', 'Write unit and integration tests for critical user flows', 'Optimize front-end performance and Core Web Vitals'],
                'nice_to_have' => ['Experience in a regulated healthcare (HIPAA) environment', 'Familiarity with design systems', 'TypeScript experience'],
                'benefits' => ['Health, dental & vision insurance', 'Parental leave', 'Mental health stipend', 'Flexible hours'],
            ],
            [
                'company' => 'Ledgerly', 'title' => 'Full Stack Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'New York, NY', 'skills' => ['Laravel', 'React', 'MySQL'], 'salary' => [130000, 170000],
                'responsibilities' => ['Design and ship features end-to-end across Laravel and React', 'Design database schemas and write efficient MySQL queries', 'Mentor junior engineers through code review', 'Partner with product to scope and estimate work'],
                'nice_to_have' => ['Experience in fintech or another regulated industry', 'Familiarity with event-driven architectures', 'Experience with automated testing pipelines'],
                'benefits' => ['Health insurance', 'Equity for all employees', 'Learning & development budget', 'Hybrid work'],
            ],
            [
                'company' => 'Pixel Forge Studios', 'title' => 'Gameplay Programmer (C++)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Austin, TX', 'skills' => ['Problem Solving', 'System Design'], 'salary' => [90000, 125000],
                'responsibilities' => ['Implement gameplay systems and mechanics in C++', 'Work closely with designers to prototype and iterate quickly', 'Profile and optimize performance-critical game code', 'Debug issues across multiple target platforms'],
                'nice_to_have' => ['Experience with Unreal Engine or a custom game engine', 'Console development experience', 'A public portfolio or shipped title'],
                'benefits' => ['Health insurance', 'Game industry discounts', 'Creative Fridays', 'Flexible hours'],
            ],
            [
                'company' => 'GreenGrid Energy', 'title' => 'Data Engineer', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Denver, CO', 'skills' => ['Data Analysis', 'PostgreSQL', 'Pandas'], 'salary' => [100000, 140000],
                'responsibilities' => ['Build and maintain data pipelines feeding analytics and ML models', 'Design efficient PostgreSQL schemas for time-series grid data', 'Ensure data quality and monitor pipeline reliability', 'Partner with data scientists to productionize models'],
                'nice_to_have' => ['Experience with Apache Airflow or a similar orchestrator', 'Familiarity with cloud data warehouses (BigQuery, Redshift)', 'Interest in the energy or sustainability sector'],
                'benefits' => ['Health, dental & vision insurance', '401(k) match', 'Commuter benefits', 'Sustainability bonus'],
            ],
            [
                'company' => 'Retailio', 'title' => 'DevOps Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Seattle, WA', 'skills' => ['AWS', 'Kubernetes', 'CI/CD'], 'salary' => [125000, 165000],
                'responsibilities' => ['Own and evolve CI/CD pipelines for dozens of services', 'Manage and scale Kubernetes clusters on AWS', 'Improve observability with metrics, logs, and tracing', 'Lead incident response and post-mortems'],
                'nice_to_have' => ['AWS certification', 'Experience with Terraform or another IaC tool', 'Experience running multi-region infrastructure'],
                'benefits' => ['Health insurance', 'Employee discount', 'Remote-friendly', 'Stock options'],
            ],
            [
                'company' => 'Skyline Robotics', 'title' => 'Embedded Software Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Detroit, MI', 'skills' => ['System Design', 'Problem Solving'], 'salary' => [115000, 150000],
                'responsibilities' => ['Develop firmware and control software for autonomous robots', 'Debug hardware-software integration issues on real devices', 'Design real-time systems with strict latency requirements', 'Collaborate with mechanical and electrical engineering teams'],
                'nice_to_have' => ['Experience with ROS (Robot Operating System)', 'Familiarity with real-time operating systems (RTOS)', 'Prior robotics or automotive industry experience'],
                'benefits' => ['Health, dental & vision insurance', 'Relocation assistance', '401(k) match', 'On-site gym'],
            ],
            [
                'company' => 'DataForge Analytics', 'title' => 'Machine Learning Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Chicago, IL', 'skills' => ['Machine Learning', 'TensorFlow', 'Data Analysis'], 'salary' => [135000, 180000],
                'responsibilities' => ['Design, train, and deploy machine learning models to production', 'Build feature pipelines and evaluation frameworks', 'Monitor model performance and retrain as data drifts', 'Communicate model trade-offs clearly to non-technical stakeholders'],
                'nice_to_have' => ['Experience deploying models with a model-serving platform', 'Published research or a strong open-source ML portfolio', 'Experience with MLOps tooling'],
                'benefits' => ['Health insurance', 'Equity for all employees', 'Conference budget', 'Remote-friendly'],
            ],
            [
                'company' => 'EduSpark', 'title' => 'Junior Frontend Developer', 'type' => 'full-time', 'experience' => 'junior', 'location' => 'Remote', 'skills' => ['React', 'HTML5', 'CSS3'], 'salary' => [65000, 85000],
                'responsibilities' => ['Implement UI components from design mockups in React', 'Fix bugs and improve accessibility across the product', 'Write basic tests for the components you build', 'Participate in code review and team stand-ups'],
                'nice_to_have' => ['A portfolio of personal or bootcamp projects', 'Basic familiarity with Git workflows', 'Interest in education technology'],
                'benefits' => ['Health insurance', 'Fully remote', 'Home office stipend', 'Flexible hours'],
            ],
            [
                'company' => 'Voyage Travel Co.', 'title' => 'Mobile Engineer (Flutter)', 'type' => 'full-time', 'experience' => 'mid', 'location' => 'Miami, FL', 'skills' => ['Flutter'], 'salary' => [100000, 135000],
                'responsibilities' => ['Build and maintain features in a shared Flutter codebase for iOS and Android', 'Integrate with backend travel and booking APIs', 'Optimize app performance and startup time', 'Publish and manage releases through app stores'],
                'nice_to_have' => ['Experience shipping a Flutter app to production', 'Native iOS or Android development background', 'Experience with state management (Riverpod/Bloc)'],
                'benefits' => ['Health insurance', 'Travel discounts', 'Annual travel stipend', 'Hybrid work'],
            ],
            [
                'company' => 'SecureNet Systems', 'title' => 'Security Software Engineer', 'type' => 'full-time', 'experience' => 'senior', 'location' => 'Washington, DC', 'skills' => ['System Design', 'REST APIs'], 'salary' => [130000, 175000],
                'responsibilities' => ['Design and harden systems against common attack vectors', 'Perform security reviews and threat modeling on new features', 'Build internal tooling to detect and respond to incidents', 'Stay current on emerging vulnerabilities and mitigations'],
                'nice_to_have' => ['Security clearance or eligibility to obtain one', 'Relevant certifications (OSCP, CISSP, etc.)', 'Experience with penetration testing'],
                'benefits' => ['Health, dental & vision insurance', 'Security clearance sponsorship', '401(k) match', 'Continuing education'],
            ],
            [
                'company' => 'Harborline Logistics', 'title' => 'Backend Developer Intern', 'type' => 'internship', 'experience' => 'junior', 'location' => 'Long Beach, CA', 'skills' => ['REST APIs', 'MySQL'], 'salary' => [25, 35],
                'responsibilities' => ['Assist in building and testing REST API endpoints', 'Write and run basic SQL queries against MySQL', 'Fix small bugs and write accompanying tests under mentorship', 'Participate in team stand-ups and sprint planning'],
                'nice_to_have' => ['Coursework or a personal project involving a backend language', 'Basic SQL knowledge', 'Currently pursuing a degree in Computer Science or related field'],
                'benefits' => ['Mentorship program', 'Flexible schedule around classes', 'Potential for full-time conversion'],
            ],
            [
                'company' => 'Nimbus Cloud', 'title' => 'Site Reliability Engineer', 'type' => 'remote', 'experience' => 'senior', 'location' => 'Remote', 'skills' => ['Kubernetes', 'AWS', 'Linux Administration'], 'salary' => [140000, 185000],
                'responsibilities' => ['Define and track SLIs/SLOs across critical services', 'Automate operational toil through tooling and self-healing systems', 'Lead incident response and drive blameless post-mortems', 'Partner with engineering teams to improve system resilience'],
                'nice_to_have' => ['Experience with chaos engineering practices', 'Deep Linux internals knowledge', 'Prior on-call leadership experience'],
                'benefits' => ['Health, dental & vision insurance', 'Unlimited PTO', 'Remote-friendly', '401(k) match'],
            ],
            [
                'company' => 'Retailio', 'title' => 'Product Designer / Frontend Hybrid', 'type' => 'contract', 'experience' => 'mid', 'location' => 'Seattle, WA', 'skills' => ['React', 'Responsive Design'], 'salary' => [80, 110],
                'responsibilities' => ['Design and prototype new shopping experiences in Figma', 'Implement the resulting UI directly in React', 'Run lightweight usability tests and iterate on feedback', 'Maintain consistency with the existing design system'],
                'nice_to_have' => ['A portfolio showing both design and shipped code', 'Experience with e-commerce products', 'Familiarity with accessibility (WCAG) guidelines'],
                'benefits' => ['Flexible contract schedule', 'Remote-friendly', 'Potential for extension or conversion'],
            ],
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
                    'responsibilities' => $job['responsibilities'],
                    'nice_to_have' => $job['nice_to_have'],
                    'benefits' => $job['benefits'],
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
