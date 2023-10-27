<?php 
    $PAGE_TITLE = 'Event List';
    $active1 = '';
    $active2 = '';
    $active3 = 'class="actived"';
    $log = 'login.php';
    $regis = 'register.php';
    $list = 'Homepage.php';
    $title1 = 'Login';
    $title2 = 'Register';
    $title3 = 'Back to main page';
    $width = 90;
    include 'HPheader.php';
    include 'Helper.php';
?>

<style>
    .errMsg{
        margin-top: 5%;
        padding: 10%;
    }
    
    .eventList{
        width: 100%;
        margin-top: 13%;
        margin-bottom: 6%;
        border-collapse: collapse;
    }
    
    .firstrow button{
        background-color:  #017a5e;
    }
    
    .firstrow a {
        text-decoration: none;
        color: black;
    }
    
    .eventList img {
        width: 150px; 
        height: 150px;
    }
    
    .eventList td, th {
        border:2px solid #017a5e;
    }
    
    .eventList th {
        text-align: center;
        background-color: #019875;
        font-weight: 600;
    }
    
    .eventList td{
        padding-top: 1%;
        padding-bottom: 1%;
        background-color: white;
    }
    
    .eventList .detail {
        text-align: center;
    }
    
    .detail a {
        text-decoration: none;
        color: black;
    }
    
    @media only screen and (max-width: 920px){
        .blocker{
            font-size: 80%;
        }
        .eventList{
            margin-top: 18%;
        }
    }
    
    @media only screen and (max-width: 880px){
    .eventList td:nth-of-type(2), .eventList th:nth-of-type(2) {
        display: none;
    }
        .blocker{
            font-size: 70%;
        }
        .eventList{
            margin-top: 23%;
        }
        .errMsg{
            margin-top: 15%;
        }
    }
    
    @media only screen and (max-width: 730px){
    .eventList td:nth-of-type(7), .eventList th:nth-of-type(7),
    .eventList td:nth-of-type(8), .eventList th:nth-of-type(8) {
        display: none;
    }
        .blocker{
            font-size: 50%;
        }
        .errMsg{
            font-size: 150%;
            margin-top: 23%;
        }
        .eventList{
            margin-top: 28%;
        }
    }

    
</style>

<script>
function showMessage(){
    alert("For more details please log in!");
}
</script>

<div class="blocker">
<?php
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$sql = "SELECT EventPoster, EventName, Venue, StartDate, EndDate, StartTime, EndTime, Fee, Availability FROM eventdetails";

$sort_col = isset($_GET['sort']) ? $_GET['sort'] : '';
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
if (in_array($sort_col, ['venue','eventname', 'startdate', 'enddate', 'starttime', 'endtime', 'fee', 'availability'])) {
    $sql .= " ORDER BY " . $sort_col . " " . $sort_order;
}

$result = $con->query($sql);
        
if ($result->num_rows > 0) {
    $footer = 1;
    $eventCount = 1;
   
    $availableEvents = [];
    $unavailableEvents = [];
    
     while ($row = $result->fetch_assoc()) {
            $startTime = date("g:i A", strtotime($row['StartTime']));
            $endTime = date("g:i A", strtotime($row['EndTime']));

            if ($row["Availability"] == 1) {
                $availableEvents[] = $row;
            } else {
                $unavailableEvents[] = $row;
            }
        }
  
  echo "<table class='eventList'>"
    . "<tr class = 'firstrow'>"
        . "<th width='5%'>Number</th>"          
        . "<th>EventPoster</th>"
        . "<th width='15%'><a href='?sort=eventname&order=".($sort_col == 'eventname' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>EventName<button>&#8691;</button></a></th>"
        . "<th width='10%'><a href='?sort=venue&order=".($sort_col == 'venue' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>Venue<button>&#8691;</button></a></th></th>"
        . "<th><a href='?sort=startdate&order=".($sort_col == 'startdate' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>StartDate<button>&#8691;</button></a></th>"
        . "<th><a href='?sort=enddate&order=".($sort_col == 'enddate' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>EndDate<button>&#8691;</button></a></th>"          
        . "<th><a href='?sort=starttime&order=".($sort_col == 'starttime' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>StartTime<button>&#8691;</button></a></th>"
        . "<th><a href='?sort=endtime&order=".($sort_col == 'endtime' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>EndTime<button>&#8691;</button></a></th>"
        . "<th><a href='?sort=fee&order=".($sort_col == 'fee' && $sort_order == 'ASC' ? 'DESC' : 'ASC')."'>Fee<button>&#8691;</button></a></th>"
        . "<th width='8%'>Availability</th>"
    . "</tr>";
  
    foreach ($availableEvents as $row) {   
    echo "<tr class='detail'>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $eventCount . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'><img src='./picture/Event/" . $row["EventPoster"] . "'></a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $row["EventName"] . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $row["Venue"] . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $row["StartDate"] . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $row["EndDate"] . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $startTime . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . $endTime . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php'>" . "RM" . $row["Fee"] . "</a></td>"
    . "<td onclick='showMessage()'><a href='login.php' class='ava' style='background-color: " . ($row["Availability"] == 1 ? "#93e4d1" : "#707070") . ";' >" . ($row["Availability"] == 1 ? "Available" : "Not available") . "</a></td>"
    . "</tr>";
    
    $eventCount++;
}

foreach ($unavailableEvents as $row) {
        echo "<tr class='detail'>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $eventCount . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'><img src='./picture/Event/" . $row["EventPoster"] . "'></a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $row["EventName"] . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $row["Venue"] . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $row["StartDate"] . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $row["EndDate"] . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $startTime . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . $endTime . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php'>" . "RM" . $row["Fee"] . "</a></td>"
            . "<td onclick='showMessage()'><a href='login.php' class='ava' style='background-color: " . ($row["Availability"] == 1 ? "#93e4d1" : "#707070") . ";' >" . ($row["Availability"] == 1 ? "Available" : "Not available") . "</a></td>"
            . "</tr>";

        $eventCount++;
    }
echo"</table>";
} else {
    $footer = 0;
    printf("<div class='errMsg'>
                <h1>No results found.</h1>
                <br><br>
                <a href='Homepage.php'>Back to Homepage</a>
            </div>");
}

    $con->close();
?>
</div>

<?php 
    if ($footer == 1){
        require_once 'footer.php';
    }
    else {
        printf("</body></html>");
    }
?>

