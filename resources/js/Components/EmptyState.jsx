import { Link } from '@inertiajs/react';

export default function EmptyState({ title, description, actionHref, actionLabel }) {
    return (
        <div className="flex flex-col items-center justify-center rounded-2xl border border-dashed border-brand-200 bg-white/60 px-6 py-16 text-center shadow-soft">
            <div className="flex h-14 w-14 items-center justify-center rounded-full bg-brand-gradient text-white shadow-glow">
                <svg
                    className="h-7 w-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    strokeWidth="1.5"
                    stroke="currentColor"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        d="M9 13.5h6m-6 3h6M6.75 4.5h10.5A2.25 2.25 0 0 1 19.5 6.75v12a1.5 1.5 0 0 1-2.152 1.352L12 17.5l-5.348 2.602A1.5 1.5 0 0 1 4.5 18.75v-12a2.25 2.25 0 0 1 2.25-2.25Z"
                    />
                </svg>
            </div>
            <h3 className="mt-4 text-sm font-semibold text-gray-900">{title}</h3>
            {description && (
                <p className="mt-1 text-sm text-gray-500">{description}</p>
            )}
            {actionHref && (
                <Link
                    href={actionHref}
                    className="mt-6 inline-flex items-center rounded-lg bg-brand-gradient px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-glow transition hover:shadow-lg"
                >
                    {actionLabel}
                </Link>
            )}
        </div>
    );
}
