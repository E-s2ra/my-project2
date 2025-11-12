<?php
require_once __DIR__ . '/includes/db_connect.php'; // PDO connection

$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        try {
            // Insert data into database using PDO
            $sql = "INSERT INTO contact_messages (name, email, subject, message)
                    VALUES (:name, :email, :subject, :message)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':subject' => $subject,
                ':message' => $message
            ]);

            $success_message = "✅ Thank you! Your message has been sent successfully.";
        } catch (PDOException $e) {
            $error_message = "❌ Error saving your message: " . $e->getMessage();
        }
    } else {
        $error_message = "⚠️ Please fill in all fields.";
    }
}

$conn = null; // Close PDO connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Mobile Shop</title>

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
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Navbar */
    .navbar {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        padding: 1rem 0;
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
        border-radius: 20px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        border: none;
        transition: all 0.3s;
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
        transition: all 0.3s;
    }

    .btn-signup:hover {
        background-color: rgba(100, 181, 246, 0.1);
        transform: translateY(-2px);
    }

    /* Contact Section */
    .contact-container {
        margin-top: 120px;
        margin-bottom: 50px;
    }

    .contact-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .contact-info {
        background: linear-gradient(180deg, #0d47a1, #1a237e);
        color: white;
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-info h3 {
        font-weight: 700;
        margin-bottom: 20px;
    }

    .contact-info p {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .contact-form {
        padding: 40px 30px;
    }

    .contact-form h2 {
        color: #1a237e;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #0d47a1;
    }

    .btn-submit {
        background-color: #0d47a1;
        color: white;
        border-radius: 25px;
        padding: 0.7rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #0a3780;
        transform: translateY(-2px);
    }

    .map-container {
        margin-top: 40px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    footer {
        text-align: center;
        padding: 15px;
        margin-top: auto;
        background-color: #212529;
        color: white;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-shopping-bag me-2"></i> Mobile Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                </ul>
                <div class="d-flex">
                    <a href="login.php" class="btn btn-login">Login</a>
                    <a href="signUp.php" class="btn btn-signup">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <div class="container contact-container">
        <div class="contact-card d-flex flex-column flex-md-row">

            <!-- Info Sidebar -->
            <div class="contact-info col-md-4">
                <h3>Contact Info</h3>
                <p><i class="fas fa-map-marker-alt"></i> Arbil, Iraq</p>
                <p><i class="fas fa-phone"></i> +964 750 123 4567</p>
                <p><i class="fas fa-envelope"></i> support@mobileshop.com</p>
                <p><i class="fas fa-clock"></i> Mon-Sat: 9AM - 7PM</p>
            </div>

            <!-- Contact Form -->
            <div class="contact-form col-md-8">
                <h2>Send Us a Message</h2>

                <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php elseif (!empty($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5"
                            placeholder="Write your message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit">Send Message</button>
                </form>
            </div>
        </div>

        <!-- Map -->
        <div class="map-container mt-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12210.019120115132!2d44.008536!3d36.1911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x400c11ff0e0a2f29%3A0xdea45d4db61f88e7!2sErbil%2C%20Iraq!5e0!3m2!1sen!2sus!4v1701420000000!5m2!1sen!2sus"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Mobile Shop. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>