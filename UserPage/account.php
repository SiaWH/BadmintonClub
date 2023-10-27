<?php
    $head = 'Badminton Club';
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $link1 = 'training.php';
    $link2 = 'mybooking.php';
    $link3 = 'contactus.php';
    $headTitle1 = 'Training';
    $headTitle2 = 'View Bookings';
    $headTitle3 = 'Contact Us';
    include('header.php');
?>

<style>
.changeProfile{
    display: flex;
    flex-direction: column;
    z-index: 9998;
    width: 100%;
    height: 100%;
}
.profileChanger{
    line-height: 150%;
    margin-top: 3%;
}

.nameChanger, .passChanger{
    line-height: 150%;
    padding: 1%;
}

.profileSetting{
    height: 90%;
    width: 50%;
    border: 1px black solid;
    margin: 10% auto 5%;
    background-color: white;
}

.profileChanger form{
    padding: 0 0 5% 8%;
}

.error{
    color: red;
}

@media only screen and (max-width: 945px){
    .profileChanger form{
        padding: 0 0 5% 5%;
    }
    .profileSetting{
        margin-top: 15%;
    }
}
</style>

<?php
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if (strcmp($stdGender, "M") == 0){
        $check1 = 'checked';
        $check2 = '';
    }
    else {
        $check1 = '';
        $check2 = 'checked';
    }
    $newProfErr = '';
    $newNameErr = '';
    $newEmailErr = '';
    $oldPassErr = '';
    $newPassErr = '';
    $updateAlert = '';
    
    if (isset($_POST['submit'])){
        
        $img_name = $_FILES['profile']['name'];
        $img_size = $_FILES['profile']['size'];
        $tmp_name = $_FILES['profile']['tmp_name'];
        $error = $_FILES['profile']['error'];
                
        $newName = test_input($_POST['changeName']);
        $newEmail = test_input($_POST['changeEmail']);
        $newGender = $_POST['newGender'];
        $oldPass = sha1(test_input($_POST['currentPass']));
        $newPass = test_input($_POST['newPass']);
                
        if ($error === 0){
            if ($img_size > 1000000){
                $newProfErr = '*Sorry, your file is too large.';
            }
            else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc, $allowed_exs)){
                    $new_img_name = uniqid("$stdID-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'picture/Profile/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $sql = "UPDATE `studentlogin` SET `StudentProfile` = '$new_img_name' WHERE `studentlogin`.`StudentID` = '$userID'";

                    $result = $con->query($sql);

                }
                else {
                    $newProfErr = "*Sorry, you can't upload this file.";
                }
            }
        }
        
        if (preg_match("/^[A-Za-z]+(?:[\\s'-][A-Za-z]+)*$/", $newName)){
            $sql4 = "UPDATE `studentlogin` SET `StudentName` = '$newName' WHERE `studentlogin`.`StudentID` = '$userID'";
            $result4 = $con->query($sql4);
        }
        else if (empty($newName)){
            $newNameErr = '*Please do not leave it blank';
        }
        else {
            $newNameErr = '*Wrong format of name input';
        }
        
        if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $newEmail)){
            $sql5 = "UPDATE `studentlogin` SET `StudentEmail` = '$newEmail' WHERE `studentlogin`.`StudentID` = '$userID'";
            $result5 = $con->query($sql5);
        }
        else if (empty($newEmail)){
            $newEmailErr = '*Please do not leave it blank';
        }
        else {
            $newEmailErr = '*Please enter your email with correct format.';
        }
        
        if (!empty($_POST['newGender'])){
            $sql6 = "UPDATE `studentlogin` SET `Gender` = '$newGender' WHERE `studentlogin`.`StudentID` = '$userID'";
            $result6 = $con->query($sql6);
        }
        
        if(!empty($_POST['currentPass'])){
            if (strcmp($oldPass, $pass) == 0){
                if (!empty($_POST['newPass'])){
                    if (preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$/', $newPass)){
                        $newPass = sha1($newPass);
                        $sql7 = "UPDATE `studentlogin` SET `Password` = '$newPass' WHERE `studentlogin`.`StudentID` = '$userID'";
                        $result7 = $con->query($sql7);
                    } 
                    else {
                        $newPassErr = '*Password required atleast one capital letter, one digit, and one symbol.';
                    }
                }
                else {
                    $newPassErr = '*Please enter your new password.';
                }
            }
            else {
                $oldPassErr = '*The password is wrong.';
            }
        }
        if (empty($newProfErr) && empty($newNameErr) && empty($newEmailErr) && empty($oldPassErr) && empty($newPassErr)){
            $updateAlert = "window.onload = alert('Updated Successfully!');";
        }
        else {
            $updateAlert = "window.onload = alert('Something wrong!');";
        }
    }
    else {
        $updateAlert = '';
    }
    
    $con->close();
?>

<script><?php echo $updateAlert;?></script>

<!-- Change Setting -->
<div class="changeProfile">
    <div class="profileSetting">
        <div class="profileChanger">
            <form action="" method="post" enctype="multipart/form-data">
                <img src="./picture/Profile/<?php echo $profile;?>" class="settingPic">
                <input type="file" name="profile" accept=".jpeg, .jpg, .png, .webp">
                <p class="error"><?php echo $newProfErr;?></p><br>
                <label>Student ID: </label>
                <input type="text" name="studentID" value="<?php echo $stdID;?>" disabled>
                <br><br>
                <label for="newName">Name: </label>
                <input type="text" name="changeName" id="newName" required value="<?php echo $name;?>" maxlength="50">
                <p class="error"><?php echo $newNameErr?></p>
                <br>
                <label for="newEmail">Email: </label>
                <input type="email" name="changeEmail" id="newEmail" required value="<?php echo $email;?>" maxlength="30">
                <p class="error"><?php echo $newEmailErr?></p>
                <br>
                <label>Gender: </label>
                <input type="radio" value="M" name="newGender" id="newMale" <?php echo $check1;?>>
                <label for="newMale">Male</label>
                <input type="radio" value="F" name="newGender" id="newFemale" <?php echo $check2;?>>
                <label for="newFemale">Female</label>
                <br><br>
                <label for="cPass">Current password: </label>
                <input type="password" id="cPass" name="currentPass">
                <p class="error"><?php echo $oldPassErr?></p>
                <br>
                <label for="nPass">New password: </label>
                <input type="password" id="nPass" name="newPass" maxlength="15" minlength="8">
                <p class="error"><?php echo $newPassErr?></p>
                <br>
                <input type="submit" name="submit" value="Upload">
                <input type="button" value="Reset"
                    onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'" />
            </form>
        </div>
    </div>
</div>
<!-- Change Setting -->

<?php require_once 'footer.php';?>