<?php
session_start();
include 'includes/db_connect.php';

// Fetch latest 4 products to show as featured (if any)
$featuredProducts = [];
try {
    $stmt = $conn->prepare("SELECT id, name, description, price, image FROM products ORDER BY created_at DESC LIMIT 4");
    $stmt->execute();
    $featuredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // If DB fails, keep $featuredProducts empty. You could log $e->getMessage()
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Mobile Online Store</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    /* Navbar */
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

    .btn-login,
    .btn-signup {
        border-radius: 20px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-left: 0.5rem;
    }

    .btn-login {
        background-color: #64b5f6;
        color: white;
    }

    .btn-login:hover {
        background-color: #42a5f5;
    }

    .btn-signup {
        background-color: transparent;
        color: #64b5f6;
        border: 2px solid #64b5f6;
    }

    .btn-signup:hover {
        background-color: rgba(100, 181, 246, 0.1);
    }

    /* Hero Section */
    .hero-section {
        padding: 5rem 0;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    .hero-heading {
        font-size: 3rem;
        font-weight: 700;
        color: #1a237e;
        margin-bottom: 1rem;
    }

    .hero-subheading {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 2rem;
        font-weight: 400;
    }

    .btn-view-products,
    .btn-view-search {
        border-radius: 25px;
        padding: 0.7rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-right: 1rem;
    }

    .btn-view-products {
        background-color: #0d47a1;
        color: white;
        border: none;
    }

    .btn-view-products:hover {
        background-color: #0a3780;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(13, 71, 161, 0.3);
    }

    .btn-view-search {
        background-color: transparent;
        color: #6c757d;
        border: 2px solid #6c757d;
    }

    .btn-view-search:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-3px);
    }

    .hero-image {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        object-fit: cover;
        height: 180px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-heading {
            font-size: 2rem;
        }

        .btn-view-products,
        .btn-view-search {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
        }

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
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>

                <div class="d-flex">
                    <?php if (!empty($_SESSION['user_id']) && !empty($_SESSION['user_name'])): ?>
                    <div class="dropdown">
                        <a class="btn btn-sm btn-light text-dark dropdown-toggle" href="#" role="button" id="userMenu"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <?php else: ?>
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="signUp.php" class="btn btn-signup">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-heading">Welcome to Our Store</h1>
                    <p class="hero-subheading">Find your next favorite mobile device today.</p>
                    <div class="d-flex flex-column flex-md-row">
                        <a href="product.php" class="btn-view-products">View Products</a>
                        <a href="search.php" class="btn-view-search">View Search</a>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <img src="./assets/main_images/iphone.webp" alt="Product showcase" class="hero-image" />
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="m-0">Featured Products</h3>
                <a href="product.php" class="text-decoration-none">View all</a>
            </div>

            <?php if (!empty($featuredProducts)): ?>
            <div class="row g-3">
                <?php foreach ($featuredProducts as $p): ?>
                <div class="col-md-3">
                    <div class="card product-card h-100 shadow-sm">
                        <?php
                                $imgPath = !empty($p['image']) ? htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8') : 'assets/main_images/iphone.webp';
                                ?>
                        <img src="<?php echo $imgPath; ?>" class="card-img-top"
                            alt="<?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text small text-truncate">
                                <?php echo htmlspecialchars($p['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <div class="mt-auto">
                                <p class="mb-2 fw-bold">$<?php echo number_format((float)$p['price'], 2); ?></p>
                                <div class="d-flex gap-2">
                                    <a href="product.php?id=<?php echo (int)$p['id']; ?>"
                                        class="btn btn-sm btn-outline-primary w-100">View</a>
                                    <a href="checkout.php?buy=<?php echo (int)$p['id']; ?>"
                                        class="btn btn-sm btn-primary w-100">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="alert alert-secondary">No products available yet. Please check back later.</div>
            <?php endif; ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>