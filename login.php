<?php
session_start();
require_once __DIR__ . "/includes/db_connect.php"; // PDO connection

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        try {
            // Prepare statement (PDO version)
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Start session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: index.php");
                    exit();
                } else {
                    $message = "<p class='text-danger'>❌ Invalid password!</p>";
                }
            } else {
                $message = "<p class='text-danger'>⚠️ User not found!</p>";
            }
        } catch (PDOException $e) {
            $message = "<p class='text-danger'>❌ Database error: " . $e->getMessage() . "</p>";
        }
    } else {
        $message = "<p class='text-danger'>⚠️ Please fill in all fields!</p>";
    }
}

$conn = null; // Close PDO connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mobile Shop</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        padding: 40px 30px;
        text-align: center;
        animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card h2 {
        font-weight: 700;
        margin-bottom: 25px;
        color: #1a237e;
    }

    .form-control {
        border-radius: 30px;
        padding: 12px 20px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #0d47a1;
        box-shadow: none;
    }

    .btn-login {
        background-color: #0d47a1;
        color: white;
        border-radius: 30px;
        padding: 10px 30px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background-color: #1a237e;
        transform: translateY(-2px);
    }

    .login-footer {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #555;
    }

    .login-footer a {
        color: #0d47a1;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="login-card">
        <h2><i class="fas fa-mobile-alt me-2"></i>Mobile Shop Login</h2>

        <?php if ($message) echo "<div class='mb-3'>$message</div>"; ?>

        <form method="POST" action="">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>

        <div class="login-footer">
            <p>Don't have an account? <a href="signUp.php">Sign Up</a></p>
            <p><a href="#">Forgot Password?</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>