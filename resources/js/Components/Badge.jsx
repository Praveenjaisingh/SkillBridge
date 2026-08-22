const COLORS = {
    gray: 'bg-gray-100 text-gray-700 ring-gray-200',
    green: 'bg-emerald-100 text-emerald-700 ring-emerald-200',
    red: 'bg-rose-100 text-rose-700 ring-rose-200',
    amber: 'bg-amber-100 text-amber-700 ring-amber-200',
    indigo: 'bg-brand-100 text-brand-700 ring-brand-200',
    blue: 'bg-sky-100 text-sky-700 ring-sky-200',
};

export default function Badge({ color = 'gray', children }) {
    return (
        <span
            className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset ${COLORS[color] ?? COLORS.gray}`}
        >
            {children}
        </span>
    );
}
