import { Link } from '@inertiajs/react';

export default function Pagination({ meta }) {
    if (!meta || !meta.links || meta.links.length <= 3) {
        return null;
    }

    return (
        <nav className="mt-4 flex flex-wrap items-center justify-between gap-2">
            <p className="text-sm text-gray-500">
                Showing <span className="font-semibold text-gray-700">{meta.from ?? 0}</span> to{' '}
                <span className="font-semibold text-gray-700">{meta.to ?? 0}</span> of{' '}
                <span className="font-semibold text-gray-700">{meta.total ?? 0}</span> results
            </p>
            <div className="flex flex-wrap gap-1">
                {meta.links.map((link, i) => (
                    <Link
                        key={i}
                        href={link.url || '#'}
                        preserveScroll
                        dangerouslySetInnerHTML={{ __html: link.label }}
                        className={`rounded-lg px-3 py-1.5 text-sm font-medium transition ${
                            link.active
                                ? 'bg-brand-gradient text-white shadow-glow'
                                : link.url
                                  ? 'border border-gray-200 bg-white text-gray-700 hover:border-brand-300 hover:bg-brand-50'
                                  : 'cursor-not-allowed border border-gray-100 text-gray-300'
                        }`}
                    />
                ))}
            </div>
        </nav>
    );
}
