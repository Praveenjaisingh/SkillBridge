export default function DangerButton({
    className = '',
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={
                `inline-flex items-center justify-center rounded-lg border border-transparent bg-gradient-to-r from-rose-600 to-red-500 px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:from-rose-500 hover:to-red-400 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 active:scale-[0.98] ${
                    disabled && 'opacity-40'
                } ` + className
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}
