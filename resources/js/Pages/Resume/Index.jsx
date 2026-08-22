import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';
import TextInput from '@/Components/TextInput';
import PrimaryButton from '@/Components/PrimaryButton';
import Pagination from '@/Components/Pagination';
import EmptyState from '@/Components/EmptyState';
import ConfirmDeleteButton from '@/Components/ConfirmDeleteButton';
import { useState } from 'react';

export default function Index({ resumes, filters }) {
    const [search, setSearch] = useState(filters?.search ?? '');
    const rows = resumes?.data ?? (Array.isArray(resumes) ? resumes : []);

    const submitSearch = (e) => {
        e.preventDefault();
        router.get(route('resumes.index'), { ...filters, search }, { preserveState: true, replace: true });
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        Resumes
                    </h2>
                    <Link
                        href={route('resumes.create')}
                        className="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
                    >
                        New Resume
                    </Link>
                </div>
            }
        >
            <Head title="Resumes" />

            <div className="py-8">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <form onSubmit={submitSearch} className="mb-4 flex gap-2">
                        <TextInput
                            className="w-full max-w-xs"
                            placeholder="Search resumes..."
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                        />
                        <PrimaryButton type="submit">Search</PrimaryButton>
                    </form>

                    <div className="overflow-hidden rounded-lg bg-white shadow-sm">
                        {rows.length === 0 ? (
                            <div className="p-6">
                                <EmptyState
                                    title="No resumes yet"
                                    description="Get started by creating your first record."
                                    actionHref={route('resumes.create')}
                                    actionLabel="New Resume"
                                />
                            </div>
                        ) : (
                            <table className="min-w-full divide-y divide-gray-100 text-sm">
                                <thead className="bg-gray-50">
                                    <tr>
                                <th className="px-4 py-3 text-left font-semibold text-gray-600">Title</th>
                                <th className="px-4 py-3 text-left font-semibold text-gray-600">User</th>
                                <th className="px-4 py-3 text-left font-semibold text-gray-600">Is Primary</th>
                                        <th className="px-4 py-3 text-right font-semibold text-gray-600">Actions</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100">
                                    {rows.map((row) => (
                                        <tr key={row.id}>
                                <td className="px-4 py-3 text-gray-700">{row.title}</td>
                                <td className="px-4 py-3 text-gray-700">{row.user_id}</td>
                                <td className="px-4 py-3 text-gray-700">{(row.is_primary ? 'Yes' : 'No')}</td>
                                            <td className="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                                                <Link href={route('resumes.show', row.id)} className="text-sm font-medium text-gray-600 hover:text-gray-900">View</Link>
                                                <Link href={route('resumes.edit', row.id)} className="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</Link>
                                                <ConfirmDeleteButton href={route('resumes.destroy', row.id)} />
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        )}
                    </div>

                    <Pagination meta={ resumes } />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
