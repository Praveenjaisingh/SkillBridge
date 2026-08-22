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
            ['name' => 'Nimbus Cloud', 'industry' => 'Tech', 'location' => 'San Francisco, CA', 'description' => 'A cloud infrastructure company helping teams scale reliably.'],
            ['name' => 'Brightline Health', 'industry' => 'Healthcare', 'location' => 'Boston, MA', 'description' => 'Digital health platform connecting patients with care teams.'],
            ['name' => 'Ledgerly', 'industry' => 'Finance', 'location' => 'New York, NY', 'description' => 'Fintech startup building modern accounting tools for small businesses.'],
            ['name' => 'Pixel Forge Studios', 'industry' => 'Gaming', 'location' => 'Austin, TX', 'description' => 'An independent game studio crafting story-driven indie titles.'],
            ['name' => 'GreenGrid Energy', 'industry' => 'Energy', 'location' => 'Denver, CO', 'description' => 'Renewable energy company optimizing smart grids with software.'],
            ['name' => 'Retailio', 'industry' => 'Retail', 'location' => 'Seattle, WA', 'description' => 'E-commerce platform empowering independent retailers to sell online.'],
            ['name' => 'Skyline Robotics', 'industry' => 'Manufacturing', 'location' => 'Detroit, MI', 'description' => 'Builds autonomous robotics for warehouse and factory automation.'],
            ['name' => 'DataForge Analytics', 'industry' => 'Tech', 'location' => 'Chicago, IL', 'description' => 'Data platform turning raw business data into actionable insight.'],
            ['name' => 'EduSpark', 'industry' => 'Education', 'location' => 'Remote', 'description' => 'Ed-tech company building adaptive learning tools for classrooms.'],
            ['name' => 'Voyage Travel Co.', 'industry' => 'Travel', 'location' => 'Miami, FL', 'description' => 'Travel booking platform with AI-powered itinerary planning.'],
            ['name' => 'SecureNet Systems', 'industry' => 'Cybersecurity', 'location' => 'Washington, DC', 'description' => 'Enterprise cybersecurity firm protecting critical infrastructure.'],
            ['name' => 'Harborline Logistics', 'industry' => 'Logistics', 'location' => 'Long Beach, CA', 'description' => 'Supply chain software connecting shippers with carriers in real time.'],
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
                ],
            );
        }
    }
}
