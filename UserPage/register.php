<?php 
    session_start();
    $PAGE_TITLE = 'Register';
    $active1 = '';
    $active2 = 'class="actived"';
    $active3 = '';
    $log = 'login.php';
    $regis = 'Homepage.php';
    $list = 'eventList.php';
    $title1 = 'Login';
    $title2 = 'Back to main page';
    $title3 = 'Event List';
    $width = 30;
    include('HPheader.php');
    include('Helper.php');
?>

<style>
    #reg
    {
        width: fit-content;
        margin: 40% auto 10%;
        position: relative; 
        background-color: white;
        padding: 5%;
        border: 1px solid black;
        border-radius: 10px;
        box-shadow: 1px 3px 8px rgb(140, 140, 140);
    }

    #click
    {
        color: blue;
        cursor: pointer;
    }
    .error{
        color: red;
    }
    
    @media only screen and (max-width: 1000px){
        #reg{
            margin: 50% auto 10%;
        }
    }
    @media only screen and (max-width: 830px){
        #reg{
            margin: 65% auto 10%;
        }
    }
    @media only screen and (max-width: 600px){
        #reg{
            margin: 80% auto 10%;
        }
    }
    @media only screen and (max-width: 470px){
        #reg{
            margin: 110% auto 10%;
        }
    }

</style>

<?php

    $nameErr = $idErr = $passErr = $genderErr = $emailErr = $reErr = '';

    if (isset($_POST["submit"])){
        if (empty($_POST["newName"])){
            $nameErr = "*Please enter your full name.";
        }
        else {
            $newName = test_input($_POST["newName"]);
            if (!preg_match("/^[A-Za-z]+(?:[\\s'-][A-Za-z]+)*$/", $newName)){
                $nameErr = "*There are invalid characters in your name.";
                $newName = '';
            }
        }
        
        if (empty($_POST['newID'])){
            $idErr = "*Please enter your full Student ID.";
        }
        else {
            $newID = strtoupper(test_input($_POST['newID']));
            
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql1 = "SELECT StudentID FROM studentlogin WHERE StudentID = '".$newID."'";
            $result = $con->query($sql1);
            
            if (!preg_match('/^\d{2}[a-zA-Z]{3}\d{5}$/', $newID)){
                $idErr = "*Please enter the correct Student ID.";
                $newID = '';
            }
            else if ($result->num_rows > 0){
                $idErr = "*This student ID is existed.";
            }
            
            $con->close();
        }
        
        if (empty($_POST['newPassword'])){
            $passErr = '*Please enter a strong password.';
        }
        else {
            $newPassword = test_input($_POST['newPassword']);
            if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$/', $newPassword)){
                $passErr = '*Password required atleast one capital letter, one digit, and one symbol.';
            }
        }
        
        if (empty($_POST['rePassword'])){
            $reErr = '*Please re-enter the password.';
        }
        else {
            $reEnter = test_input($_POST['rePassword']);
            if (strcmp($newPassword, $reEnter) != 0){
                $reErr = '*Re-Enter password incorrect.';
            }
        }
        
        if (empty($_POST['gender'])){
            $genderErr = '*Please select a gender.';
            $female = '';
            $male = '';
        }
        else {
            $gender = test_input($_POST['gender']);
            if ($gender == 'M'){
                $male = 'checked';
                $female = '';
            }
            else if ($gender == 'F'){
                $male = '';
                $female = 'checked';
            }
        }
        
        if (empty($_POST['newEmail'])){
            $emailErr = '*Please enter your email.';
        }
        else {
            $newEmail = test_input($_POST["newEmail"]);
            
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql2 = "SELECT StudentEmail FROM studentlogin WHERE StudentEmail = '".$newEmail."'";
            $result2 = $con->query($sql2);
            
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $newEmail)){
                $emailErr = '*Please enter your email with correct format.';
                $newEmail = '';
            }
            else if ($result2->num_rows > 0){
                $emailErr = "*This email is existed.";
                $newEmail = '';
            }
        }
        
        if (empty($nameErr) && empty($idErr) && empty($passErr) && empty($reErr) && empty($genderErr) && empty($emailErr)){
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = 'INSERT INTO studentlogin (StudentID, StudentName, Gender, StudentEmail, Password) 
                VALUE (?, ?, ?, ?, ?)';

            $newPassword = sha1($newPassword);
            $stm = $con->prepare($sql);
            $stm->bind_param('sssss', $newID, $newName, $gender, $newEmail, $newPassword);
            $stm->execute();

            if ($stm->affected_rows > 0){
                $_SESSION['alert'] = "window.onload = alert('Register Successfully!');";
                $con->close();
            }
            else {
                $_SESSION['alert'] = "window.onload = alert('Register Failed!');";
            }
            header("Location: login.php");
            exit();
        }
    }
    else {
        $newName = '';
        $newID = '';
        $newPassword = '';
        $reEnter = '';
        $female = '';
        $male = '';
        $newEmail = '';
        $alert = '';
    }
   
?>

        <div class="blocker">
            <form id="reg" method="post" action="">
                <legend id="register"><b>Register</b></legend>
                <br>
                <label for="userName">Enter your full name:</label><br>
                <input type="text" name="newName" placeholder="Your name here" required id="userName" value="<?php echo $newName;?>" maxlength="50">
                <p class="error"><?php echo $nameErr;?></p>
                <br>
                <label for="userId">Enter your student ID: </label><br>
                <input type="text" name="newID" placeholder="E.g. 99XXX99999" required id="userId" value="<?php echo $newID;?>">
                <p class="error"><?php echo $idErr;?></p>
                <br>
                <label for="userPassword">Enter your password:</label><br>
                <p>*(Must contain capital letter, digit, and symbol)</p>
                <input type="password" name="newPassword" placeholder="E.g. Abc1234$" required id="userPassword" maxlength="15" minlength="8">
                <p class="error"><?php echo $passErr;?></p>
                <br>
                <label for="reEnter">Re-enter your password:</label><br>
                <input type="password" name="rePassword" placeholder="Re-enter password" required id="reEnter" maxlength="15" minlength="8">
                <p class="error"><?php echo $reErr;?></p>
                <br>
                <label>Your gender:</label><br><br>
                <input type="radio" id="male" name="gender" id="userGender" value="M" <?php echo $male;?>>
                <label for="male" id="gend">Male</label>
                <input type="radio" id="female" name="gender" value="F" <?php echo $female;?>>
                <label for="female" id="gend">Female</label>
                <p class="error"><?php echo $genderErr;?></p>
                <br>
                <label for="userEmail">Enter your email:</label><br>
                <input type="email" name="newEmail" required placeholder="Please enter your email" id="userEmail" value="<?php echo $newEmail;?>" maxlength="30">
                <p class="error"><?php echo $emailErr;?></p>
                <br>
                <input type="submit" name="submit" id="registered" value="Submit">
                <input type="button" value="Reset"
                    onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'" />
                <br>
                <p>Already registered? &nbsp; <a href="login.php" id="click">Login now</a></p>
            </form>
        </div>
    </body>
</html>