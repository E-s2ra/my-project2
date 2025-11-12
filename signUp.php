<?php
require_once __DIR__ . '/includes/db_connect.php'; // Connect to database

$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['full_name']); // your form field is still called full_name
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($name) && !empty($email) && !empty($username) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            try {
                // Check if username or email already exists
                $check_user = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
                $check_user->execute([':username' => $username, ':email' => $email]);

                if ($check_user->rowCount() > 0) {
                    $error_message = "⚠️ Username or email already exists!";
                } else {
                    // Hash password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // ✅ Insert new user (use `name` instead of `full_name`)
                    $sql = "INSERT INTO users (name, email, username, password) 
                            VALUES (:name, :email, :username, :password)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':username' => $username,
                        ':password' => $hashed_password
                    ]);

                    $success_message = "✅ Registration successful! You can now <a href='login.php'>login</a>.";
                }
            } catch (PDOException $e) {
                $error_message = "❌ Database error: " . $e->getMessage();
            }
        } else {
            $error_message = "⚠️ Passwords do not match.";
        }
    } else {
        $error_message = "⚠️ Please fill in all fields.";
    }
}

$conn = null; // Close connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Mobile Shop</title>

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

    .signup-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 450px;
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

    .signup-card h2 {
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

    .btn-signup {
        background-color: #0d47a1;
        color: white;
        border-radius: 30px;
        padding: 10px 30px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-signup:hover {
        background-color: #1a237e;
        transform: translateY(-2px);
    }

    .signup-footer {
        margin-top: 20px;
        font-size: 0.9rem;
        color: #555;
    }

    .signup-footer a {
        color: #0d47a1;
        text-decoration: none;
    }

    .signup-footer a:hover {
        text-decoration: underline;
    }

    @media(max-width: 480px) {
        .signup-card {
            padding: 30px 20px;
        }

        .form-control {
            padding: 10px 15px;
        }
    }
    </style>
</head>

<body>

    <div class="signup-card">
        <h2><i class="fas fa-user-plus me-2"></i>Create Account</h2>

        <!-- Show success or error -->
        <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Signup Form -->
        <form method="POST" action="">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" class="btn btn-signup w-100">Sign Up</button>
        </form>

        <div class="signup-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>