<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ziada Submission #<?php echo $submission->id; ?></title>
    <style>
        body { font-family: sans-serif; }
        h1, h2, h3 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Submission Details</h1>
    <?php if (isset($submission)) : ?>
        <!-- All submission data rendered in a print-friendly format -->
    <?php else : ?>
        <p>Submission not found.</p>
    <?php endif; ?>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>