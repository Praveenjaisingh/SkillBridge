import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ company }) {
    const { data, setData, put, processing, errors } = useForm({
        name: company.name ?? '',
        slug: company.slug ?? '',
        description: company.description ?? '',
        website: company.website ?? '',
        logo: company.logo ?? '',
        location: company.location ?? '',
        industry: company.industry ?? '',
    });

    const FIELDS = [
    { name: 'name', label: 'Name', kind: 'text', required: true },
    { name: 'slug', label: 'Slug', kind: 'text', required: false },
    { name: 'description', label: 'Description', kind: 'textarea', required: false },
    { name: 'website', label: 'Website', kind: 'text', required: false },
    { name: 'logo', label: 'Logo', kind: 'text', required: false },
    { name: 'location', label: 'Location', kind: 'text', required: false },
    { name: 'industry', label: 'Industry', kind: 'text', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        put(route('companies.update', company.id));
    };

    if (!company) {
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
                    Edit Company
                </h2>
            }
        >
            <Head title="Edit Company" />

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
                                <Link href={route('companies.index')}>
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
