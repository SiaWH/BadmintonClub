<?php
    $title = 'Manage User';
    $heading = 'Manage Users';
    require_once 'header.php';
?>
        <link href="./manageUser.css" rel="stylesheet">
        <script src="./manageUser.js"></script>
        
        <style>
            #suspend{
                padding: 1%;
                margin: 2% 1% 2% 5%;
            }
            #active{
                padding: 1%;
                margin: 1%;
            }
        </style>
        
        <?php
            if (isset($_POST['suspend']))
            {
                $checked = $_POST['checked'];

                if (!empty($checked)) 
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    foreach ($checked as $value)
                    {
                        $escaped[] = $con->real_escape_string($value);
                    }

                    $sql = "UPDATE studentlogin SET status = '0' WHERE StudentID IN ('" .
                           implode("','", $escaped) . "')";

                    $con->query($sql);
                            
                    $con->close();
                }
            }
            else if (isset($_POST['active'])){
                
                $checked = $_POST['checked'];

                if (!empty($checked)) 
                {
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    foreach ($checked as $value)
                    {
                        $escaped[] = $con->real_escape_string($value);
                    }

                    $sql = "UPDATE studentlogin SET status = '1' WHERE StudentID IN ('" .
                           implode("','", $escaped) . "')";

                    $con->query($sql);
                            
                    $con->close();
                }
            }
        ?>
        
        <form method="post" action="">
        <table id="users">
            <tr style="background-color: black; opacity: 80%;" id="tr">
                <th></th>
                <th>No.</th>
                <th>User Name</th>
                <th>User ID</th>
                <th>Gender</th>
                <th>User Email</th>
                <th>Account Status</th>
            </tr>
            
            <?php 
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = "SELECT * FROM studentlogin";
                if($result = $con->query($sql)){
                    $count = 1;

                    while($row = $result->fetch_assoc()){
                        if($row['Gender'] == 'M'){
                            $gender = "Male";
                        }
                        else {
                            $gender = "Female";
                        }

                        if($row['Status'] == 1){
                            $status = "Active";
                        }
                        else {
                            $status = "Suspended";
                        }

                        printf('<tr>
                                    <td>
                                        <input type="checkbox" name="checked[]" value="%s" />
                                    </td>
                                    <td>%d.</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td><a href="mailto:%s" style="color: sienna;">%s</a></td>
                                    <td id="remove">%s</td>
                                </tr>', $row['StudentID'], $count, $row['StudentName'], $row['StudentID'], 
                                $gender, $row['StudentEmail'], $row['StudentEmail'], $status);

                        $count++;
                    }
                }
                else {
                    printf('<tr><td colspan="7">No Record.</td></tr>');
                }                
            ?>
            
        </table>
            <input type="submit" name="suspend" value="Suspend Checked"
           onclick="return confirm('This will suspend all checked account.\nAre you sure?')" id="suspend"/>
            
            <input type="submit" name="active" value="Active Checked"
           onclick="return confirm('This will active all checked account.\nAre you sure?')" id="active"/>
        </form>
        
    </body>
</html>

