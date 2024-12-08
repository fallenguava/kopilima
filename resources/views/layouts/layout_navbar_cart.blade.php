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
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background: #03045e;
            color: #caf0f8;
            padding: 1rem 2rem;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #caf0f8 !important;
        }
        .btn-outline-primary {
            border-color: #caf0f8;
            color: #caf0f8;
        }
        .btn-outline-primary:hover {
            background-color: #0077b6;
            color: #fff;
        }
        #cart-count-badge {
            font-size: 0.75rem;
        }
        footer {
            background: #03045e;
            color: #caf0f8;
            text-align: center;
            padding: 1rem 0;
            font-size: 0.9rem;
            width: 100%;
        }
        footer a {
            color: #00b4d8;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

        .floating-nav {
        display: flex;
        gap: 1rem;
        flex-wrap: nowrap;
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: #90e0ef transparent;
        }
        .floating-nav::-webkit-scrollbar {
            height: 6px;
        }
        .floating-nav::-webkit-scrollbar-thumb {
            background-color: #90e0ef;
            border-radius: 5px;
        }
        .category-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            text-transform: capitalize;
            background: #0077b6;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            text-decoration: none;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .category-btn i {
            font-size: 1.2rem;
        }
        .category-btn:hover {
            background-color: #03045e;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="/">Kopi Lima</a>
    <div class="ms-auto">
        <a href="/cart" class="btn btn-outline-primary position-relative">
            <i class="bi bi-cart"></i>
            <span id="cart-count-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
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
