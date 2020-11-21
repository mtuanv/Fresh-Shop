<!DOCTYPE html>
<html>
<head>
    <title>Send gmail from laravel 8</title>
</head>
<body>
<h1>Subject: {{$detail['subject']}}</h1>
<h2>From: {{$detail['name']}}</h2>
<h3>Email Address: {{$detail['email']}}</h3>
<div>
    <p>Content: {{$detail['message']}} </p>
</div>
</body>
</html>
