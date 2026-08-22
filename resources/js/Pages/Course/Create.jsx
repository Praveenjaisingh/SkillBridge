import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({ programmingLanguages, skills }) {
    const { data, setData, post, processing, errors } = useForm({
        programming_language_id: '',
        title: '',
        slug: '',
        description: '',
        thumbnail: '',
        level: '',
        duration_hours: '',
        price: '',
        is_published: false,
        skills: [],
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
        post(route('courses.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New Course
                </h2>
            }
        >
            <Head title="New Course" />

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
                                <PrimaryButton disabled={processing}>Create Course</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
