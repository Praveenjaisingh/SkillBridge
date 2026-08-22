import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({ jobs }) {
    const { data, setData, post, processing, errors } = useForm({
        job_id: '',
        user_id: '',
        resume_id: '',
        cover_letter: '',
        status: '',
    });

    const FIELDS = [
    { name: 'job_id', label: 'Job', kind: 'select', required: true, options: (jobs || []).map((o) => ({ value: o.id, label: o.title })) },
    { name: 'user_id', label: 'User', kind: 'number', required: true },
    { name: 'resume_id', label: 'Resume', kind: 'number', required: false },
    { name: 'cover_letter', label: 'Cover Letter', kind: 'textarea', required: false },
    { name: 'status', label: 'Status', kind: 'text', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        post(route('job-applications.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New JobApplication
                </h2>
            }
        >
            <Head title="New JobApplication" />

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
                                <Link href={route('job-applications.index')}>
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={processing}>Create JobApplication</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
