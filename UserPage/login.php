<?php 
    session_start();
    $PAGE_TITLE = 'Login';
    $active1 = 'class="actived"';
    $active2 = '';
    $active3 = '';
    $log = 'Homepage.php';
    $list = 'eventList.php';
    $regis = 'register.php';
    $title1 = 'Back to main page';
    $title2 = 'Register';
    $title3 = 'Event List';
    $width = 40;
    include('HPheader.php');
    include 'Helper.php';
?>

<?php
    $stdID = $errorID = $errorPASS = '';
    
    if (isset($_SESSION['alert'])){
        $alert = $_SESSION['alert'];
    }
    else {
        $alert = '';
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $stdID = strtoupper($_POST['id']);
        $stdPass = $_POST['password'];
        $stdPass = sha1($stdPass);
        
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT StudentID FROM studentlogin WHERE StudentID='$stdID'"; 
        $sql2 = "SELECT Password FROM studentlogin WHERE Password='$stdPass'"; 
        $sql4 = "SELECT Status FROM  studentlogin WHERE StudentID='$stdID'";
        $result = $con->query($sql);
        $result2 = $con->query($sql2);
        $result4 = $con->query($sql4);
        $row2 = $result4->fetch_assoc();
        
        if ($result->num_rows == 0){
            $errorID = "*This student ID haven't register yet.";
            $stdID = '';
        }
        else if ($result2->num_rows == 0){
            $errorPASS = "*Wrong password.";
        }
        else {
            if ($row2['Status'] == 1){
                session_start();
                $_SESSION['stdID'] = $stdID;
                $sql3 = "SELECT StudentName FROM studentlogin WHERE StudentID = '$stdID'";
                $result3 = $con->query($sql3);
                $row = $result3->fetch_assoc();
                $name = $row['StudentName'];
                $_SESSION['welcome'] = "window.onload = alert('Welcome, $name');";
                $result3->free();
                header("Location: user.php");
            }
            else {
                $errorID = "*This student ID is suspended.";
            }
        }
        
        $con->close();
    }
?>

<style>
    #loginPage
    {
        width: fit-content;
        margin: 35% auto 0;
        position: relative;
        background-color: white;
        padding: 5%;
        border: 1px solid black;
        border-radius: 10px;
        box-shadow: 1px 3px 8px rgb(140, 140, 140);
    }
    
    .error{
        color: red;
    }
    
    @media only screen and (max-width: 1000px){
        #loginPage{
            margin: 60% auto 0;
        }
    }
    @media only screen and (max-width: 700px){
        #loginPage{
            margin: 80% auto 0;
        }
    }
    @media only screen and (max-width: 550px){
        #loginPage{
            margin: 100% auto 0;
        }
    }
    @media only screen and (max-width: 400px){
        #loginPage{
            margin: 130% auto 0;
        }
    }

</style>

<script>
    <?php echo $alert;?>
</script>

<div class="blocker">
    <form id="loginPage" method="post" action="">
        
        <legend id="login"><b>Login</b></legend>
        <br>
        <label for="id">Enter your student ID:</label><br>
        <input type="text" name="id" placeholder="Student ID" required id="name" value="<?php echo $stdID;?>">
        <p class="error"><?php echo $errorID;?></p>
        <br>
        <label for="password">Enter your password:</label><br>
        <input type="password" name="password" placeholder="Password" required id="pw">
        <p class="error"><?php echo $errorPASS;?></p>
        <br>
        <input type="submit" id="submit" value="Submit">
        <input type="reset" id="reset" value="Reset">
        <br><br>
        <p>Not registered? &nbsp; <a href="register.php" id="click">Register now</a></p>
        <a href="recovery.php">Forgot password?</a>
    </form>
</div>

<?php 
    if (isset($_SESSION['alert'])){
        unset($_SESSION['alert']);
    }
?>

</body>
</html>