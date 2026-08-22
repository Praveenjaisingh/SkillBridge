import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ interviewQuestion, programmingLanguages, skills }) {
    const { data, setData, put, processing, errors } = useForm({
        skill_id: interviewQuestion.skill_id ?? '',
        programming_language_id: interviewQuestion.programming_language_id ?? '',
        question: interviewQuestion.question ?? '',
        answer: interviewQuestion.answer ?? '',
        difficulty: interviewQuestion.difficulty ?? '',
        category: interviewQuestion.category ?? '',
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
        put(route('interview-questions.update', interviewQuestion.id));
    };

    if (!interviewQuestion) {
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
                    Edit InterviewQuestion
                </h2>
            }
        >
            <Head title="Edit InterviewQuestion" />

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
                                <PrimaryButton disabled={processing}>Save Changes</PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
