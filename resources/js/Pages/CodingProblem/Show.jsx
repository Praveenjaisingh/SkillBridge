import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import ConfirmDeleteButton from '@/Components/ConfirmDeleteButton';

export default function Show({ codingProblem }) {
    if (!codingProblem) {
        return (
            <AuthenticatedLayout header={<h2 className="text-xl font-semibold text-gray-800">Not found</h2>}>
                <Head title="Not found" />
                <div className="py-8"><div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">Record not found.</div></div>
            </AuthenticatedLayout>
        );
    }

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        CodingProblem #{codingProblem.id}
                    </h2>
                    <div className="flex items-center gap-4">
                        <Link href={route('coding-problems.edit', codingProblem.id)} className="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</Link>
                        <ConfirmDeleteButton href={route('coding-problems.destroy', codingProblem.id)} />
                    </div>
                </div>
            }
        >
            <Head title={`CodingProblem #${codingProblem.id}`} />

            <div className="py-8">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <div className="rounded-lg bg-white p-6 shadow-sm">
                        <dl>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Skill</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.skill?.name ?? codingProblem.skill_id ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Programming Language</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.programmingLanguage?.name ?? codingProblem.programming_language_id ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Title</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.title ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Slug</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.slug ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Description</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.description ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Difficulty</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.difficulty ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Sample Input</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.sample_input ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Sample Output</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.sample_output ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Constraints</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(codingProblem.constraints ?? '—')}</dd>
                        </div>
                        </dl>
                    </div>
                    <Link href={route('coding-problems.index')} className="mt-4 inline-block text-sm text-gray-500 hover:text-gray-800">
                        &larr; Back to CodingProblems
                    </Link>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
