<?php

include 'NavbarAndBackground/Header.php';
require_once '../Class/UserController.php';

session_start();
if($_SESSION['login'] !== true){
    header("Location: Login.php");
}

$uc = new UserController(); //User Control
$users = $uc->showUsers();
?>

<link rel="stylesheet" href="CSS/Dashboard.css" />

<?php include 'NavbarAndBackground/Navbar.php';?>
<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error === 'empty') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Input Data Failled</strong><br>All fields except bio are required!</div>";
    }

    elseif ($error === 'emailInvalid') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Input Data Failled</strong><br>Please enter a valid email address!</div>";
    }

    elseif ($error === 'duplicatePhoto') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Input Data Failled</strong><br>Make sure to upload different image!</div>";        
    }

    elseif ($error === 'FirstNameLengthInvalid') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Input Data Failled</strong><br>Make sure your first name is no longger than 225 characters</div>";        
    }

    elseif ($error === 'LastNameLengthInvalid') {
        echo "<div id='alertBox' class='alert alert-danger position-absolute top-0 start-50 translate-middle mt-5'><strong>Input Data Failled</strong><br>Make sure your last name is no longger than 225 characters</div>";        
    }


}

if(isset($_POST['deleteBtn'])){
    $uc->deleteUser($_POST);
}
?>


<main>
    <div class="main-content">
        <div class="heading" style="padding-right:5%">
            <div class="title-container">
                <h1 class="title mx-3">User Database</h1>
            </div>
            <div class="text-center">
                <a href="CreateUser.php" class="btn btn-primary">Add User [+]</a>
            </div>
        </div>

        <div class="container mx-5">
            <table class="table table-hover caption-top mt-5 fs-5 table-dark" style="width: 135%;">
                <thead class="text-center">
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    <?php 
                        $num = 1;
                        foreach($users as $user): 
                    ?>
                    <tr>
                        <td><?= $num++ ?></td>
                        <td>
                            <img src="<?= !empty($user['photo']) ? '../Storage/' . $user['photo'] : 'https://via.placeholder.com/180x150'; ?>" 
                                alt="profile_picture" 
                                style="width: 100px;"
                                class = "rounded">
                        </td>
                        <td><?=$user['first_Name']. ' ' . $user['last_name']?></td>
                        <td><?= $user['email']?></td>
                        <td>
                            <a href="ViewUser.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-md">View</a>
                            <a href="EditUser.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-md">Edit</a>
                            <button class="btn btn-danger btn-md" onclick="showAlert('warningRemove<?=$num?>')">Remove</button>

                            <div class="alertBox" id="warningRemove<?=$num?>" style="display:none; text-align: left">
                                <div class="alert alert-danger position-absolute start-50 translate-middle w-50" role="alert"style="top: 14%; margin-top: 5px;">
                                    <strong>Warning!</strong><br>Are you sure you want to delete this user?
                                    <div class="mt-3">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $user["id"]?>">
                                            <input type="hidden" name="photo" value="<?= $user["photo"]?>">
                                            <button type="submit" class="btn btn-danger" name="deleteBtn">Yes</button>
                                            <button type="button" class="btn btn-secondary" onclick="closeAlert('warningRemove<?=$num?>')">No</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    function showAlert(alertId) {
        const alertBox = document.getElementById(alertId);
        alertBox.style.display = 'block';
    }

    function closeAlert(alertId) {
        const alertBox = document.getElementById(alertId);
        alertBox.style.display = 'none' 
    }


    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.transition = 'opacity 0.5s';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }, 2500);
        }
    });

</script>

<?php include 'NavbarAndBackground/Footer.php'?>