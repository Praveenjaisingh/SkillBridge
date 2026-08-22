import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ bookmark }) {
    const { data, setData, put, processing, errors } = useForm({
        user_id: bookmark.user_id ?? '',
        bookmarkable_id: bookmark.bookmarkable_id ?? '',
        bookmarkable_type: bookmark.bookmarkable_type ?? '',
    });

    const FIELDS = [
    { name: 'user_id', label: 'User', kind: 'number', required: true },
    { name: 'bookmarkable_id', label: 'Bookmarkable', kind: 'number', required: true },
    { name: 'bookmarkable_type', label: 'Bookmarkable Type', kind: 'text', required: true },
];

    const submit = (e) => {
        e.preventDefault();
        put(route('bookmarks.update', bookmark.id));
    };

    if (!bookmark) {
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
                    Edit Bookmark
                </h2>
            }
        >
            <Head title="Edit Bookmark" />

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
                                <Link href={route('bookmarks.index')}>
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
