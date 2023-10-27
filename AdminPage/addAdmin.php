<?php
    $title = 'Add Admin';
    $heading = 'Add New Admin';
    require_once 'header.php';
?>
        <script src="./addAdmin.js"></script>
        <link href="./addAdmin.css" rel="stylesheet">
        
         <?php
        $ProfErr = '';
        $idErr = '';
        $passErr = '';
        $conErr = '';
        $phoneErr = '';
        $success = '';
        $color = '';
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $DB_NAME = "badmintonclub";
        $err;
        
        $conn = new mysqli($servername, $username, $password, $DB_NAME);
        
        if($conn->connect_error)
        {
            die("Connection failed" . $conn->connect_error);
        }
        
      
        if (isset($_POST['submit'])) 
        { 
            $img_name = $_FILES['admPic']['name'];
            $img_size = $_FILES['admPic']['size'];
            $tmp_name = $_FILES['admPic']['tmp_name'];
            $error = $_FILES['admPic']['error'];

            $id = strtoupper($_POST['admID']);
            $password = $_POST['admPassword'];
            $confirmPassword = $_POST['confirm'];
            $name = $_POST['admName'];
            $email = $_POST['admEmail'];
            $gender = $_POST['admGender'];
            $telNum = $_POST['admTel'];

            $sql1 = "SELECT adminID FROM admin WHERE adminID = '".$id."'";
            $result = $con->query($sql1);
            
            if(!preg_match('/^[A]\d{5}$/', $id)){
                $idErr = 'Wrong format of ID.';
            }
            else if ($result->num_rows > 0){
                $idErr = 'This ID is existed.';
            }
            else {
                if ($error === 0){
                    if ($img_size > 1000000){
                        $ProfErr = 'Sorry, your file is too large.';
                    }
                    else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
                        $allowed_exs = array("jpg", "jpeg", "png", "webp");

                        if (in_array($img_ex_lc, $allowed_exs)){
                            $new_img_name = uniqid("$id-", true).'.'.$img_ex_lc;
                            $img_upload_path = 'picture/AdminProfile/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                        }
                        else {
                            $ProfErr = "Sorry, you can't upload this file.";
                        }
                    }
                }
            }
            
            if(!preg_match('/^(?=.*[A-Z]).+$/', $password)){
                $passErr = 'Require at least one capital letter.';
            }
            else {
                if(strcmp($password, $confirmPassword) != 0){
                    $conErr = 'Please enter the correct password.';
                }
            }
            
            if(!preg_match('/^01\d*-\d{3,4}\s\d{4}$/', $telNum)){
                $phoneErr = 'Wrong format of phone number';
            }

            if(empty($ProfErr) && empty($idErr) && empty($passErr) && empty($conErr) && empty($phoneErr)){
                $sql = 'INSERT INTO Admin (adminPhoto, adminID, AdminPassword, adminName, adminEmail,adminGender, adminPhone)'
                    . 'VALUES (?,?,?,?,?,?,?)';

                $stm = $conn->prepare($sql);
                $stm->bind_param('sssssss', $new_img_name, $id, $password, $name, $email,$gender, $telNum);
                $stm->execute();
                
                if($stm->affected_rows > 0){
                    $success = 'Added successfully.';
                    $color = 'green';
                }
                else {
                    $success = 'Failed to add.';
                    $color = 'red';
                }
            }

        }
        $con->close();
        ?>
        
        <style>
            .error{
                color: red;
                margin-left: 5%;
            }
        </style>
        
        <form id="addAdmin" name="addAdmin" action="" method="post" enctype="multipart/form-data">
           
                <p id="formTitle">Add Admin</p>
                <label for="admPic">Upload your picture : </label>
                <input type="file" name="admPic" id="admPic" style="font-size: 1.5vw;" required>
                <p class="error"><?php echo $ProfErr;?></p><br>
                
                <label for="admID">Enter your ID :</label>
                <input type="text" name="admID" id="admID" placeholder="E.g. A00000" required>
                <p class="error"><?php echo $idErr;?></p><br>
                
                <label for="admPassword">Enter your password :</label>
                <input type="password" id="admPassword" name="admPassword" required>
                <input type="checkbox" id="view" onchange="showPw()">
                <label for="view" style="margin-left: 0; font-size: 1.3vw; cursor: pointer;">Show Password</label>
                <p class="error"><?php echo $passErr;?></p><br>
                
                <label for="confirm">Confirm your password :</label>
                <input type="password" id="confirm" name="confirm" required>
                <span id="errorMsg" name="errorMsg" style="color: red; font-size: 1vw;">*</span>
                <p class="error"><?php echo $conErr;?></p><br>
                
                <label for="admName">Enter Name :</label>
                <input type="text" id="admName" name="admName" required>
                <br><br>
                
                <label for="admEmail">Enter E-Mail :</label>
                <input type="email" id="admEmail" name="admEmail" required>
                <br><br>
                
                <label>Select your gender :</label>
                <select id="admGender" name="admGender" style="font-size: 2vw;">
                    <option value="" selected disabled>---</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>   
                </select>
                <br><br>
                
                <label for="admTel" >Enter Telephone Number : </label>
                <input type="tel" required id="admTel" name="admTel" placeholder="E.g. 01x-xxx xxxx">
                <p class="error"><?php echo $phoneErr;?></p><br>
                
                <input type="submit" value="Submit" name="submit" style="margin-left: 5%; margin-bottom: 5%;">
                <input type="reset" value="Reset">
                <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
                <button onclick="cancelReg()" style="font-size: 2vw;">Cancel Register</button>
                <p style="color: <?php echo $color;?>; margin-left:5%;"><?php echo $success;?></p>
                <br><br>
        </form>
       
        
    </body>
</html>

