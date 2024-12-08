<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Lima - Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa; /* Light background for consistency */
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            width: 100%;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #ff6f61 !important;
            text-transform: uppercase;
        }
        .btn-outline-secondary {
            border-color: #ff6f61;
            color: #ff6f61;
        }
        .btn-outline-secondary:hover {
            background-color: #ff6f61;
            color: #fff;
        }
        #cart-count-badge {
            font-size: 0.75rem;
        }
        footer {
            background: #4a4a4a;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            font-size: 0.9rem;
            width: 100%;
        }
        footer a {
            color: #ff6f61;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">Kopi Lima</a>
    <div class="ms-auto">
        <a href="/cart" class="btn btn-outline-secondary position-relative">
            <i class="bi bi-cart"></i>
            <span id="cart-count-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0 <!-- Placeholder for dynamic cart count -->
            </span>
        </a>
    </div>
</nav>

<main class="flex-grow-1">
    @yield('content')
</main>

<footer>
    &copy; 2024 Kopi Lima. All Rights Reserved. | <a href="#privacy">Privacy Policy</a> | <a href="#terms">Terms of Use</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
