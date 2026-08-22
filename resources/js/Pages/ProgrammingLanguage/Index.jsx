import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, router } from '@inertiajs/react';
import TextInput from '@/Components/TextInput';
import PrimaryButton from '@/Components/PrimaryButton';
import Pagination from '@/Components/Pagination';
import EmptyState from '@/Components/EmptyState';
import ConfirmDeleteButton from '@/Components/ConfirmDeleteButton';
import { useState } from 'react';

export default function Index({ programmingLanguages, filters }) {
    const [search, setSearch] = useState(filters?.search ?? '');
    const rows = programmingLanguages?.data ?? (Array.isArray(programmingLanguages) ? programmingLanguages : []);

    const submitSearch = (e) => {
        e.preventDefault();
        router.get(route('programming-languages.index'), { ...filters, search }, { preserveState: true, replace: true });
    };

    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        ProgrammingLanguages
                    </h2>
                    <Link
                        href={route('programming-languages.create')}
                        className="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
                    >
                        New ProgrammingLanguage
                    </Link>
                </div>
            }
        >
            <Head title="ProgrammingLanguages" />

            <div className="py-8">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <form onSubmit={submitSearch} className="mb-4 flex gap-2">
                        <TextInput
                            className="w-full max-w-xs"
                            placeholder="Search programminglanguages..."
                            value={search}
                            onChange={(e) => setSearch(e.target.value)}
                        />
                        <PrimaryButton type="submit">Search</PrimaryButton>
                    </form>

                    <div className="overflow-hidden rounded-lg bg-white shadow-sm">
                        {rows.length === 0 ? (
                            <div className="p-6">
                                <EmptyState
                                    title="No programminglanguages yet"
                                    description="Get started by creating your first record."
                                    actionHref={route('programming-languages.create')}
                                    actionLabel="New ProgrammingLanguage"
                                />
                            </div>
                        ) : (
                            <table className="min-w-full divide-y divide-gray-100 text-sm">
                                <thead className="bg-gray-50">
                                    <tr>
                                <th className="px-4 py-3 text-left font-semibold text-gray-600">Name</th>
                                        <th className="px-4 py-3 text-right font-semibold text-gray-600">Actions</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100">
                                    {rows.map((row) => (
                                        <tr key={row.id}>
                                <td className="px-4 py-3 text-gray-700">{row.name}</td>
                                            <td className="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                                                <Link href={route('programming-languages.show', row.id)} className="text-sm font-medium text-gray-600 hover:text-gray-900">View</Link>
                                                <Link href={route('programming-languages.edit', row.id)} className="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</Link>
                                                <ConfirmDeleteButton href={route('programming-languages.destroy', row.id)} />
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        )}
                    </div>

                    <Pagination meta={ programmingLanguages } />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
