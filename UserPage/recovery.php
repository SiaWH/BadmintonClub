<?php 
    $PAGE_TITLE = 'Password Recovery';
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $log = 'login.php';
    $regis = 'Homepage.php';
    $title1 = 'Login';
    $title2 = 'Back to main page';
    $list = 'eventList.php';
    $width = 45;
    include('HPheader.php');
    include('Helper.php');
?>

<style>
    .pwCovery{
        width: fit-content;
        margin: 33% auto 10%;
        background-color: white;
        padding: 5%;
        border: 1px solid black;
        border-radius: 10px;
        box-shadow: 1px 3px 8px rgb(140, 140, 140);
    }
    
    @media only screen and (max-width: 1000px){
        .pwCovery{
            margin: 50% auto 10%;
        }
    }
    @media only screen and (max-width: 830px){
        .pwCovery{
            margin: 65% auto 10%;
        }
    }
    @media only screen and (max-width: 600px){
        .pwCovery{
            margin: 80% auto 10%;
        }
    }
    @media only screen and (max-width: 470px){
        .pwCovery{
            margin: 110% auto 10%;
        }
    }
</style>

<?php
    if(isset($_POST['submit'])){
        $pwEmail = test_input($_POST['pwEmail']);
        
        if(preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $pwEmail)){
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = "SELECT * FROM studentlogin WHERE StudentEmail = '$pwEmail'";
            $tempPass = sha1('Abc1234@');
            $sql2 = "UPDATE studentlogin SET Password = '$tempPass' WHERE StudentEmail = '$pwEmail'";
            $result = $con->query($sql);
            
            if($result->num_rows > 0){
//                $row = $result->fetch_assoc();
//                $name = $row['StudentName'];
                
                if($result2 = $con->query($sql2)){
//                    mail($row['StudentEmail'], 'noreply: Password Recovery Inform', "Hi $name, I'm one of the admins of TARUMT Badminton Club, "
//                        . "I'm here to inform you that we have changed your password to 'Abc1234@' "
//                        . "as temporary password for you to login due to your issue, you can change the password in the account setting after this. "
//                        . "Thanks for your support of our club!");
                    $error = 'Please check your email.';
                    $color = 'green';
                }
                else {
                    $error = '*There is some unknown issues occured.';
                    $color = 'red';
                }
            }
            else{
                $error = '*This email have not been registered.';
                $color = 'red';
            }
        }
        else {
            $error = '*Please enter the correct email.';
            $color = 'red';
        }
    }
    else {
        $error = '';
        $color = 'red';
    }
?>

<div class="blocker">
    <div class="pwCovery">
        <form method="post" action="">
            <legend><b>Password Recovery</b></legend>
            <br>
            <label for="email" style="opacity: 60%;">*Enter the email address associated<br> with your account to change your<br> password</label>
            <br><br>
            <input type="email" id="email" name="pwEmail" placeholder="Email Address" required>
            <p style="color: <?php echo $color;?>;"><?php echo $error;?></p><br>
            <input type="submit" name="submit" value="Send">
            <input type="reset" value="Reset">
        </form>
        <br>
        <button onclick="window.location.href = 'login.php'">Back</button>
    </div>
</div>

</body>
</html>