<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link href="./adminLogin.css" rel="stylesheet">
        <title>Admin Login</title>
    </head>

    <?php
        include 'default/default.php';
        $idError = '';
        $pwError = '';
            
        if(isset($_POST['submit'])){
            $adminId = $_POST['adminId'];
            $password = $_POST['password'];
            
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = "SELECT adminID, adminPassword, Status FROM admin WHERE adminID = '$adminId'";
            $result = $con->query($sql);
            if ($result->num_rows == 0){
                $idError = "This ID is not exist.";
            }
            else {
                $row = $result->fetch_assoc();
                if ($row['Status'] == 0){
                    $idError = "This account is suspended.";
                }
                else {
                    if ($password == $row['adminPassword']){
                        session_start();
                        $_SESSION['adminId'] = $adminId;
                        header('Location: adminPage.php');
                    }
                    else {
                        $pwError = "Wrong password.";
                    }
                }
            }
        }
            
    ?>
    
    <style>
        .error{
            color: red;
        }
    </style>
    
    <body>
        <video id="video" autoplay loop muted>
        <source src="./video/badminton.mp4" type="video/mp4">
        </video>

        <form id="adminLogin" method="post" action="">
            <fieldset>
                <legend>Admin Login</legend>
                <br>
                <label for="adminId">User ID : </label>
                <input type="text" id="adminId" name="adminId" required autofocus>
                <p class="error"><?php echo $idError;?></p><br>
                <label for="password">Password : </label>
                <input type="password" id="password" name="password" required>
                <p class="error"><?php echo $pwError;?></p><br><br>
                <input type="submit" name="submit">
                <button type="reset">Reset</button>
            </fieldset>
        </form>

    </body>
</html>

