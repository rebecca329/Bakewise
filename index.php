<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widthdevice-width", initial-scale="1.0">
    <title>Register and Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f9fc;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 400px;
            transition: transform 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .form-title {
            margin-bottom: 20px;
            text-align: center;
            font-size: 26px;
            color: #333;
        }

        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            color: #9aa5b1;
        }

        .input-group input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .input-group input:focus {
            border-color: #a5b4fc;
            box-shadow: 0 0 5px rgba(165, 180, 252, 0.5);
            outline: none;
        }

        button {
            background-color: #6366f1;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s;
        }

        button:hover {
            background-color: #4f46e5;
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="input-group">
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
