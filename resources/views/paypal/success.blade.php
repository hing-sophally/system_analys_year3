<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }
        .container {
            text-align: center;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 40px;
        }
        .icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 24px;
            color: #28a745;
            margin: 0;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }
        .progress-bar {
            width: 100%;
            height: 5px;
            background: #f1f1f1;
            margin-bottom: 20px;
            border-radius: 25px;
        }
        .progress {
            height: 5px;
            width: 100%;
            background: #28a745;
            border-radius: 25px;
            animation: progress 2s ease-in-out;
        }
        .button {
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #218838;
        }

        @keyframes progress {
            0% { width: 0; }
            100% { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Font Awesome Check Circle Icon -->
        <div class="icon"><i class="fas fa-check-circle"></i></div>
        <h2>Payment Successful!</h2>
        <p>Thank you for your purchase. Your transaction has been completed successfully.</p>
        
        <!-- Progress Bar -->
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        
        <a href="{{ url('/home') }}" class="button">Return to Home</a>
    </div>
</body>
<!-- Add this snippet to your view (e.g., paypal.success or paypal.cancle) -->
@if(session('redirect'))
    <script type="text/javascript">
        window.location.href = "{{ session('redirect') }}";
    </script>
@endif
</html>
