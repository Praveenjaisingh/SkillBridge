import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ jobApplication, jobs }) {
    const { data, setData, put, processing, errors } = useForm({
        job_id: jobApplication.job_id ?? '',
        user_id: jobApplication.user_id ?? '',
        resume_id: jobApplication.resume_id ?? '',
        cover_letter: jobApplication.cover_letter ?? '',
        status: jobApplication.status ?? '',
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
        put(route('job-applications.update', jobApplication.id));
    };

    if (!jobApplication) {
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
                    Edit JobApplication
                </h2>
            }
        >
            <Head title="Edit JobApplication" />

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
                                <PrimaryButton disabled={processing}>Save Changes</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
