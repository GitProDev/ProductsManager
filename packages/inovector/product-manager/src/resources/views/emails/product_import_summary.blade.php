<!DOCTYPE html>
<html>
<head>
    <title>Product Import Summary</title>
</head>
<body>
    <p>Number of products successfully imported: {{ $successCount }}</p>
    <p>Number of failed imports: {{ $failureCount }}</p>

    @if ($failureCount > 0)
        <p>Download the report of failed imports: <a href="{{ url(Storage::url($reportPath)) }}">Failed Imports Report</a></p>
    @endif
</body>
</html>
