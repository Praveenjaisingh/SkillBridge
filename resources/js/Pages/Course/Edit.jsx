import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ course, programmingLanguages, skills }) {
    const { data, setData, put, processing, errors } = useForm({
        programming_language_id: course.programming_language_id ?? '',
        title: course.title ?? '',
        slug: course.slug ?? '',
        description: course.description ?? '',
        thumbnail: course.thumbnail ?? '',
        level: course.level ?? '',
        duration_hours: course.duration_hours ?? '',
        price: course.price ?? '',
        is_published: course.is_published ?? false,
        skills: (course.skills || []).map((s) => s.id),
    });

    const FIELDS = [
    { name: 'programming_language_id', label: 'Programming Language', kind: 'select', required: false, options: (programmingLanguages || []).map((o) => ({ value: o.id, label: o.name })) },
    { name: 'title', label: 'Title', kind: 'text', required: true },
    { name: 'slug', label: 'Slug', kind: 'text', required: false },
    { name: 'description', label: 'Description', kind: 'textarea', required: false },
    { name: 'thumbnail', label: 'Thumbnail', kind: 'text', required: false },
    { name: 'level', label: 'Level', kind: 'text', required: false },
    { name: 'duration_hours', label: 'Duration Hours', kind: 'number', required: false },
    { name: 'price', label: 'Price', kind: 'decimal', required: false },
    { name: 'is_published', label: 'Is Published', kind: 'checkbox', required: false },
    { name: 'skills', label: 'Skills', kind: 'multiselect', required: false, options: (skills || []).map((o) => ({ value: o.id, label: o.name })) },
];

    const submit = (e) => {
        e.preventDefault();
        put(route('courses.update', course.id));
    };

    if (!course) {
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
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Edit Course
                </h2>
            }
        >
            <Head title="Edit Course" />

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
                                <Link href={route('courses.index')}>
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={processing}>Save Changes</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
