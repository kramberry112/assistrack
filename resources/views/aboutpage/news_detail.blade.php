<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $item['title'] ?? 'News Detail' }}</title>
    <style>
        body { background: #f4f7fb; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; }
        .container { max-width: 700px; margin: 0 auto; padding: 32px 0; }
        .title { font-size: 2rem; font-weight: bold; color: #222; margin-bottom: 8px; }
        .meta { color: #888; font-size: 15px; margin-bottom: 18px; }
        .news-image { width: 100%; max-width: 480px; display: block; margin: 0 auto 18px auto; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.09); }
        .desc { font-size: 17px; color: #222; margin-top: 18px; line-height: 1.7; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">{{ $item['title'] ?? '' }}</div>
        <div class="meta">{{ $item['date'] ?? '' }}</div>
        <img src="{{ asset($item['image'] ?? '') }}" alt="news image" class="news-image">
        <div class="desc">
            {{ $item['description'] ?? '' }}
        </div>
    </div>
</body>
</html>
