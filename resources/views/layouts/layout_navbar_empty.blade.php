<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Lima - Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #caf0f8;
            border-bottom: 2px solid #0077b6;
            padding: 1rem 2rem;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #03045e;
        }
        .navbar-brand:hover {
            color: #0077b6;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a class="navbar-brand mx-auto" href="/">Kopi Lima</a>
</nav>

<main class="flex-grow-1">
    @yield('content')
</main>

<footer style="background-color: #03045e; color: #fff; text-align: center; padding: 1rem;">
    &copy; 2024 Kopi Lima. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
