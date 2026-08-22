import { usePage } from '@inertiajs/react';

export default function FlashMessages() {
    const { flash } = usePage().props;

    if (!flash?.success && !flash?.error) {
        return null;
    }

    return (
        <div className="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
            {flash.success && (
                <div className="flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 shadow-soft">
                    <svg className="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" strokeWidth="2" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {flash.success}
                </div>
            )}
            {flash.error && (
                <div className="mt-2 flex items-center gap-2 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700 shadow-soft">
                    <svg className="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" strokeWidth="2" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    {flash.error}
                </div>
            )}
        </div>
    );
}
