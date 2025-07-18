<?php
session_start();

// Database configuration and setup
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'wedding_gallery');

// Create database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql)) {
    $conn->select_db(DB_NAME);
    
    // Create users table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }
    
    // Create user 'norefa' if not exists
    $username = 'norefa';
    $password = password_hash('norefa', PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        
        if (!$stmt->execute()) {
            die("Error creating user: " . $stmt->error);
        }
    }
} else {
    die("Error creating database: " . $conn->error);
}

$conn->close();

// Handle login
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Create new connection to the wedding_gallery database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        }
    }
    
    $login_error = "Invalid credentials. Please try again.";
    $conn->close();
}

// Redirect to index if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Norden & Efarina's Wedding Gallery</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gold: #a78f44ff;
            --light-gold: #b19445ff;
            --pink: #f8d7da;
            --light-pink: #f9eef1;
            --dark-pink: #8a5c60ff;
            --white: #ffffff;
            --dark: #000000ff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: 
                url('efarina_wedding_images/canva/img1.png') no-repeat center center fixed,
                linear-gradient(135deg, var(--white) 0%, var(--light-pink) 100%);
            background-size: cover;
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="none" width="100" height="100"/><path d="M0,50 Q25,40 50,50 T100,50" stroke="rgba(212, 175, 55, 0.05)" fill="none" stroke-width="2"/></svg>');
            opacity: 0.1;
            z-index: -1;
        }
        
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-box {
            backdrop-filter: blur(15px);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            min-width: 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--gold), var(--dark-pink));
        }
        
        .login-logo {
            font-family: 'Great Vibes', cursive;
            font-size: 3.5rem;
            color: var(--gold);
            margin-bottom: 30px;
            text-align: center;
        }
        
        .login-logo span {
            color: var(--dark-pink);
        }
        
        .login-title {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            color: var(--gold);
            margin-bottom: 30px;
        }
        
        .login-form .input-group {
            margin-bottom: 25px;
            text-align: left;
            position: relative;
        }
        
        .login-form label {
            display: block;
            margin-bottom: 10px;
            color: var(--dark);
            font-weight: 800;
            padding-left: 5px;
        }
        
        .login-form input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s;
            background: rgba(249, 238, 241, 0.3);
        }
        
        .login-form input:focus {
            border-color: var(--gold);
            outline: none;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }
        
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, var(--gold), var(--light-gold));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }
        
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        }
        
        .login-btn:active {
            transform: translateY(-1px);
        }
        
        .error-message {
            color: #e74c3c;
            margin-top: 20px;
            font-size: 1.1rem;
            background: rgba(231, 76, 60, 0.1);
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid #e74c3c;
        }
        
        .wedding-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .wedding-info p {
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .wedding-info .names {
            font-family: 'Great Vibes', cursive;
            font-size: 2.2rem;
            color: var(--gold);
            margin: 10px 0;
        }
        
        .wedding-info .date {
            color: var(--dark-pink);
            font-weight: 500;
        }
        
        /* Decorative elements */
        .decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.1;
        }
        
        .decoration-1 {
            top: 20px;
            left: 20px;
            font-size: 6rem;
            color: var(--gold);
            transform: rotate(-15deg);
        }
        
        .decoration-2 {
            bottom: 20px;
            right: 20px;
            font-size: 5rem;
            color: var(--dark-pink);
            transform: rotate(15deg);
        }
        
        /* Responsive design */
        @media (max-width: 900px) {
            .login-box {
                max-width: 95vw;
                padding: 30px 10px;
            }
            .login-title {
                font-size: 2rem;
            }
            .login-logo {
                font-size: 2.2rem;
            }
            .wedding-info .names {
                font-size: 1.3rem;
            }
            .login-form input {
                font-size: 1rem;
                padding: 12px 10px;
            }
            .login-btn {
                font-size: 1rem;
                padding: 12px;
            }
        }
        @media (max-width: 600px) {
            .login-box {
                max-width: 100vw;
                padding: 18px 2vw;
                border-radius: 10px;
            }
            .login-title {
                font-size: 1.3rem;
            }
            .login-logo {
                font-size: 1.5rem;
            }
            .wedding-info .names {
                font-size: 1rem;
            }
            .login-form label {
                font-size: 0.95rem;
            }
            .login-form input {
                font-size: 0.95rem;
                padding: 10px 8px;
            }
            .login-btn {
                font-size: 0.95rem;
                padding: 10px;
            }
        }
        @media (max-width: 400px) {
            .login-title {
                font-size: 1rem;
            }
            .login-logo {
                font-size: 1.1rem;
            }
            .login-box {
                padding: 10px 1vw;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <i class="decoration decoration-1 fas fa-heart"></i>
            <i class="decoration decoration-2 fas fa-ring"></i>
            
            <div class="login-logo">Norden<span>&</span>Efarina</div>
            <h2 class="login-title">Wedding Gallery</h2>
            
            <form class="login-form" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <div style="position:relative;">
                        <input type="password" id="password" name="password" required style="padding-right:40px;">
                        <button type="button" id="togglePassword" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#a78f44ff;">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="login-btn">Enter Gallery</button>
                
                <?php if (!empty($login_error)) : ?>
                    <p class="error-message"><?php echo $login_error; ?></p>
                <?php endif; ?>
            </form>
            
            <div class="wedding-info">
                <p>Celebrating the union of</p>
                <p class="names">Norden & Efarina</p>
                <p class="date">March 12, 2024 – Kuching, Sarawak</p>
            </div>
        </div>
    </div>
</body>
</html>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});
</script>