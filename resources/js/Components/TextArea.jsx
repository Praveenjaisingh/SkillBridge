import { forwardRef, useEffect, useImperativeHandle, useRef } from 'react';

export default forwardRef(function TextArea(
    { className = '', isFocused = false, rows = 4, ...props },
    ref,
) {
    const localRef = useRef(null);

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    useEffect(() => {
        if (isFocused) {
            localRef.current?.focus();
        }
    }, [isFocused]);

    return (
        <textarea
            {...props}
            rows={rows}
            className={
                'rounded-lg border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-brand-500 focus:ring-brand-500 ' +
                className
            }
            ref={localRef}
        />
    );
});
