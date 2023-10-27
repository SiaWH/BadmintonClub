<?php
    $title = 'Modify Event';
    $heading = 'Modify Events';
    require_once 'header.php';
?>
        <script src="./addEvent.js"></script>
        <script src="modifyEvent.js"></script>
        <link href="./modifyEvent.css" rel="stylesheet">
        
   
        <?php
        // Create a new database connection
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $sql5 ="SELECT MAX(EventID) AS eventID FROM eventdetails";
        $countEvent = 0;
        if($result = $con->query($sql5))
        {
            $row = $result->fetch_object();
            $countEvent= $row->eventID;
        }
        $allowed_max_row = $countEvent; // Set the maximum allowed row value
        
        if(isset($_GET['row'])){
            $row = $_GET['row']; // Get the row value from the URL parameter

            if ($row > $allowed_max_row) {
                // Redirect the user to an error page or some other appropriate page

                echo "<script>window.history.back();</script>";

                exit;
            }
        }
        else {
            echo "<script>window.history.back();</script>";
            exit;
        }
        
        ?>
            
            <?php
            $err = '';

// Check if the connection was successful
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Get the row number from the URL parameter
$rowNum = intval($_GET['row']);




// Prepare the SQL statement to select a specific row based on the row number
$sql = "SELECT * FROM eventdetails WHERE EventID = '$rowNum'";

if ($result = $con->query($sql)) {
  // Fetch the object of the selected row
  $row = $result->fetch_object();

  // Get the eventName property of the selected row
  $eName = $row->EventName;
  $eVenue = $row->Venue;
  $eStartDate = $row->StartDate;
  $eEndDate = $row->EndDate;
  $eStartTime = $row->StartTime;
  $eEndTime = $row->EndTime;
  $eMaxParticipants = $row->Max;
  $eDetails = $row->EventDetails;
  $eFee = $row->Fee;
}

//variable to check date
$statCheck = true;
          
echo '<form action="" method="post" id="modifyEvent" name="modifyEvent" onchange="showHidden()" enctype="multipart/form-data">
    <p id="title">Modify Event</p>
      <label>Event Poster : </label>
      <input type="file" id="eventPoster" name="eventPoster">
      <input type="hidden" name="row" value="'.$rowNum.'">
      <br><br>
      <label for="eventName">Event Name : </label>
      <input type="text" name="eventName" id="eventName" required style="width: 70%;" value="'.$eName.'">
      <br><br>
      <label for="eventVenue[]">Event Venue : </label>
      <input type="text" id="eventVenue" name="eventVenue" value="'.$eVenue.'" margin-top: 2%; margin-left:19.5%; width: 50%;" required>
      
      <input type="text" id="others" name="others" placeholder="Enter the location" style="display: none; margin-top: 2%; margin-left:19.5%; width: 50%;" disabled required>
      <br><br>
      <label for="startDate">Start Date : </label>
      <input type="date" name="startDate" id="startDate" required value="'.$eStartDate.'">
      <br><br>
      <label for="endDate">End date : </label>
      <input type="date" name="endDate" id="endDate" required value="'.$eEndDate.'">
      <br><br>
      <label for="startTime">Start Time : </label>
      <input type="time" name="startTime" id="startTime" required value="'.$eStartTime.'">
      <br><br>
      <label for="endTime">End Time : </label>
      <input type="time" name="endTime" id="endTime" required value="'.$eEndTime.'">
      <br><br>
      <label for="maxParticipants">Max Participants : </label>
      <input type="number" name="maxParticipants" id="maxParticipants" min="1" max="200" style="width: 15%;" required value="'.$eMaxParticipants.'">
      <br><br>
      <label for="details">Event Details :</label>
      <input type="text" name="details" id="details" style="width: 70%; word-wrap: break-word; overflow: hidden;" required value="'.$eDetails.'">
      <br><br>
      <label for="price">Enter event entry fees :</label>
      <input type="number" id="price" name="price" value="'.$eFee.'" step="0.01"min="0" required>
      <br>
      <br>
      <input type="submit" value="Update Event" name="modifyEvent" style="margin-left: 5%; margin-bottom: 5%;">
      <input type="reset" value="Cancel" onclick="back()">
      <input type="submit" value="Delete Event" name="deleteEvent" onclick="return confirm(\'Are you sure you want to delete the event?\')">
      </form>';

      
      if (isset($_POST['modifyEvent'])) {
    
    // Get the input values from the form
    $eventName = $_POST['eventName'];
    $eventVenue = $_POST['eventVenue'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $maxParticipants = $_POST['maxParticipants'];
    $details = $_POST['details'];
    $eFee = $_POST['price'];
    $fileName = $_FILES["eventPoster"]["name"];
    
    // Validate dates
    $startTimestamp = strtotime($startDate . ' ' . $startTime);
    $endTimestamp = strtotime($endDate . ' ' . $endTime);

    if ($endTimestamp < $startTimestamp) 
    {
        echo '<script>alert("End date must not be before start date.")</script>';
        // Set submit flag to false
        $statCheck = false;
    }
    
    //File handling
    
     if (isset($_FILES['eventPoster'])) 
        { 
            $file = $_FILES['eventPoster'];

            if ($file['error'] > 0)
            {
                // Check error code.
                switch ($file['error'])
                {
                    case UPLOAD_ERR_NO_FILE: // Code = 4.
                        
                        break;
                    case UPLOAD_ERR_FORM_SIZE: // Code = 2.
                        echo '<script>alert("File rejected. Maximum 5MB allowed.");</script>';
                        break;
                    default: // Other codes.
                        echo '<script>alert("There was an error while uploading the file.");</script>';
                        break;
                    
                }
            }
            else if ($file['size'] > 5242880)
            {
                echo '<script>alert("File rejected. Maximum 5MB allowed.");</script>';
            }
            
            
            else
            {
                // Extract the file extension.
                // Convert to lowercase for easy checking.
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                // Check the file extension.
                if ($ext != 'jpg'  &&
                    $ext != 'jpeg' &&
                    $ext != 'gif'  &&
                    $ext != 'png')
                {
                    echo '<script>alert("File rejected. Only JPG, GIF and PNG format are allowed.");</script>';
                }
            
                
                
                else
                {
                    $save_as = uniqid() . '.' . $ext;

                    // Save the file.
                    move_uploaded_file($file['tmp_name'], '../Userpage/picture/Event/' . $save_as);
                    
                    $sql2 = "UPDATE eventdetails SET EventPoster = '$save_as'";
                    if ($result = $con->query($sql2)){
                        echo '<script>alert("Operation Success, Event Poster has been modified.");</script>';
                    }
                    else
                    {
                        echo '<script>alert("Error!");</script>';
                    }
                }
            }
            
        }
    
    
    
    
    // Construct the SQL statement to update the selected row in the database
    $sql1 = "UPDATE eventdetails SET EventName = '$eventName', Venue='$eventVenue', StartDate='$startDate', EndDate='$endDate', StartTime='$startTime', EndTime='$endTime', Max='$maxParticipants', EventDetails='$details', Fee = '$eFee' WHERE EventID = $rowNum";

    
    if (isset($_POST['modifyEvent']) && $statCheck) 
      {
        // Execute the SQL statement
        if($result = $con->query($sql1))
        {
            echo '<script>alert("Operation Success, Event Details has been modified.");</script>';
        }
        else
        {
            echo '<script>alert("Error!");</script>';
        }
      }
    
    
}

if (isset($_POST['deleteEvent'])) 
{
  // Delete the event
  $num = $_GET['row'];
  $sql2 = "DELETE FROM eventdetails WHERE EventID = $num";
  
  // Execute the SQL statement
    if($result = $con->query($sql2))
    {
        $con->close();
        exit(-1);
    }
    
    else
    {
        echo 'Error!!';
    }
    
    // Close the database connection
    
    
}

?>

            
         
        
        
        
        <table id="participants" style="margin-bottom: 5%;">
            
            
            <tr>
                <th id="n" colspan="5" style="font-size:3vw;color: white;background-color: black;">Participant Details</th>
            </tr>
            
            
            <tr id="participantDetails">
                <th>No.</th>
                <th>Name</th>
                <th>Student ID</th>
                <th>Action</th>
                <th>Payment</th>
            </tr>
            

                <?php

                $i = 1;
    $count = 0;
    $rowNum = intval($_GET['row']);

    $sql3 = "SELECT * FROM eventbooking WHERE EventID = $rowNum";

    if ($result = $con->query($sql3)) 
    {
        // Fetch the object of the selected row
        while($row = $result->fetch_object()) 
        {
            $count++;
            $stdName = $row->StudentName;
            $stdID = $row->StudentID;
            $stdEventID = $row->EB_ID;
            $payment = $row->Payment;

            echo '<tr id="contacts">
            <td>'."$count".'</td>
            <td>'. "$stdName".'</td>
            <td>'."$stdID".'</td>
            <td>
                <form name="participantOut" id="participantOut" style="border:none;margin-top:0;" method="post" action="modifyEvent.php?row='.$rowNum.'">
                    <input type="hidden" name="participantOut" value="'.$stdID.'">
                    <input type="submit" style="font-size:1em;" onclick="return confirm(\'Are you sure you want to delete participant?\')" value="Remove Participant">
                </form>
            </td>
            <td><a href="../Userpage/picture/EventPayment/'.$payment.'" target="blank";>View</a></td>
        </tr>';
        }
    }

     if ($result->num_rows == 0) 
        {
            echo '<tr><td colspan="5" style="text-align:center; font-size:1.5em;">No participants</td></tr>';
        }

    if(isset($_POST['participantOut'])) {

        //Get student ID
        $participantID = $_POST['participantOut'];

        //Delete from eventBooking table where student id and event id is match
        $sql4 = "DELETE FROM eventbooking WHERE StudentID = '$participantID' AND EB_ID = '$stdEventID'";

        if($result = $con->query($sql4)) 
        {
            echo 'Participant deleted successfully.';
        } 

        else 
        {
            echo 'Error deleting participant: ' . $con->error;
        }
    }

// Close the database connection
    $con->close();
                ?>
        </table>
       
    </body>
        
   
    
</html>