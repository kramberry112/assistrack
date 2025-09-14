<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $item['title'] ?? 'Event Detail' }}</title>
    <style>
        body {
            background: #f4f7fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 0;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.09);
            overflow: hidden;
        }
        .header {
            padding: 32px 32px 0 32px;
            text-align: center;
        }
        .title {
            font-size: 2rem;
            font-weight: bold;
            color: #222;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .meta {
            color: #888;
            font-size: 15px;
            margin-bottom: 18px;
        }
        .news-image {
            width: 100%;
            max-width: 480px;
            display: block;
            margin: 0 auto 18px auto;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.09);
            transition: transform 0.2s;
        }
        .news-image:hover {
            transform: scale(1.03);
        }
        .desc {
            font-size: 17px;
            color: #222;
            margin: 0 32px 32px 32px;
            line-height: 1.7;
            background: #f4f7fb;
            border-radius: 10px;
            padding: 18px;
        }
        .btn-back {
            display: inline-block;
            margin: 0 0 24px 32px;
            padding: 10px 22px;
            background: #888;
            color: #fff;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.09);
            text-decoration: none;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-back:hover {
            background: #222;
            box-shadow: 0 4px 16px rgba(0,0,0,0.13);
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn-back">&#8592; Back</a>
        <div class="header">
            <div class="title">{{ $item['title'] ?? '' }}</div>
            <div class="meta">{{ $item['date'] ?? '' }}</div>
            <img src="{{ asset($item['images'][0]) }}" alt="Event Image" class="news-image">
        </div>
        <div class="desc">
            {{ $item['description'] ?? '' }}
        </div>
    </div>
</body>
</html>
