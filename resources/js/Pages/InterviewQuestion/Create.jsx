import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { Link } from '@inertiajs/react';

export default function Create({ programmingLanguages, skills }) {
    const { data, setData, post, processing, errors } = useForm({
        skill_id: '',
        programming_language_id: '',
        question: '',
        answer: '',
        difficulty: '',
        category: '',
    });

    const FIELDS = [
    { name: 'skill_id', label: 'Skill', kind: 'select', required: false, options: (skills || []).map((o) => ({ value: o.id, label: o.name })) },
    { name: 'programming_language_id', label: 'Programming Language', kind: 'select', required: false, options: (programmingLanguages || []).map((o) => ({ value: o.id, label: o.name })) },
    { name: 'question', label: 'Question', kind: 'textarea', required: true },
    { name: 'answer', label: 'Answer', kind: 'textarea', required: false },
    { name: 'difficulty', label: 'Difficulty', kind: 'text', required: false },
    { name: 'category', label: 'Category', kind: 'text', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        post(route('interview-questions.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    New InterviewQuestion
                </h2>
            }
        >
            <Head title="New InterviewQuestion" />

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
                                <Link href={route('interview-questions.index')}>
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                                <PrimaryButton disabled={processing}>Create InterviewQuestion</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
