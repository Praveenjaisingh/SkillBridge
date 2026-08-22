import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({  }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        slug: '',
        icon: '',
        description: '',
    });

    const FIELDS = [
    { name: 'name', label: 'Name', kind: 'text', required: true },
    { name: 'slug', label: 'Slug', kind: 'text', required: false },
    { name: 'icon', label: 'Icon', kind: 'text', required: false },
    { name: 'description', label: 'Description', kind: 'textarea', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        post(route('programming-languages.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New ProgrammingLanguage
                </h2>
            }
        >
            <Head title="New ProgrammingLanguage" />

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
                                <Link href={route('programming-languages.index')}>
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={processing}>Create ProgrammingLanguage</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
