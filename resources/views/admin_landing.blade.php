<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Lima</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .gradient-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #03045e, #0077b6, #00b4d8, #90e0ef, #caf0f8);
            background-size: 300% 300%;
            animation: gradientMove 10s ease infinite;
            z-index: -1;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .content-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .animated-text {
            font-size: 6rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2rem;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .login-button {
            display: inline-block;
            margin-top: 2rem;
            padding: 1rem 2.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #03045e;
            background: #caf0f8;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-button:hover {
            background: #90e0ef;
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="gradient-background"></div>

    <div class="content-container">
        <div class="animated-text">Kopi Lima</div>
        <a href="/login" class="login-button">Login as Admin</a>
    </div>
</body>
</html>
