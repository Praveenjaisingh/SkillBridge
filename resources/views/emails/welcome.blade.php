<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to SkillBridge</title>
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
                                    🚀
                                </td>
                            </tr>
                        </table>
                        <h1 style="margin:0; color:#ffffff; font-size:24px; font-weight:700;">Welcome to SkillBridge!</h1>
                        <p style="margin:8px 0 0; color:rgba(255,255,255,0.9); font-size:15px;">Your journey to your next tech role starts here.</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 32px;">
                        <p style="margin:0 0 16px; font-size:16px; color:#1f2937;">Hi {{ $user->name }},</p>
                        <p style="margin:0 0 16px; font-size:15px; line-height:1.6; color:#4b5563;">
                            Your account has been created successfully. We're excited to have you on board! SkillBridge gives you everything you need to learn, practice, and land your next job in tech:
                        </p>

                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                            <tr>
                                <td style="padding:10px 0; font-size:14px; color:#374151;">📚&nbsp;&nbsp;Structured courses across dozens of programming languages</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0; font-size:14px; color:#374151;">🧠&nbsp;&nbsp;Coding problems and quizzes to sharpen your skills</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0; font-size:14px; color:#374151;">💼&nbsp;&nbsp;Real job postings you can apply to directly</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0; font-size:14px; color:#374151;">📝&nbsp;&nbsp;Resume tools and interview question banks</td>
                            </tr>
                        </table>

                        <table role="presentation" cellpadding="0" cellspacing="0" style="margin: 24px 0;">
                            <tr>
                                <td style="border-radius:10px; background: linear-gradient(135deg, #7057ee 0%, #6238e0 100%);">
                                    <a href="{{ $dashboardUrl }}" style="display:inline-block; padding:12px 28px; font-size:14px; font-weight:600; color:#ffffff; text-decoration:none; letter-spacing:0.03em;">
                                        Go to your dashboard
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin: 24px 0 0; font-size:13px; line-height:1.6; color:#9ca3af;">
                            If you didn't create this account, you can safely ignore this email.
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
