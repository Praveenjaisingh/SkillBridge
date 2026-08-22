import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({  }) {
    const { data, setData, post, processing, errors } = useForm({
        user_id: '',
        title: '',
        file_path: '',
        is_primary: false,
    });

    const FIELDS = [
    { name: 'user_id', label: 'User', kind: 'number', required: true },
    { name: 'title', label: 'Title', kind: 'text', required: true },
    { name: 'file_path', label: 'File Path', kind: 'text', required: true },
    { name: 'is_primary', label: 'Is Primary', kind: 'checkbox', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        post(route('resumes.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New Resume
                </h2>
            }
        >
            <Head title="New Resume" />

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
                                <PrimaryButton disabled={processing}>Create Resume</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
