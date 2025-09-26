<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ziada Submission #<?php echo intval($submission->id); ?></title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; color: #333; }
        .container { width: 90%; margin: auto; }
        h1, h2 { border-bottom: 2px solid #eee; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; width: 30%; }
        img { max-width: 150px; height: auto; border: 1px solid #ddd; padding: 4px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submission #<?php echo intval($submission->id); ?></h1>
        <button class="no-print" onclick="window.print();">Print this page</button>
        <?php if (isset($submission)) : ?>
            <!-- All submission data rendered in a clean, print-friendly format -->
        <?php else : ?>
            <p>Submission not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>