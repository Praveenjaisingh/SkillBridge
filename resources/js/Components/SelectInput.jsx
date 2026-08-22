import { forwardRef } from 'react';

export default forwardRef(function SelectInput(
    { className = '', children, ...props },
    ref,
) {
    return (
        <select
            {...props}
            ref={ref}
            className={
                'rounded-lg border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-brand-500 focus:ring-brand-500 ' +
                className
            }
        >
            {children}
        </select>
    );
});
