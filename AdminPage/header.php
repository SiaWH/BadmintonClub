<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link href="./adminPage.css" rel="stylesheet">
        <script src="./adminPage.js"></script>
        <script src="defaultOperations.js"></script>
        <script src="adminLogin.js"></script>
        <title><?php echo $title;?></title>
    </head>     
        
    
 
    
    <body onload="changePic()">
        <?php             
            include 'default/default.php';
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            session_start();
            $adminID = $_SESSION['adminId'];
            $sql = "SELECT * FROM admin WHERE adminID = '$adminID'";
            $result = $con->query($sql);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $adminPhoto = $row['adminPhoto'];
                $adminName = $row['adminName'];
                $adminEmail = $row['adminEmail'];
                $adminGender = $row['adminGender'];
                $adminPhone = $row['adminPhone'];
                $superAdmin = $row['superAdmin'];
            }
            else {
                header('Location: adminLogin.php');
            }
        ?>
    <header>
   
        <span id="t1" style="width : 100%; margin-top: 0%; margin-left: 0;">

            <img src="./picture/menu.png" alt="menu" id="menu" title="Control Menu" onclick="show()" style="cursor: pointer;">
            
            <img src="./picture/darkMode.png" alt="dark" onclick="dark()" title="dark mode" id="darkMode" style="cursor: pointer;">
             
                    <h1 id="h1"><?php echo $heading;?></h1>

                    <a href="logout.php"><img src="./picture/AdminProfile/<?php echo $adminPhoto;?>" id="adminLogo" alt="adminPic" title="Log Out" onclick="return confirm('Are you sure to logout?')"></a>
     
        </span>
        
        
        
        </header>
        
        <script>
        function changePic()
    {
        const pic = document.querySelector('#adminLogo');

        pic.addEventListener('mouseover', function() {pic.src = './picture/logOutIcon.png';});

        pic.addEventListener('mouseout', function() {pic.src = './picture/AdminProfile/<?php echo $adminPhoto;?>'; pic.style.width = "4%";});    

    }
    </script>
        
        <table id="controlMenu" class="hide">
                <tr>
                    <td style="cursor: pointer;" onclick="addEvent()">Add Event</td>
                </tr>
            
                <tr>
                    <td onclick="manageEvent()" style="cursor: pointer;">Event and Trainings</td>
                </tr>
                
                <tr>
                    <td onclick="manageUser()" style="cursor: pointer;">Manage User Accounts</td>
                </tr>
                
                <tr>
                    <td onclick="manageCurrent()" style="cursor: pointer;">Manage Current Account</td>   
                </tr>
                
                <?php
                    if ($superAdmin == 1){
                        printf('<tr>
                                    <td onclick="addAdmin()" style="cursor:pointer">Add New Admin</td>
                                </tr>
                                <tr>
                                    <td onclick="manageAdmin()" style="cursor:pointer">Manage Admin</td>
                                </tr>');
                    }              
                ?>
                
                <tr>
                    <td onclick="checkReview()" style="cursor:pointer">Check Reviews</td>
                </tr>
                
            </table>