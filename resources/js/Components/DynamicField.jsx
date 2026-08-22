import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import SelectInput from '@/Components/SelectInput';
import TextArea from '@/Components/TextArea';
import TextInput from '@/Components/TextInput';

/**
 * Renders a single form field based on a declarative field descriptor.
 *
 * field: {
 *   name, label, kind: 'text'|'textarea'|'number'|'decimal'|'checkbox'|'select'|'multiselect'|'json',
 *   options?: [{ value, label }], required?: boolean
 * }
 */
export default function DynamicField({ field, value, onChange, error }) {
    const inputId = `field-${field.name}`;

    if (field.kind === 'checkbox') {
        return (
            <div className="mt-4">
                <label className="flex items-center gap-2">
                    <Checkbox
                        checked={!!value}
                        onChange={(e) => onChange(e.target.checked)}
                    />
                    <span className="text-sm text-gray-700">{field.label}</span>
                </label>
                <InputError message={error} className="mt-2" />
            </div>
        );
    }

    if (field.kind === 'select') {
        return (
            <div className="mt-4">
                <InputLabel htmlFor={inputId} value={field.label} />
                <SelectInput
                    id={inputId}
                    className="mt-1 block w-full"
                    value={value ?? ''}
                    onChange={(e) => onChange(e.target.value)}
                >
                    <option value="">Select {field.label}</option>
                    {(field.options || []).map((opt) => (
                        <option key={opt.value} value={opt.value}>
                            {opt.label}
                        </option>
                    ))}
                </SelectInput>
                <InputError message={error} className="mt-2" />
            </div>
        );
    }

    if (field.kind === 'multiselect') {
        const selected = Array.isArray(value) ? value.map(String) : [];
        const toggle = (val) => {
            const strVal = String(val);
            if (selected.includes(strVal)) {
                onChange(selected.filter((v) => v !== strVal).map(Number));
            } else {
                onChange([...selected, strVal].map(Number));
            }
        };

        return (
            <div className="mt-4">
                <InputLabel value={field.label} />
                <div className="mt-2 flex flex-wrap gap-2 rounded-md border border-gray-200 p-3">
                    {(field.options || []).length === 0 && (
                        <p className="text-sm text-gray-400">No options available.</p>
                    )}
                    {(field.options || []).map((opt) => {
                        const isChecked = selected.includes(String(opt.value));
                        return (
                            <button
                                type="button"
                                key={opt.value}
                                onClick={() => toggle(opt.value)}
                                className={`rounded-full px-3 py-1 text-xs font-medium transition ${
                                    isChecked
                                        ? 'bg-gray-800 text-white'
                                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                                }`}
                            >
                                {opt.label}
                            </button>
                        );
                    })}
                </div>
                <InputError message={error} className="mt-2" />
            </div>
        );
    }

    if (field.kind === 'textarea' || field.kind === 'json') {
        return (
            <div className="mt-4">
                <InputLabel htmlFor={inputId} value={field.label} />
                <TextArea
                    id={inputId}
                    className="mt-1 block w-full"
                    value={value ?? ''}
                    onChange={(e) => onChange(e.target.value)}
                    rows={field.kind === 'json' ? 6 : 4}
                />
                {field.kind === 'json' && (
                    <p className="mt-1 text-xs text-gray-400">
                        Enter valid JSON, e.g. [{'{'}"question":"...","options":["A","B"],"correct_index":0{'}'}]
                    </p>
                )}
                <InputError message={error} className="mt-2" />
            </div>
        );
    }

    return (
        <div className="mt-4">
            <InputLabel htmlFor={inputId} value={field.label} />
            <TextInput
                id={inputId}
                type={field.kind === 'number' || field.kind === 'decimal' ? 'number' : 'text'}
                step={field.kind === 'decimal' ? '0.01' : undefined}
                className="mt-1 block w-full"
                value={value ?? ''}
                onChange={(e) => onChange(e.target.value)}
            />
            <InputError message={error} className="mt-2" />
        </div>
    );
}
