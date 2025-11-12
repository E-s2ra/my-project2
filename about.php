<?php
include('includes/db_connect.php'); // connect to database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Mobile Shop</title>

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

    .btn-login {
        background-color: #64b5f6;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
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
        text-decoration: none;
    }

    .btn-signup:hover {
        background-color: rgba(100, 181, 246, 0.1);
        transform: translateY(-2px);
    }

    /* About Section */
    .about-section {
        padding: 5rem 0;
    }

    .about-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a237e;
        text-align: center;
        margin-bottom: 1rem;
    }

    .about-subtitle {
        font-size: 1.1rem;
        color: #555;
        text-align: center;
        margin-bottom: 3rem;
    }

    .about-content {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        align-items: center;
        justify-content: center;
    }

    .about-image {
        max-width: 500px;
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .about-text {
        max-width: 600px;
        text-align: left;
    }

    .about-text h3 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #0d47a1;
        margin-bottom: 1rem;
    }

    .about-text p {
        font-size: 1rem;
        color: #555;
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    /* Highlights Section */
    .highlights {
        margin-top: 4rem;
        text-align: center;
    }

    .highlight-card {
        background-color: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .highlight-card:hover {
        transform: translateY(-5px);
    }

    .highlight-icon {
        font-size: 2.5rem;
        color: #0d47a1;
        margin-bottom: 1rem;
    }

    .highlight-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .highlight-text {
        font-size: 0.95rem;
        color: #555;
    }

    .footer {
        background-color: #1a237e;
        color: white;
        text-align: center;
        padding: 2rem 0;
        margin-top: 3rem;
    }

    @media (max-width: 768px) {
        .about-content {
            flex-direction: column;
            text-align: center;
        }

        .about-text {
            text-align: center;
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
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

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="about-title">About Mobile Shop</h2>
            <p class="about-subtitle">Your trusted source for the latest mobile devices and accessories in Arbil.</p>

            <div class="about-content">
                <img src="./assets/main_images/mobile shop.webp" alt="Mobile Shop" class="about-image">
                <div class="about-text">
                    <h3>Who We Are</h3>
                    <p>At Mobile Shop, we are dedicated to providing the best mobile devices and accessories at
                        competitive prices. Our team carefully selects products to ensure quality, performance, and
                        style.</p>
                    <p>From smartphones to essential accessories, we aim to create an easy and enjoyable shopping
                        experience for our customers. We are based in Arbil and proudly serve our local community with
                        dedication and passion.</p>
                </div>
            </div>

            <!-- Highlights Section -->
            <div class="highlights row g-4 mt-5">
                <div class="col-md-4">
                    <div class="highlight-card">
                        <i class="fas fa-shipping-fast highlight-icon"></i>
                        <h4 class="highlight-title">Fast Delivery</h4>
                        <p class="highlight-text">Get your mobile devices delivered quickly and safely across Arbil and
                            nearby areas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-card">
                        <i class="fas fa-headset highlight-icon"></i>
                        <h4 class="highlight-title">24/7 Support</h4>
                        <p class="highlight-text">Our support team is available anytime to help you with your questions
                            and orders.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-card">
                        <i class="fas fa-mobile-alt highlight-icon"></i>
                        <h4 class="highlight-title">Latest Devices</h4>
                        <p class="highlight-text">We offer the newest mobile phones and accessories so you always stay
                            up-to-date.</p>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>