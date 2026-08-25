<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'Nimbus Cloud', 'industry' => 'Tech', 'location' => 'San Francisco, CA', 'description' => 'A cloud infrastructure company helping teams scale reliably.', 'founded_year' => 2014, 'company_size' => '501-1000 employees', 'benefits' => ['Health, dental & vision insurance', 'Unlimited PTO', 'Remote-friendly', '401(k) match'], 'tech_stack' => ['Go', 'Kubernetes', 'AWS', 'Terraform']],
            ['name' => 'Brightline Health', 'industry' => 'Healthcare', 'location' => 'Boston, MA', 'description' => 'Digital health platform connecting patients with care teams.', 'founded_year' => 2017, 'company_size' => '201-500 employees', 'benefits' => ['Health, dental & vision insurance', 'Parental leave', 'Mental health stipend', 'Flexible hours'], 'tech_stack' => ['React', 'Node.js', 'PostgreSQL', 'AWS']],
            ['name' => 'Ledgerly', 'industry' => 'Finance', 'location' => 'New York, NY', 'description' => 'Fintech startup building modern accounting tools for small businesses.', 'founded_year' => 2019, 'company_size' => '51-200 employees', 'benefits' => ['Health insurance', 'Equity for all employees', 'Learning & development budget', 'Hybrid work'], 'tech_stack' => ['Laravel', 'React', 'MySQL', 'Docker']],
            ['name' => 'Pixel Forge Studios', 'industry' => 'Gaming', 'location' => 'Austin, TX', 'description' => 'An independent game studio crafting story-driven indie titles.', 'founded_year' => 2015, 'company_size' => '11-50 employees', 'benefits' => ['Health insurance', 'Game industry discounts', 'Creative Fridays', 'Flexible hours'], 'tech_stack' => ['C++', 'Unreal Engine', 'C#', 'Perforce']],
            ['name' => 'GreenGrid Energy', 'industry' => 'Energy', 'location' => 'Denver, CO', 'description' => 'Renewable energy company optimizing smart grids with software.', 'founded_year' => 2012, 'company_size' => '201-500 employees', 'benefits' => ['Health, dental & vision insurance', '401(k) match', 'Commuter benefits', 'Sustainability bonus'], 'tech_stack' => ['Python', 'PostgreSQL', 'Pandas', 'Azure']],
            ['name' => 'Retailio', 'industry' => 'Retail', 'location' => 'Seattle, WA', 'description' => 'E-commerce platform empowering independent retailers to sell online.', 'founded_year' => 2016, 'company_size' => '501-1000 employees', 'benefits' => ['Health insurance', 'Employee discount', 'Remote-friendly', 'Stock options'], 'tech_stack' => ['React', 'Kubernetes', 'AWS', 'GraphQL']],
            ['name' => 'Skyline Robotics', 'industry' => 'Manufacturing', 'location' => 'Detroit, MI', 'description' => 'Builds autonomous robotics for warehouse and factory automation.', 'founded_year' => 2013, 'company_size' => '201-500 employees', 'benefits' => ['Health, dental & vision insurance', 'Relocation assistance', '401(k) match', 'On-site gym'], 'tech_stack' => ['C++', 'Python', 'ROS', 'Linux']],
            ['name' => 'DataForge Analytics', 'industry' => 'Tech', 'location' => 'Chicago, IL', 'description' => 'Data platform turning raw business data into actionable insight.', 'founded_year' => 2018, 'company_size' => '51-200 employees', 'benefits' => ['Health insurance', 'Equity for all employees', 'Conference budget', 'Remote-friendly'], 'tech_stack' => ['Python', 'TensorFlow', 'Spark', 'GCP']],
            ['name' => 'EduSpark', 'industry' => 'Education', 'location' => 'Remote', 'description' => 'Ed-tech company building adaptive learning tools for classrooms.', 'founded_year' => 2020, 'company_size' => '11-50 employees', 'benefits' => ['Health insurance', 'Fully remote', 'Home office stipend', 'Flexible hours'], 'tech_stack' => ['React', 'Node.js', 'MongoDB', 'AWS']],
            ['name' => 'Voyage Travel Co.', 'industry' => 'Travel', 'location' => 'Miami, FL', 'description' => 'Travel booking platform with AI-powered itinerary planning.', 'founded_year' => 2016, 'company_size' => '201-500 employees', 'benefits' => ['Health insurance', 'Travel discounts', 'Annual travel stipend', 'Hybrid work'], 'tech_stack' => ['Flutter', 'Node.js', 'PostgreSQL', 'GCP']],
            ['name' => 'SecureNet Systems', 'industry' => 'Cybersecurity', 'location' => 'Washington, DC', 'description' => 'Enterprise cybersecurity firm protecting critical infrastructure.', 'founded_year' => 2011, 'company_size' => '1001-5000 employees', 'benefits' => ['Health, dental & vision insurance', 'Security clearance sponsorship', '401(k) match', 'Continuing education'], 'tech_stack' => ['Rust', 'C++', 'Kubernetes', 'AWS']],
            ['name' => 'Harborline Logistics', 'industry' => 'Logistics', 'location' => 'Long Beach, CA', 'description' => 'Supply chain software connecting shippers with carriers in real time.', 'founded_year' => 2015, 'company_size' => '201-500 employees', 'benefits' => ['Health insurance', '401(k) match', 'Relocation assistance', 'Hybrid work'], 'tech_stack' => ['Java', 'Spring Boot', 'MySQL', 'Kafka']],
        ];

        foreach ($companies as $company) {
            Company::query()->updateOrCreate(
                ['slug' => Str::slug($company['name'])],
                [
                    'name' => $company['name'],
                    'description' => $company['description'],
                    'website' => 'https://www.' . Str::slug($company['name'], '') . '.com',
                    'logo' => null,
                    'location' => $company['location'],
                    'industry' => $company['industry'],
                    'founded_year' => $company['founded_year'],
                    'company_size' => $company['company_size'],
                    'benefits' => $company['benefits'],
                    'tech_stack' => $company['tech_stack'],
                ],
            );
        }
    }
}
