<?php
    $title = 'Admin Page';
    $heading = 'Manage Events and Trainings';
    require_once 'header.php';
?>

        
        <p id="title1">Event Details</p>
       
            
        <table id="dashboard">

            <tr>
                <?php
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
               $countTotal = 0;
               $participantCount = 0;
                
                $iAvailableCount = 0;
                $sql1 = "SELECT * FROM eventDetails a LEFT JOIN (SELECT EB_ID, COUNT(*) AS numParticipants FROM eventbooking GROUP BY EB_ID) b ON a.eventID = b.EB_ID";

                $sql6 = "SELECT * FROM eventbooking";

                
    if ($result1 = $con->query($sql1))
    {
        while($row = $result1->fetch_object())
        {
            
            if ($row->Availability == "1")
            {
                $iAvailableCount++;
            }
            
            $countTotal++;
            
        }
    }
    
    if($result6 = $con->query($sql6))
    {
        while($row = $result6->fetch_object())
        {
            $participantCount++;
        }
    }
            
    
                $sql2 = "SELECT * FROM eventdetails";
                $result2 = $con->query($sql2);
              printf('<td id="border" colspan="2">Total Event Count = '.$countTotal.' </td>'
                       . '<td id="border">Total Participants = '.$participantCount.'</td>'
                      . '<td id="border">No. of Available Events = '.$iAvailableCount.'</td>', $result2->num_rows); ?>
                

            </tr>
        </table>
        
        <table id="listEvents">
            <tr style="border-bottom: solid black 2px; background-color: darkcyan;">
                <td>No. </td>
                <td>Event Name</td>
                <td>No. Of Participants</td>
                <td>Status</td>
            </tr>
            
            <!--Check event available or not -->
            <?php 

            $sql3 = "SELECT * FROM eventdetails";

            if ($result = $con->query($sql3))
            {
                while($row = $result->fetch_object())
                {
                    $maxP = $row->Max;
                    $ID = $row->EventID;
                    $eventDate = $row->EndDate;

                    $sqlSelect = $con->prepare("SELECT COUNT(*) FROM eventbooking WHERE EventID = ?");
                    $sqlSelect->bind_param("i", $ID);
                    $sqlSelect->execute();
                    $participantCount = $sqlSelect->get_result()->fetch_array()[0];

                    //Use strtotime to convert database time into actual time value and compare with time() function
                    
                    if($participantCount >= $maxP || strtotime($eventDate) < time())
                    {
                        $sqlDisable = "UPDATE eventdetails SET Availability = 0 WHERE eventID = '$ID'";
                        if (!$con->query($sqlDisable)) 
                        {
                            echo "Error updating event status: " . $con->error;
                        }
                    }
                    else
                    {
                        $sqlEnable = "UPDATE eventdetails SET Availability = 1 WHERE eventID = '$ID'";
                        if (!$con->query($sqlEnable)) 
                        {
                            echo "Error updating event status: " . $con->error;
                        }
                    }
                }
            }
            ?>
            

<!--            use php to print out database results-->


          <?php 
    
    
    $sql = "SELECT * FROM eventdetails ORDER BY EventID DESC";
    $strStatus;
    
    
    
    if ($result = $con->query($sql))
    {
        $counter = 1;
        while($row = $result->fetch_object())
        {
            $eventID = $row->EventID;
            
            $sql3 = "SELECT Count(*) AS pCount FROM eventbooking WHERE EventID = '$eventID'";
            $result3 = $con->query($sql3);
            $row3 = $result3->fetch_assoc();
            $pCount = $row3['pCount'];
            
            $participantCount = $row->Max;
            
            if ($row->Availability == "1")
            {
                $strStatus = "Available";
                $iAvailableCount++;
            }
    
            else
            {
                $strStatus = "Not Available";
            }
    
            
            printf('<tr style="cursor:pointer;" onclick="window.location.href=\'modifyEvent.php?row=%s\'">'
        . '<td>%d</td>'
        . '<td>%s</td>'
        . '<td>%s/%s</td>'
        . '<td>%s</td>'
        .'</tr>', 
        $row->EventID,
        $counter,
        $row->EventName,
                    //Change this
        $pCount,
        $participantCount,
        $strStatus
    );
            $counter++;
        }
       
    }
    
            $result->free();
            $con->close();
            
            ?>
    
    
    
        </table>
        
        
        
        </table>
        
        
        
        <p id="test2">Training Details</p>
        
        <table id="training">
            <tr id="x">
                <th id="test">Name</th>
                <th  style="border: 1px solid black;">Ow Kah Rok (TUE)</th>
                <th>Kenneph Ooi Wei Jie (THU)</th>
            </tr>
            
            <tr>
                <th style="border-bottom: 1px solid black;">Time (6.00PM to 7.30 PM)</th>
                <td><a href="./viewTrainees.php?CoachID=C001&Time=6.00%20~%207.30">View Trainees</a></td>
                <td><a href="./viewTrainees.php?CoachID=C002&Time=6.00%20~%207.30">View Trainees</a></td>
            </tr>
            
            <tr>
                <th>Time (7.30PM to 9.00 PM)</th>
                <td><a href="./viewTrainees.php?CoachID=C001&Time=7.30%20~%209.00">View Trainees</a></td>
                <td><a href="./viewTrainees.php?CoachID=C002&Time=7.30%20~%209.00">View Trainees</a></td>
            </tr>
        </table>


            
        </span>

    </body>


</html>
