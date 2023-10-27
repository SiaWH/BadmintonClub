<?php
    $title = 'Manage Current Account';
    $heading = 'Manage Current Account';
    require_once 'header.php';
?>
        <link href="./manageCurrent.css" rel="stylesheet">
        <script src="./manageCurrent.js"></script>
        
        <?php
            $errors['pic'] = '';
            $errors['cPass'] = '';
            $errors['nPass'] = '';
            $errors['rePass'] = '';
            $color = '';
            $colors = '';
        
            if(isset($_POST['submit'])){
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                $img_name = $_FILES['profile']['name'];
                $img_size = $_FILES['profile']['size'];
                $tmp_name = $_FILES['profile']['tmp_name'];
                $error = $_FILES['profile']['error'];
                
                if ($error === 0){
                    if ($img_size > 1000000){
                        $errors['pic'] = 'Sorry, your file is too large.';
                        $colors = 'red';
                    }
                    else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
                        $allowed_exs = array("jpg", "jpeg", "png", "webp");

                        if (in_array($img_ex_lc, $allowed_exs)){
                            $new_img_name = uniqid("$adminID-", true).'.'.$img_ex_lc;
                            $img_upload_path = 'picture/AdminProfile/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            $sql = "UPDATE `admin` SET `adminPhoto` = '$new_img_name' WHERE `admin`.`adminID` = '$adminID'";

                            if($result = $con->query($sql)){
                                $errors['pic'] = "Modified successful.";
                                $colors = 'green';
                            }
                            else {
                                $errors['pic'] = "Unknown error occured.";
                                $colors = 'red';
                            }
                        }
                        else {
                            $errors['pic'] = "Sorry, you can't upload this file.";
                            $colors = 'red';
                        }
                    }
                }
                
                if (!empty($_POST['currentPassword'])){
                    $cPass = $_POST['currentPassword'];
                    $nPass = $_POST['newPassword'];
                    $rePass = $_POST['confirmPassword'];

                    $sql1 = "SELECT adminPassword FROM admin WHERE adminID = '$adminID'";
                    $result1 = $con->query($sql1);

                    if ($result1->num_rows > 0){
                        $row = $result1->fetch_assoc();
                        if (strcmp($cPass, $row['adminPassword']) == 0){
                            if (!empty($nPass)){
                                if (preg_match('/^(?=.*[A-Z]).+$/', $nPass)){
                                    if (strcmp($nPass, $rePass) == 0){
                                        $sql2 = "UPDATE admin SET adminPassword = '$nPass'"; 
                                        if($result2 = $con->query($sql2)){
                                            $errors['cPass'] = 'Modified successful.';
                                            $color = 'green';
                                        }
                                    }
                                    else {
                                        $errors['rePass'] = 'Incorrect confirm password.';
                                        $color = 'red';
                                    }
                                }
                                else {
                                    $errors['nPass'] = 'Require at least 1 uppercase letter';
                                    $color = 'red';
                                }
                            }
                            else {
                                $errors['nPass'] = 'Enter your new password';
                                $color = 'red';
                            }
                        }
                        else {
                            $errors['cPass'] = 'Wrong password.';
                            $color = 'red';
                        }
                    }
                }
                $con->close();
            }
        ?>
        
        <style>
            .error{
                color: <?php echo $color;?>;
                margin-left: 5%;
            }
            .errors{
                color: <?php echo $colors;?>;
                margin-left: 5%;
            }
        </style>
        
        <form id="manageAdmin" style="border: 1px solid black;" method="post" action="" enctype="multipart/form-data">
            <p style="text-align: center; font-size: 3vw; color: white; background-color: black; margin-top: 0;" id="tr">Account Details</p>
            <label for="accPic">Account Picture</label>
            <input type="file" name="profile" accept=".jpeg, .jpg, .png, .webp" id="accPic">
            <p class="errors"><?php echo $errors['pic'];?></p><br>
            <label for="admId">Account ID : </label>
            <input type="text" value="<?php echo $adminID;?>" name="admId" id="admId" disabled>
            <br><br>
            <label for="currentPassword">Current Password : </label>
            <input type="password" id="currentPassword" name="currentPassword">
            <p class="error"><?php echo $errors['cPass'];?></p><br>
            <label for="newPassword">New Password : </label>
            <input type="password" id="newPassword" name="newPassword" minlength="8" maxlength="29">
            <p class="error"><?php echo $errors['nPass'];?></p><br>
            <label for="confirmPassword">Confirm Password : </label>
            <input type="password" id="confirmPassword" name="confirmPassword">
            <p class="error"><?php echo $errors['rePass'];?></p><br>
            <input type="submit" value="Submit" name="submit" style="margin-left: 5%; margin-bottom: 2%;">
            <input type="button" value="Reset"
                    onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'" />
            <input type="button" name="cancel" onclick="back()" style="font-size: 2vw;" value="Cancel"/>
        
        </form>
        
        
</<body>

    
    
    
    
</html>

