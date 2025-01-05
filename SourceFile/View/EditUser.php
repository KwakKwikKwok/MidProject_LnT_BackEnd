<?php 
include 'NavbarAndBackground/Header.php';
require_once '../Class/UserController.php';

session_start();
if($_SESSION['login'] !== true){
    header("Location: Login.php");
}

$uc = new UserController();
$user = $uc->getOneUser($_GET['id']);

if(isset($_POST['updateBtn'])){
    $uc->updateUser($user, $_POST, $_FILES['photo']);
    header('Location: Dashboard.php');
}

?>
<?php include 'NavbarAndBackground/Navbar.php';?>

<div class="container my-5">
    <div class="card mx-auto" style="width: 150vh;">
        <div class="card-header bg-dark text-white text-center">
            <h3>Edit User</h3>
        </div>

        <div class="card-body bg-dark text-white d-flex align-items-center">
            <!-- Image Preview Section -->
            <div class="image-preview-container me-5">
                <img id="imagePreview" src="<?=empty($user['photo'])? 'https://via.placeorder.com/180x150' : '../Storage/'.$user['photo']?>" class="img-fluid rounded mb-3" style="width: 380px; height: 300px; object-fit: cover;">
            </div>
            <!-- Form Section -->
            <div class="form-section w-100">
                <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="imageUpload" name="photo" accept="image/*">
                    </div>

                    <!-- First Name -->
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="Enter first name" value="<?=$user['first_Name']?>" >
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="lastName" placeholder="Enter last name" value="<?=$user['last_name']?>">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?=$user['email']?>">
                    </div>

                    <!-- Bio -->
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Enter a brief description"><?=$user['bio']?></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" name="updateBtn" class="btn btn-success w-100">Update User</button>
                        <a type="button" class="btn btn-secondary w-100 mt-3" href="Dashboard.php">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>