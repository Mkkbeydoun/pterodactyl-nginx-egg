<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web server is running</title>
    <style>
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: #f4f6fa;
            color: #1f2933;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 16px;
            box-sizing: border-box;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 40px;
            max-width: 560px;
            width: 100%;
            text-align: center;
        }
        h1 { margin: 0 0 12px; font-size: 1.8em; }
        p { margin: 0 0 20px; color: #52606d; }
        .versions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .versions span {
            background: #2563eb;
            color: #fff;
            border-radius: 6px;
            padding: 8px 14px;
            font-weight: 600;
        }
        code { background: #eef2f7; padding: 2px 6px; border-radius: 4px; }
    </style>
</head>
<body>
<div class="card">
    <h1>Web server is running</h1>
    <p>Upload your website into the <code>webroot</code> folder to replace this page.</p>
    <div class="versions">
        <span>PHP <?php echo htmlspecialchars(PHP_VERSION); ?></span>
        <span><?php echo htmlspecialchars($_SERVER['SERVER_SOFTWARE'] ?? 'nginx'); ?></span>
    </div>
</div>
</body>
</html>
