import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    return (
        <div className="relative flex min-h-screen flex-col items-center overflow-hidden bg-brand-radial pt-6 sm:justify-center sm:pt-0">
            <div className="pointer-events-none absolute -top-32 -left-32 h-96 w-96 rounded-full bg-brand-300/30 blur-3xl" />
            <div className="pointer-events-none absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-accent-300/30 blur-3xl" />

            <div className="relative z-10">
                <Link href="/" className="flex items-center gap-2">
                    <ApplicationLogo className="h-11 w-11" />
                    <span className="text-xl font-bold tracking-tight text-brand-900">
                        SkillBridge
                    </span>
                </Link>
            </div>

            <div className="relative z-10 mt-6 w-full overflow-hidden rounded-2xl border border-white/60 bg-white/90 px-6 py-8 shadow-card backdrop-blur-sm sm:max-w-md">
                {children}
            </div>
        </div>
    );
}
