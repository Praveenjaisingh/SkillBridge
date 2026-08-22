import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({ skills, companies }) {
    const { data, setData, post, processing, errors } = useForm({
        company_id: '',
        title: '',
        slug: '',
        description: '',
        requirements: '',
        location: '',
        job_type: '',
        experience_level: '',
        salary_min: '',
        salary_max: '',
        is_active: false,
        skills: [],
    });

    const FIELDS = [
    { name: 'company_id', label: 'Company', kind: 'select', required: true, options: (companies || []).map((o) => ({ value: o.id, label: o.name })) },
    { name: 'title', label: 'Title', kind: 'text', required: true },
    { name: 'slug', label: 'Slug', kind: 'text', required: false },
    { name: 'description', label: 'Description', kind: 'textarea', required: true },
    { name: 'requirements', label: 'Requirements', kind: 'textarea', required: false },
    { name: 'location', label: 'Location', kind: 'text', required: false },
    { name: 'job_type', label: 'Job Type', kind: 'text', required: false },
    { name: 'experience_level', label: 'Experience Level', kind: 'text', required: false },
    { name: 'salary_min', label: 'Salary Min', kind: 'number', required: false },
    { name: 'salary_max', label: 'Salary Max', kind: 'number', required: false },
    { name: 'is_active', label: 'Is Active', kind: 'checkbox', required: false },
    { name: 'skills', label: 'Skills', kind: 'multiselect', required: false, options: (skills || []).map((o) => ({ value: o.id, label: o.name })) },
];

    const submit = (e) => {
        e.preventDefault();
        post(route('jobs.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New Job
                </h2>
            }
        >
            <Head title="New Job" />

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
                                <Link href={route('jobs.index')}>
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={processing}>Create Job</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
