<?php
    $title = 'Add Event';
    $heading = '';
    require_once 'header.php';
?>

        <link href="./addEvent.css" rel="stylesheet">
        <script src="./addEvent.js"></script>

        <title>Add Event</title>
    </head>
    <script>
    function setEndDateMin() {
        var startDate = new Date(document.getElementById("startDate").value);
    var endDateInput = document.getElementById("endDate");
    var endDate = new Date(endDateInput.value);
    
    if (startDate.getTime() > endDate.getTime()) {
        endDateInput.value = document.getElementById("startDate").value;
    }
    
    var minEndDate = new Date(startDate.getTime() + 86400000);
    endDateInput.min = minEndDate.toISOString().slice(0,10);
    }
    </script>
    
    <?php $err = ''; $success='';?>
    
    <?php
        
            if (isset($_FILES['eventPoster'])) 
            { 
                $file = $_FILES['eventPoster'];

                if ($file['error'] > 0)
                {
                    // Check error code.
                    switch ($file['error'])
                    {
                        case UPLOAD_ERR_NO_FILE: // Code = 4.
                            $err = 'No file was selected.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE: // Code = 2.
                            $err = 'File uploaded is too large. Maximum 1MB allowed.';
                            break;
                        default: // Other codes.
                            $err = 'There was an error while uploading the file.';
                            break;
                    }
                }
                else if ($file['size'] > 5242880)
                {
                    $err = 'File uploaded is too large. Maximum 5MB allowed.';
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
                        $err = 'Only JPG, GIF and PNG format are allowed.';
                    }



                    else
                    {
                        $save_as = uniqid() . '.' . $ext;

                        // Save the file.
                        move_uploaded_file($file['tmp_name'], '../Userpage/picture/Event/' . $save_as);
                    }
                }

            }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            
            $eventName = test_input($_POST["eventName"]);
            $eventVenue = test_input($_POST["eventVenue"]);
            $startDate = test_input($_POST["startDate"]);
            $endDate = test_input($_POST["endDate"]);
            $startTime = test_input($_POST["startTime"]);
            $endTime = test_input($_POST["endTime"]);
            $maxParticipants = test_input($_POST["maxParticipants"]);
            $details = test_input($_POST["details"]);
            $fees = test_input($_POST["price"]);
        }

        //Set default information of the SQL database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $DB_NAME = "badmintonclub";
        
        //Make connection to database
        $conn = new mysqli($servername, $username, $password, $DB_NAME);
        
        //Print error messeage if cannot connect
        if($conn->connect_error)
        {
            die("Connection failed" . $conn->connect_error);
        }
       
        
        
        //Use SQL command to insert data into database
        $sql = 'INSERT INTO eventdetails (EventPoster, EventName, Venue, StartDate, EndDate, StartTime, EndTime, Max, EventDetails, Fee)'
                . 'VALUES (?,?,?,?,?,?,?,?,?,?)';
        
        //Use prepare() function to execute the sql command up there
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssssssssss', $save_as, $eventName, $eventVenue, $startDate, $endDate,$startTime, $endTime, $maxParticipants, $details, $fees);
        $stm->execute();
        
        //Check is the data is inserted to database, else, print error messeage
        if ($stm->affected_rows > 0)
        {
            $success = "Added record";
        }
 
        //Trimming the data function (used by variables upside)
        function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        ?>

    
    <body>
        <form action="addEvent.php" method="post" id="addEvent" onchange="showHidden()" enctype="multipart/form-data">
            
            <p id="title">Add Event</p>
                <label>Event Poster : </label>
                <input type="file" id="eventPoster" name="eventPoster">
                <p class="error"><?php echo $err;?></p><br>
                <label for="eventName">Event Name : </label>
                <input type="text" name="eventName" id="eventName" required style="width: 70%;">
                <br><br>
                <label for="eventVenue[]">Event Venue : </label>
                
                <input type="text" id="eventVenue" name="eventVenue" placeholder="Enter the location" margin-top: 2%; margin-left:19.5%; width: 50%;" required>
                
                <br><br>
                <label for="startDate">Start Date : </label>
                <input type="date" name="startDate" id="startDate" min="<?php echo date('Y-m-d'); ?>" required onchange="setEndDateMin()">
                <br><br>
                <label for="endDate">End date : </label>
                <input type="date" name="endDate" id="endDate" min="<?php echo date('Y-m-d', strtotime('+ 1 day')); ?>" required>
                <br><br>
                <label for="startTime">Start Time : </label>
                <input type="time" name="startTime" id="startTime" required>
                <br><br>
                <label for="endTime">End Time : </label>
                <input type="time" name="endTime" id="endTime" required>
                <br><br>
                <label for="maxParticipants">Max Participants : </label>
                <input type="number" name="maxParticipants" id="maxParticipants" required min="1" max="200" style="width: 15%;">
                <br><br>
                <label for="details">Event Details :</label>
                <input type="text" name="details" id="details" required style="width: 70%; word-wrap: break-word; overflow: hidden;">
                <br><br>
                <label for="price">Enter event entry fees :</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>
                <br>
                <br>
                <input type="submit" value="Add Event" style="margin-left: 5%;">
                <input type="reset" value="Finish" onclick="back()">
                
                <p class="success"><?php echo $success;?></p>
        </form>
        
        
        
    </body>
        
   
    
</html>

