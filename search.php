<?php
include('includes/db_connect.php');

$search = "";
$products = [];

if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $search = trim($_GET['q']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :query OR description LIKE :query");
    $stmt->execute([':query' => "%$search%"]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products | Mobile Shop</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .navbar {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1rem 0;
    }

    .navbar-brand {
        font-weight: 600;
        font-size: 1.5rem;
        color: white !important;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
        font-weight: 500;
        margin: 0 0.5rem;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: white !important;
    }

    .btn-login {
        background-color: #64b5f6;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: #42a5f5;
        transform: translateY(-2px);
    }

    .btn-signup {
        background-color: transparent;
        color: #64b5f6;
        border: 2px solid #64b5f6;
        border-radius: 20px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-signup:hover {
        background-color: rgba(100, 181, 246, 0.1);
        transform: translateY(-2px);
    }

    .search-container {
        margin-top: 120px;
        padding-bottom: 50px;
    }

    .product-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    footer {
        text-align: center;
        padding: 15px;
        margin-top: auto;
        background-color: #212529;
        color: white;
    }

    @media (max-width: 768px) {
        .navbar-nav {
            text-align: center;
        }

        .btn-login,
        .btn-signup {
            display: block;
            width: 80%;
            margin: 0.5rem auto;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shopping-bag me-2"></i> Mobile Shop
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link active" href="search.php">Search</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>

                <div class="d-flex">
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="signUp.php" class="btn btn-signup">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Section -->
    <div class="container search-container">
        <h2 class="text-center mb-4 fw-bold">Search Products</h2>
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form method="GET" action="">
                    <div class="input-group input-group-lg">
                        <input type="text" name="q" class="form-control" placeholder="Search for a product..."
                            value="<?= htmlspecialchars($search) ?>">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div id="searchResults" class="row g-4 justify-content-center">
            <?php if (empty($search)): ?>
            <p class="text-center text-muted">Start typing to search for a product...</p>
            <?php elseif (empty($products)): ?>
            <p class="text-center text-danger fw-bold">No products found for "<?= htmlspecialchars($search) ?>"</p>
            <?php else: ?>
            <?php foreach ($products as $p): ?>
            <div class="col-md-4 col-lg-3">
                <div class="product-card">
                    <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"
                        class="product-image">
                    <div class="p-3">
                        <h5 class="fw-bold"><?= htmlspecialchars($p['name']) ?></h5>
                        <p class="text-muted"><?= htmlspecialchars($p['description']) ?></p>
                        <div class="text-primary fw-bold">$<?= number_format($p['price'], 2) ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Mobile Shop. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>