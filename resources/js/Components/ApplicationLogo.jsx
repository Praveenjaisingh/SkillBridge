export default function ApplicationLogo(props) {
    return (
        <svg
            {...props}
            viewBox="0 0 40 40"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
        >
            <defs>
                <linearGradient id="logoGradient" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stopColor="#7057ee" />
                    <stop offset="50%" stopColor="#a855f7" />
                    <stop offset="100%" stopColor="#6238e0" />
                </linearGradient>
            </defs>
            <rect x="2" y="2" width="36" height="36" rx="10" fill="url(#logoGradient)" />
            <path
                d="M12 27V14L20 18.7L28 14V27"
                stroke="white"
                strokeWidth="2.4"
                strokeLinecap="round"
                strokeLinejoin="round"
            />
            <circle cx="20" cy="18.7" r="1.6" fill="white" />
        </svg>
    );
}
