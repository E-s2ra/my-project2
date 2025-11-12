<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Mobile Online Store</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
    }

    .navbar {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
    }

    .navbar-brand {
        color: white !important;
        font-weight: 600;
    }

    .checkout-container {
        max-width: 700px;
        margin: 3rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-confirm {
        background-color: #0d47a1;
        color: white;
        border-radius: 25px;
        font-weight: 500;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-shopping-bag me-2"></i>Mobile Shop</a>
        </div>
    </nav>

    <div class="checkout-container">
        <h2 class="text-center mb-4 text-primary">Checkout</h2>

        <?php
    // Detect if product name or ID was passed
    $productName = $_GET['product_name'] ?? '';
    $productId = $_GET['product_id'] ?? '';

    if ($productName) {
      echo "<h4>You're purchasing: <strong>" . htmlspecialchars($productName) . "</strong></h4>";
    } elseif ($productId) {
      echo "<h4>You're purchasing product ID: <strong>" . htmlspecialchars($productId) . "</strong></h4>";
    } else {
      echo "<h4>No product selected.</h4>";
    }
    ?>

        <form class="mt-4">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" placeholder="John Doe">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="you@example.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="123 Main St">
            </div>

            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select class="form-select">
                    <option>Credit Card</option>
                    <option>PayPal</option>
                    <option>Cash on Delivery</option>
                </select>
            </div>

            <button type="submit" class="btn btn-confirm w-100">Confirm Purchase</button>
        </form>
    </div>

    <footer class="text-center mt-5 p-3 bg-dark text-light">
        © 2025 Mobile Shop. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>