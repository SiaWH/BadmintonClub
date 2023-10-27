<?php
    $title = 'List of Trainees';
    $heading = 'List Of Trainees';
    require_once 'header.php';
?>
        <script src="./viewTrainees.js"></script>
        <link rel="stylesheet" href="viewTrainees.css"/>
        
        <table id="trainees">
            <tr id="testing">
                <th>No.</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>User Email</th>
                <th>Action</th>
                <th>Payment</th>
            </tr>
            
            <?php
            $icount = 1;
            $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            $sql1 = "SELECT * FROM coachbooking WHERE CoachID ='C001' AND Time = '6.00 ~ 7.30'";
            $sql2 = "SELECT * FROM coachbooking WHERE CoachID ='C001' AND Time = '7.30 ~ 9.00'";
            $sql3 = "SELECT * FROM coachbooking WHERE CoachID ='C002' AND Time = '6.00 ~ 7.30'";
            $sql4 = "SELECT * FROM coachbooking WHERE CoachID ='C002' AND Time = '7.30 ~ 9.00'";
            
            $id = $_GET['CoachID'];
            $time = $_GET['Time'];
            $runSQL = "";

            if($id == "C001" && $time == "6.00 ~ 7.30")
            {
                $runSQL = $sql1;
            }
            
            else if($id == "C001" && $time == "7.30 ~ 9.00")
            {
                $runSQL = $sql2;
            }
            
            else if($id == "C002" && $time == "6.00 ~ 7.30")
            {
                $runSQL = $sql3;
            }
            
            else if($id == "C002" && $time == "7.30 ~ 9.00")
            {
                $runSQL = $sql4;
            }
            
            if ($result = $connect->query($runSQL))
{
    if(mysqli_num_rows($result) == 0) 
    {
        echo '<tr><td colspan="6">No trainees at this time</td></tr>';
    }
    else
    {
        while($row = $result->fetch_object())
        {
            $name = $row->StudentName;
            $tel = $row->PhoneNumber;
            $mail = $row->StudentEmail;
            $pic = $row->Payment;

            echo '<tr>
                    <td>'.$icount.'</td>
                    <td>'.$name.'</td>
                    <td><a href="tel:'.$tel.'" style="color: sienna;">'.$tel.'</a></td>
                    <td><a href="mailto:'.$mail.'" style="color: sienna;">'.$mail.'</a></td>
                    <td>
                        <form name="participantOut'.$icount.'" id="participantOut'.$icount.'" style="border:none;margin-top:0;" method="post" action="viewTrainees.php?CoachID='.$id.'&Time='.$time.'">
                            <input type="hidden" name="participantName" value="'.$name.'">
                            <input type="submit" style="font-size:1em;" onclick="return confirm(\'Are you sure you want to remove participant?\')" value="Remove Participant">
                        </form>
                    </td>
                    
                    <td><a href="../Userpage/picture/TrainingPayment/'.$pic.'" target="blank">Click Me!</a></td>
                    
                </tr>';

            $icount++;
        }
    }
}

if(isset($_POST['participantName'])) 
{
    $stdname = $_POST['participantName'];
    
    $sqlDel = "DELETE FROM coachbooking WHERE StudentName = '$stdname'";
    
    if($connect->query($sqlDel)) 
    {
        echo '<script> alert("Participant deleted successfully."); window.location.assign("http://localhost/demoWeb/adminPage.php");</script>';

    } 
    else 
    {
        echo 'Error deleting participant: '.$connect->error;
    }
} 

            
            
            ?>
        </table>
