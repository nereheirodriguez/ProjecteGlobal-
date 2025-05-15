<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Push Notifications</title>
    <style>
        #notifications {
            max-width: 600px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .notification {
            padding: 10px;
            margin-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<h1>Push Notifications</h1>
<div id="notifications">
    <p>No notifications yet.</p>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
