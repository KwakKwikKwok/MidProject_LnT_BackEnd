<?php
require_once '../Class/LoginController.php';



$lc = new LoginController();
if(isset($_POST['loginBtn'])){
    $lc->login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
    />
    <link rel="stylesheet" href="CSS/Login.css" />
    <title>Login Page</title>
  </head>

  <link rel="stylesheet" href="NavbarAndBackground/CSS/Navbar.css" />
    <title>Dashboard</title>
  </head>

  <body class="d-flex flex-column min-vh-100">
  <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary custom-navbar" data-bs-theme="dark">
    <div class="container-fluid">
    <div class="nav-logo-name custom-logo-name">Database.</div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      </div>
    </div>
  </nav>

<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error === 'empty') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Login Failled</strong><br>All fields are required!</div>";
    }

    elseif ($error === 'emailInvalid') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Login Failled</strong><br>Please enter a valid email address!</div>";
    }

    elseif ($error === 'UserInvalid') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Login Failled</strong><br>Data Not Found!</div>";
    }

    elseif ($error === 'passwordInvalid') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Login Failled</strong><br>Please re-enter the correct password!</div>";
    }
}
?>

  <body>
        <main>
        <!---------------------------- Form box ------------------------------>
        <form method="POST">
            <div class="form-box">
                    <!--------------------- Login form ----------------------------->
                    <div class="login-container" id="login"></div>
                    <div class="top">
                    <header>Login</header>
                    </div>
                    <div class="two-forms">
                    <div class="input-box">
                        <input
                        value="<?= !empty($_COOKIE['email']) ? $_COOKIE['email'] : ''?>"
                        type="text"
                        class="input-field"
                        placeholder="Username"
                        name="email"
                        id="username"
                        />
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input
                        value="<?= !empty($_COOKIE['pass']) ? $_COOKIE['pass'] : ''?>"
                        type="password"
                        class="input-field"
                        placeholder="Password"
                        name="pass"
                        id="password"
                        />
                        <i class="bx bx-lock-alt"></i>
                        <span class="eye-icon" id="togglePassword" style="top: 25px;">
                            <img src="../Assets/Icon/Eye-open.png" alt="Toggle Password" id="eyeIcon" style="width: 20px; height: auto;">
                        </span>
                    </div>
                    <div class="form-check mb-3">
                        <input name="remember" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-table" style="color:white;" for="flexCheckDefault">Remember Me</label>
                    </div>
                    <button class="submit" name="loginBtn">Submit</button>
                    </div>
                </div>
        </form>
        </main>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            const isPassword = passwordField.type === "password";
            passwordField.type = isPassword ? "text" : "password";

            if (isPassword) {
                eyeIcon.src = "../Assets/Icon/Eye-close.png";
            } else {
                eyeIcon.src = "../Assets/Icon/Eye-open.png";
            }
        });

    </script>
    
<?php include 'NavbarAndBackground/Footer.php'?>