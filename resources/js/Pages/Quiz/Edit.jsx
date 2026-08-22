import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm, Link } from '@inertiajs/react';
import DynamicField from '@/Components/DynamicField';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Edit({ quiz, courses }) {
    const { data, setData, put, processing, errors, transform } = useForm({
        course_id: quiz.course_id ?? '',
        title: quiz.title ?? '',
        description: quiz.description ?? '',
        questions: quiz.questions ? JSON.stringify(quiz.questions, null, 2) : '',
        passing_score: quiz.passing_score ?? '',
        time_limit_minutes: quiz.time_limit_minutes ?? '',
    });

    const FIELDS = [
    { name: 'course_id', label: 'Course', kind: 'select', required: false, options: (courses || []).map((o) => ({ value: o.id, label: o.title })) },
    { name: 'title', label: 'Title', kind: 'text', required: true },
    { name: 'description', label: 'Description', kind: 'textarea', required: false },
    { name: 'questions', label: 'Questions', kind: 'json', required: false },
    { name: 'passing_score', label: 'Passing Score', kind: 'number', required: false },
    { name: 'time_limit_minutes', label: 'Time Limit Minutes', kind: 'number', required: false },
];

    const submit = (e) => {
        e.preventDefault();
        try {
            transform((current) => ({
                ...current,
                questions: current.questions ? JSON.parse(current.questions) : [],
            }));
        } catch (err) {
            alert('Please enter valid JSON.');
            return;
        }
        put(route('quizzes.update', quiz.id));
    };

    if (!quiz) {
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
                    Edit Quiz
                </h2>
            }
        >
            <Head title="Edit Quiz" />

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
                                <Link href={route('quizzes.index')}>
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
