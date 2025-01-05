<?php

include 'NavbarAndBackground/Header.php';
require_once '../Class/UserController.php';
require_once '../Class/LoginController.php';

session_start();
if($_SESSION['login'] !== true){
    header("Location: Login.php");
}

$lc = new LoginController();
if(isset($_POST['logoutBtn'])){
    $lc->logout();
}

$uc = new UserController(); //User Control
$user = $uc->getOneUser($_GET['id'] = 1);

?>
<?php include 'NavbarAndBackground/Navbar.php';?>

<main>
    <div class="container my-5">
        <div class="card mx-auto " style="width: 150vh;">
            <div class="card-header bg-dark text-white text-center">
                <h3 class="mt-3">Profile</h3>
            </div>
            <hr class="my-0 border-light">
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

                    <div class="text-center d-flex justify-item-start ">
                        <form method="POST">
                        <button class="btn btn-danger w-100 mt-3" type="button" id="logoutBtn"><strong>Logout</strong></button>
                        </form>
                        <div class="alertBox" id="warningLogout" style="display:none; text-align: left">
                            <div class="alert alert-danger position-absolute start-50 translate-middle w-50" role="alert" style="top: -12%; margin-top: 5px;">
                                <strong>Warning!</strong><br>Are you sure you want to logout?
                                <div class="mt-3">
                                    <form method="POST">
                                        <button type="submit" class="btn btn-danger" name="logoutBtn">Yes</button>
                                        <button type="button" class="btn btn-secondary" onclick="closeAlert('warningLogout')">No</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    document.getElementById("logoutBtn").addEventListener("click", function(event) {
        event.preventDefault();
        showAlert("warningLogout");
    });
    
    function showAlert(alertId) {
        const alertBox = document.getElementById(alertId);
        alertBox.style.display = 'block';
    }
    
    function closeAlert(alertId) {
        const alertBox = document.getElementById(alertId);
        alertBox.style.display = 'none';
    } 
</script>


<?php include 'NavbarAndBackground/Footer.php'?>