import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({ courses }) {
    const { data, setData, post, processing, errors } = useForm({
        course_id: '',
        title: '',
        slug: '',
        content: '',
        video_url: '',
        order: '',
        duration_minutes: '',
    });

    const FIELDS = [
    { name: 'course_id', label: 'Course', kind: 'select', required: true, options: (courses || []).map((o) => ({ value: o.id, label: o.title })) },
    { name: 'title', label: 'Title', kind: 'text', required: true },
    { name: 'slug', label: 'Slug', kind: 'text', required: false },
    { name: 'content', label: 'Content', kind: 'textarea', required: false },
    { name: 'video_url', label: 'Video Url', kind: 'text', required: false },
    { name: 'order', label: 'Order', kind: 'number', required: false },
    { name: 'duration_minutes', label: 'Duration Minutes', kind: 'number', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        post(route('lessons.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New Lesson
                </h2>
            }
        >
            <Head title="New Lesson" />

            <div className="py-8">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <div className="rounded-lg bg-white p-6 shadow-sm">
                        <form onSubmit={submit}>
                            {FIELDS.map((field) => (
                                <DynamicField
                                    key={field.name}
                                    field={field}
                                    value={data[field.name]}
                                    onChange={(val) => setData(field.name, val)}
                                    error={errors[field.name]}
                                />
                            ))}

                            <div className="mt-6 flex items-center justify-end gap-3">
                                <Link href={route('lessons.index')}>
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={processing}>Create Lesson</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
