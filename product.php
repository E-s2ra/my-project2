<?php
// Include database connection
include('includes/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Mobile Online Store</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: 600;
        font-size: 1.5rem;
        color: white !important;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.8) !important;
        font-weight: 500;
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
    }

    .btn-signup {
        background-color: transparent;
        color: #64b5f6;
        border: 2px solid #64b5f6;
        border-radius: 20px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        margin-left: 0.5rem;
    }

    .header-section {
        padding: 4rem 0;
        text-align: center;
    }

    .header-heading {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a237e;
        margin-bottom: 1rem;
    }

    .header-subheading {
        font-size: 1.2rem;
        color: #555;
    }

    .product-section {
        padding: 3rem 0;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 600;
        color: #1a237e;
        margin-bottom: 2rem;
        text-align: center;
    }

    .product-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background-color: white;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .product-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin: 1rem 0 0.5rem;
    }

    .product-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .product-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0d47a1;
        margin-bottom: 1rem;
    }

    .btn-buy-now {
        background-color: #0d47a1;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        width: 100%;
    }

    .footer {
        background-color: #1a237e;
        color: white;
        text-align: center;
        padding: 2rem 0;
        margin-top: 3rem;
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
                    <li class="nav-item"><a class="nav-link active" href="product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <div class="d-flex">
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="signUp.php" class="btn btn-signup">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section class="header-section">
        <div class="container">
            <h1 class="header-heading">Discover Our Best Mobile Deals</h1>
            <p class="header-subheading">Browse the latest phones and accessories at unbeatable prices.</p>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="product-section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="row g-4 mb-4">
                <?php
        try {
          $stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
          if ($stmt->rowCount() > 0) {
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo '
                <div class="col-md-6 col-lg-3">
                  <div class="product-card">
                    <img src="' . htmlspecialchars($product['image']) . '" class="product-image" alt="' . htmlspecialchars($product['name']) . '">
                    <div class="p-3">
                      <h3 class="product-name">' . htmlspecialchars($product['name']) . '</h3>
                      <p class="product-description">' . htmlspecialchars($product['description']) . '</p>
                      <div class="product-price">$' . number_format($product['price'], 2) . '</div>
                      <form method="GET" action="checkout.php">
                        <input type="hidden" name="product_id" value="' . $product['id'] . '">
                        <button type="submit" class="btn btn-buy-now">Buy Now</button>
                      </form>
                    </div>
                  </div>
                </div>';
            }
          } else {
            echo "<p class='text-center text-muted'>No products available yet.</p>";
          }
        } catch (PDOException $e) {
          echo "<p class='text-center text-danger'>Error loading products.</p>";
        }
        ?>
            </div>
        </div>
    </section>

    <!-- 🔹 New Arrivals Section -->
    <section class="product-section" style="background-color:#eef3ff;">
        <div class="container">
            <h2 class="section-title">New Arrivals</h2>
            <div class="row g-4 mb-4">
                <!-- iPhone 15 -->
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <img src="images/iphone15.jpg" class="product-image" alt="iPhone 15">
                        <div class="p-3">
                            <h3 class="product-name">iPhone 15</h3>
                            <p class="product-description">The latest iPhone with advanced camera and A17 chip.</p>
                            <div class="product-price">$999.00</div>
                            <form method="GET" action="checkout.php">
                                <input type="hidden" name="product_name" value="iPhone 15">
                                <button type="submit" class="btn btn-buy-now">Buy Now</button>
                            </form>
                        </div>
                    </div>
                </div>

           <!-- iPhone 16 -->
<div class="col-md-6 col-lg-3">
    <div class="product-card">
        <img src="images/iphone16.jpg" class="product-image" alt="iPhone 16">
        <div class="p-3">
            <h3 class="product-name">iPhone 16</h3>
            <p class="product-description">Experience the future of mobile with iPhone 16 Pro.</p>
            <div class="product-price">$1,199.00</div>
            <form method="GET" action="checkout.php">
                <input type="hidden" name="product_name" value="iPhone 16">
                <button type="submit" class="btn btn-buy-now">Buy Now</button>
            </form>
        </div>
    </div>
</div>

<!-- Galaxy S25 -->
<div class="col-md-6 col-lg-3">
    <div class="product-card">
        <img src="images/galaxyS25.jpg" class="product-image" alt="Galaxy S25">
        <div class="p-3">
            <h3 class="product-name">Galaxy S25</h3>
            <p class="product-description">Next-gen Samsung performance with cutting-edge display.</p>
            <div class="product-price">$1,099.00</div>
            <form method="GET" action="checkout.php">
                <input type="hidden" name="product_name" value="Galaxy S25">
                <button type="submit" class="btn btn-buy-now">Buy Now</button>
            </form>
        </div>
    </div>
</div>

<!-- Galaxy S24 -->
<div class="col-md-6 col-lg-3">
    <div class="product-card">
        <img src="images/galaxyS24.jpg" class="product-image" alt="Galaxy S24">
        <div class="p-3">
            <h3 class="product-name">Galaxy S24</h3>
            <p class="product-description">Powerful, elegant, and sleek with enhanced AI features.</p>
            <div class="product-price">$899.00</div>
            <form method="GET" action="checkout.php">
                <input type="hidden" name="product_name" value="Galaxy S24">
                <button type="submit" class="btn btn-buy-now">Buy Now</button>
            </form>
        </div>
    </div>
</div>

<!-- ✅ Power Bank -->
<div class="col-md-6 col-lg-3">
    <div class="product-card">
        <img src="images/powerbank.jpg" class="product-image" alt="Power Bank">
        <div class="p-3">
            <h3 class="product-name">Power Bank</h3>
            <p class="product-description">High-capacity power bank for long-lasting portable charging.</p>
            <div class="product-price">$39.99</div>
            <form method="GET" action="checkout.php">
                <input type="hidden" name="product_name" value="Power Bank">
                <button type="submit" class="btn btn-buy-now">Buy Now</button>
            </form>
        </div>
    </div>
</div>

<!-- ✅ Headphones -->
<div class="col-md-6 col-lg-3">
    <div class="product-card">
        <img src="images/headphones.jpg" class="product-image" alt="Headphones">
        <div class="p-3">
            <h3 class="product-name">Headphones</h3>
            <p class="product-description">Premium wireless headphones with noise cancellation.</p>
            <div class="product-price">$59.99</div>
            <form method="GET" action="checkout.php">
                <input type="hidden" name="product_name" value="Headphones">
                <button type="submit" class="btn btn-buy-now">Buy Now</button>
            </form>
        </div>
    </div>
</div>

<!-- ✅ Phone Cover -->
<div class="col-md-6 col-lg-3">
    <div class="product-card">
        <img src="images/phonecover.jpg" class="product-image" alt="Phone Cover">
        <div class="p-3">
            <h3 class="product-name">Phone Cover</h3>
            <p class="product-description">Durable protective phone cover with shock resistance.</p>
            <div class="product-price">$14.99</div>
            <form method="GET" action="checkout.php">
                <input type="hidden" name="product_name" value="Phone Cover">
                <button type="submit" class="btn btn-buy-now">Buy Now</button>
            </form>
        </div>
    </div>
</div>
            </div>   
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2025 Mobile Shop. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>