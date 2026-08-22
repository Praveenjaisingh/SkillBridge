import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ resume }) {
    const { data, setData, put, processing, errors } = useForm({
        user_id: resume.user_id ?? '',
        title: resume.title ?? '',
        file_path: resume.file_path ?? '',
        is_primary: resume.is_primary ?? false,
    });

    const FIELDS = [
    { name: 'user_id', label: 'User', kind: 'number', required: true },
    { name: 'title', label: 'Title', kind: 'text', required: true },
    { name: 'file_path', label: 'File Path', kind: 'text', required: true },
    { name: 'is_primary', label: 'Is Primary', kind: 'checkbox', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        put(route('resumes.update', resume.id));
    };

    if (!resume) {
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
                    Edit Resume
                </h2>
            }
        >
            <Head title="Edit Resume" />

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
                                <Link href={route('resumes.index')}>
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
