import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import ConfirmDeleteButton from '@/Components/ConfirmDeleteButton';

export default function Show({ bookmark }) {
    if (!bookmark) {
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
                        Bookmark #{bookmark.id}
                    </h2>
                    <div className="flex items-center gap-4">
                        <Link href={route('bookmarks.edit', bookmark.id)} className="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</Link>
                        <ConfirmDeleteButton href={route('bookmarks.destroy', bookmark.id)} />
                    </div>
                </div>
            }
        >
            <Head title={`Bookmark #${bookmark.id}`} />

            <div className="py-8">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <div className="rounded-lg bg-white p-6 shadow-sm">
                        <dl>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">User</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(bookmark.user_id ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Bookmarkable</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(bookmark.bookmarkable_id ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Bookmarkable Type</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(bookmark.bookmarkable_type ?? '—')}</dd>
                        </div>
                        </dl>
                    </div>
                    <Link href={route('bookmarks.index')} className="mt-4 inline-block text-sm text-gray-500 hover:text-gray-800">
                        &larr; Back to Bookmarks
                    </Link>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
