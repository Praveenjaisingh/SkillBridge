import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import ConfirmDeleteButton from '@/Components/ConfirmDeleteButton';

export default function Show({ lesson }) {
    if (!lesson) {
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
                        Lesson #{lesson.id}
                    </h2>
                    <div className="flex items-center gap-4">
                        <Link href={route('lessons.edit', lesson.id)} className="text-sm font-medium text-indigo-600 hover:text-indigo-800">Edit</Link>
                        <ConfirmDeleteButton href={route('lessons.destroy', lesson.id)} />
                    </div>
                </div>
            }
        >
            <Head title={`Lesson #${lesson.id}`} />

            <div className="py-8">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <div className="rounded-lg bg-white p-6 shadow-sm">
                        <dl>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Course</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.course?.title ?? lesson.course_id ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Title</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.title ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Slug</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.slug ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Content</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.content ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Video Url</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.video_url ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Order</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.order ?? '—')}</dd>
                        </div>
                        <div className="border-b border-gray-100 py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt className="text-sm font-medium text-gray-500">Duration Minutes</dt>
                            <dd className="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 whitespace-pre-wrap">{(lesson.duration_minutes ?? '—')}</dd>
                        </div>
                        </dl>
                    </div>
                    <Link href={route('lessons.index')} className="mt-4 inline-block text-sm text-gray-500 hover:text-gray-800">
                        &larr; Back to Lessons
                    </Link>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
