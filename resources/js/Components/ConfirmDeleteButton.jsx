import { router } from '@inertiajs/react';

export default function ConfirmDeleteButton({ href, label = 'Delete', confirmText = 'Delete this item? This cannot be undone.' }) {
    const handleClick = () => {
        if (confirm(confirmText)) {
            router.delete(href, { preserveScroll: true });
        }
    };

    return (
        <button
            type="button"
            onClick={handleClick}
            className="text-sm font-medium text-rose-600 hover:text-rose-800"
        >
            {label}
        </button>
    );
}
