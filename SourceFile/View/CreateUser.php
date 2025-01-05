<?php 
include 'NavbarAndBackground/Header.php';
require_once '../Class/UserController.php';

session_start();
if($_SESSION['login'] !== true){
    header("Location: Login.php");
}

$uc = new UserController();
if(isset($_POST['addBtn'])){
    $uc -> createUser($_POST, $_FILES['photo']);
    header("Location: Dashboard.php");
}

?>
<?php include 'NavbarAndBackground/Navbar.php';?>


<!-- Table -->
<div class="container my-5">
    <div class="card mx-auto" style="width: 150vh;">

        <div class="card-header bg-dark text-white text-center">
            <h3>Add New User</h3>
        </div>

        <div class="card-body bg-dark text-white d-flex flex-row align-items-left">
            <div class="">

            </div>
            <!-- Image Preview Section -->
            <div class="image-preview-container me-5">
                <img id="imagePreview" src="" alt="Profile Image" class="img-fluid rounded mb-3" style="width: 380px; height: 300px; object-fit: cover;">
            </div>
            
            <!-- Form Section -->
            <div class="form-section w-100">
                <form id="addUserForm" method = "POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Profile Image</label>
                        <input type="file" id="imageUpload" name="photo" class="form-control" accept="image/*">
                    </div>
                    <!-- First Name -->
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" placeholder="Enter first name">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" placeholder="Enter last name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" rows="3" placeholder="Enter a brief description"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" name="addBtn" class="btn btn-success w-100">Add User</button>
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

<?php include 'NavbarAndBackground/Footer.php'?>