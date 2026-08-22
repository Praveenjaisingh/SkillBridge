import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

const MODULES = [
    { route: 'jobs.index', label: 'Jobs', description: 'Browse and manage job postings' },
    { route: 'job-applications.index', label: 'Job Applications', description: 'Track applications and status' },
    { route: 'companies.index', label: 'Companies', description: 'Manage hiring companies' },
    { route: 'courses.index', label: 'Courses', description: 'Manage learning courses' },
    { route: 'lessons.index', label: 'Lessons', description: 'Course lesson content' },
    { route: 'quizzes.index', label: 'Quizzes', description: 'Course quizzes and questions' },
    { route: 'skills.index', label: 'Skills', description: 'Skill tags across the platform' },
    { route: 'programming-languages.index', label: 'Programming Languages', description: 'Languages used across content' },
    { route: 'coding-problems.index', label: 'Coding Problems', description: 'Practice coding challenges' },
    { route: 'interview-questions.index', label: 'Interview Questions', description: 'Interview prep question bank' },
    { route: 'resumes.index', label: 'Resumes', description: 'Manage uploaded resumes' },
    { route: 'bookmarks.index', label: 'Bookmarks', description: 'Saved jobs and courses' },
];

export default function Dashboard() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-8">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        {MODULES.map((mod) => (
                            <Link
                                key={mod.route}
                                href={route(mod.route)}
                                className="rounded-lg bg-white p-5 shadow-sm transition hover:shadow-md hover:-translate-y-0.5"
                            >
                                <h3 className="text-sm font-semibold text-gray-900">
                                    {mod.label}
                                </h3>
                                <p className="mt-1 text-sm text-gray-500">
                                    {mod.description}
                                </p>
                            </Link>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
