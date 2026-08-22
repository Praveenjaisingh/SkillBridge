export default function PrimaryButton({
    className = '',
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={
                `inline-flex items-center justify-center rounded-lg border border-transparent bg-brand-gradient bg-[length:160%_160%] bg-left px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-white shadow-glow transition-all duration-200 ease-in-out hover:bg-right hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-brand-400 focus:ring-offset-2 active:scale-[0.98] ${
                    disabled && 'cursor-not-allowed opacity-40'
                } ` + className
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}
