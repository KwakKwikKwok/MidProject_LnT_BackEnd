<?php

ini_set('memory_limit', '1024M');

include 'NavbarAndBackground/Header.php';
require_once '../Class/UserController.php';

session_start();
if($_SESSION['login'] !== true){
    header("Location: Login.php");
}

$uc = new UserController(); //User Control
$user = $uc->getOneUser($_GET['id']);

?>
<?php include 'NavbarAndBackground/Navbar.php';?>

<main>
    <div class="container my-5">
        <div class="card mx-auto" style="width: 150vh;">
            <div class="card-header bg-dark text-white text-center">
                <h3>View User</h3>
            </div>

            <div class="card-body bg-dark text-white d-flex align-items-center">
                <!-- Image Preview Section -->
                <div class="image-preview-container me-5">
                    <!-- Display Profile Image -->
                    <img id="imagePreview" src="<?= !empty($user['photo']) ? '../Storage/' . $user['photo'] : 'https://via.placeholder.com/180x150'; ?>" alt="Profile Image" class="img-fluid rounded mb-3" style="width: 500px; height: 300px; object-fit: cover;">
                </div>
                <!-- User Information Section -->
                <div class="w-100">
                    <p><strong>First Name   : </strong><?= $user['first_Name']?> </p>
                    <p><strong>Last Name    : </strong><?= $user['last_name']?> </p>
                    <p><strong>Email        : </strong><?= $user['email']?> </p>
                    <p><strong>Password     : </strong><?= $user['pass']?> </p>
                    <p><strong>Bio          : </strong><?= !empty($user['bio']) ? $user['bio'] : '-' ?> </p>

                    <!-- Close Button -->
                    <div class="text-center">
                        <a type="button" class="btn btn-secondary w-100 mt-3" href="Dashboard.php">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'NavbarAndBackground/Footer.php'?>