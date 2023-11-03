<!DOCTYPE html>
<html>
<head>
    <title>Booking Email</title>
</head>
<body>
    <h4>Booking Details:</h4>
    <p>Full Name: {{ $data['full_name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Company Name: {{ $data['company_name'] }}</p>
    <p>Country: {{ $data['country'] }}</p>
    <p>Date: {{ $data['date'] }}</p>
    <p>Time: {{ $data['time'] }}</p>
</body>
</html>