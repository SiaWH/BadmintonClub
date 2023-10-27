<?php
    $title = 'Manage Admin';
    $heading = 'Admin Management';
    require_once 'header.php';
?>

<link rel="stylesheet" href="manageAdmin.css"/>
<script src="manageAdmin.js"></script>

<table id="admin">
            <tr style="background-color: black; opacity: 80%;" id="tr">
                <th>No.</th>
                <th>Admin Name</th>
                <th>Admin ID</th>
                <th>Admin Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Suspend Account</th>
            </tr>
            
            <?php
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            $sql = "SELECT * FROM admin WHERE superAdmin = 0";
            
            $count= 1;
            
            if ($result = $con->query($sql)) 
            {
                // Fetch the object of the selected row
                while($row = $result->fetch_object())
                {
                //Obtain data from database
                $adminName = $row->adminName;
                $adminID = $row->adminID;
                $adminEmail = $row->adminEmail;
                $adminPhone = $row->adminPhone;
                $adminGender = $row->adminGender;
                $stat = $row->Status;
                
                //Number count
                
                
                echo '<tr>
                <td>'.$count.'.'.'</td>
                <td>'.$adminName.'</td>
                <td>'.$adminID.'</td>
                <td><a href="tel:'.$adminPhone.'" style="color: sienna;">'.$adminPhone.'</a></td>
                <td>'.$adminGender.'</td>
                <td><a href="mailto:'.$adminEmail.'" style="color: sienna;">'.$adminEmail.'</a></td>';
                if ($stat == 1)
                { echo 
                 '<td>   
                <form name="admin'.$count.'" id="admin'.$count.'" style="border:none;margin-top:0;" method="post" action="manageAdmin.php">
                            <input type="hidden" name="adminId" value="'.$adminID.'">
                            <input type="submit" style="font-size:1em;" onclick="return confirm(\'Are you sure you want to suspend this admin?\')" value="Suspend Admin">
                </form>
                </td>
                    </tr>';
                }
                
                
                else
                {
                    echo '<td>   
                <form name="admin'.$count.'" id="admin'.$count.'" style="border:none;margin-top:0;" method="post" action="manageAdmin.php">
                            <input type="hidden" name="activeAdmin" value="'.$adminID.'">
                            <input type="submit" style="font-size:1em;" onclick="return confirm(\'Are you sure you want to active this admin?\')" value="Active Admin">
                </form>
                </td>';
                }
                
                $count++;
                
                }
            }
            
            
            if(isset($_POST['adminId'])) 
            {
                $delID = $_POST['adminId'];
               
                $sqlDelAdmin = "UPDATE admin SET Status = '0' WHERE adminID = '$delID'";
                
                
                if($con->query($sqlDelAdmin)) 
                {
                    echo '<script> alert("Admin suspended successfully."); window.location.assign("http://localhost/demoWeb/manageAdmin.php");</script>';

                } 
                else 
                {
                    echo 'Error when suspending admin: '.$con->error;
                }
            }
            
            if(isset($_POST['activeAdmin'])) 
            {
                $delID = $_POST['activeAdmin'];
               
                 $sqlActiveAdmin = "UPDATE admin SET Status = '1' WHERE adminID = '$delID'";
                
                
                if($con->query($sqlActiveAdmin)) 
                {
                    echo '<script> alert("Admin actived successfully."); window.location.assign("http://localhost/demoWeb/manageAdmin.php");</script>';

                } 
                else 
                {
                    echo 'Error when active admin: '.$con->error;
                }
            }
            
           
  
            ?>
            
            
            
            
            
        </table>
        
        
    </body>
</html>

