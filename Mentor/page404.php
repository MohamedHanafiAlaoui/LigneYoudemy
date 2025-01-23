<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .page_404 {
            text-align: center;
            max-width: 600px;
            margin: auto;
        }

        .page_404 img {
            width: 100%;
            max-width: 400px;
        }

        .page_404 h1 {
            font-size: 100px;
            margin: 20px 0;
            color: #ff6b6b;
        }

        .page_404 h3 {
            font-size: 24px;
            color: #555;
            margin-bottom: 10px;
        }

        .page_404 p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .page_404 a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .page_404 a:hover {
            background: #0056b3;
        }

        @media (max-width: 768px) {
            .page_404 h1 {
                font-size: 70px;
            }

            .page_404 h3 {
                font-size: 20px;
            }

            .page_404 p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="page_404">

        <h1>404</h1>
        <h3>Oops! Page Not Found</h3>
        <p>We can't seem to find the page you're looking for. It might have been moved or deleted.</p>
        <a href="/">Go Back Home</a>
    </div>
</body>
</html>
