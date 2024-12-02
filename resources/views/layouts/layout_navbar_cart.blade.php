<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kopi Lima - Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .navbar-brand { font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand mx-auto" href="#">KopiLima</a>
    <div class="ms-auto">
        <a href="/cart" class="btn btn-outline-secondary position-relative">
            <i class="bi bi-cart"></i>
            <span id="cart-count-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0 <!-- Placeholder for dynamic cart count -->
            </span>
        </a>        
    </div>
</nav>

@yield('content')

@include('layouts.layout_footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
