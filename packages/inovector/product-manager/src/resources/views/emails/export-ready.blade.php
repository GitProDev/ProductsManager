<!DOCTYPE html>
<html>
<head>
    <title>Your Product Export is Ready</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9fafb; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 6px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #111111;">Your Product Export is Ready</h2>

        <p>Hi there,</p>

        <p>Your filtered product export is complete. Click the button below to download your CSV file:</p>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ $downloadUrl }}" style="display: inline-block; padding: 12px 24px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 4px; font-weight: bold;">
                Download CSV
            </a>
        </p>

        <p>If the button doesn't work, you can also use this direct link:</p>
        <p><a href="{{ $downloadUrl }}">{{ $downloadUrl }}</a></p>

        <p style="margin-top: 40px;">Thanks,<br>{{ config('app.name') }}</p>
    </div>
</body>
</html>