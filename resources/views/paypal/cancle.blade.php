<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Cancelled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fbeaea;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .cancel-icon {
            font-size: 60px;
            color: #dc3545;
        }
        h2 {
            color: #dc3545;
        }
        p {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="cancel-icon">❌</div>
        <h2>Payment Cancelled</h2>
        <p>You have cancelled the payment. No amount was charged.</p>
    </div>
</body>
</html>
