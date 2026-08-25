<!-- Place this file at: resources/views/emails/reset-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset your password</title>
</head>
<body style="margin:0; padding:0; background-color:#f2f4ff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f2f4ff; padding: 32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow: 0 4px 20px rgba(56, 33, 124, 0.15);">

                <tr>
                    <td style="background: linear-gradient(135deg, #7057ee 0%, #a855f7 50%, #6238e0 100%); padding: 40px 32px; text-align:center;">
                        <table role="presentation" cellpadding="0" cellspacing="0" style="margin: 0 auto 16px;">
                            <tr>
                                <td style="width:56px; height:56px; background-color:rgba(255,255,255,0.18); border-radius:14px; text-align:center; vertical-align:middle; font-size:28px;">
                                    🔑
                                </td>
                            </tr>
                        </table>
                        <h1 style="margin:0; color:#ffffff; font-size:24px; font-weight:700;">Reset your password</h1>
                        <p style="margin:8px 0 0; color:rgba(255,255,255,0.9); font-size:15px;">We got a request to reset your password.</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 32px;">
                        <p style="margin:0 0 16px; font-size:16px; color:#1f2937;">Hi {{ $user->name }},</p>
                        <p style="margin:0 0 24px; font-size:15px; line-height:1.6; color:#4b5563;">
                            Someone requested a password reset for your SkillBridge account. Click the button below to choose a new password. This link will expire in 60 minutes.
                        </p>

                        <table role="presentation" cellpadding="0" cellspacing="0" style="margin: 0 0 24px;">
                            <tr>
                                <td style="border-radius:10px; background: linear-gradient(135deg, #7057ee 0%, #6238e0 100%);">
                                    <a href="{{ $resetUrl }}" style="display:inline-block; padding:12px 28px; font-size:14px; font-weight:600; color:#ffffff; text-decoration:none; letter-spacing:0.03em;">
                                        Reset password
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 8px; font-size:13px; line-height:1.6; color:#9ca3af;">
                            If the button above doesn't work, copy and paste this link into your browser:
                        </p>
                        <p style="margin:0 0 24px; font-size:13px; line-height:1.6; word-break:break-all;">
                            <a href="{{ $resetUrl }}" style="color:#7057ee;">{{ $resetUrl }}</a>
                        </p>

                        <p style="margin:0; font-size:13px; line-height:1.6; color:#9ca3af;">
                            If you didn't request a password reset, no action is needed — your password will remain unchanged.
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 20px 32px; background-color:#f9fafb; text-align:center; border-top:1px solid #f0f0f5;">
                        <p style="margin:0; font-size:12px; color:#9ca3af;">&copy; {{ date('Y') }} SkillBridge. All rights reserved.</p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>