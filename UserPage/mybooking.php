<?php
    $head = "MyBooking";
    $active1 = '';
    $active2 = 'class="actived"';
    $active3 = '';
    $link1 = 'training.php';
    $link2 = 'user.php';
    $link3 = 'contactus.php';
    $headTitle1 = 'Training';
    $headTitle2 = 'Back to homepage';
    $headTitle3 = 'Contact Us';
    include 'header.php';
?>

<style>
/* Booked */
.training{
    display: flex;
    flex-direction: column;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}

.event{
    display: flex;
    flex-direction: column;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 5%;
}

.train{
    margin-top: 12%;
    margin-bottom: 5%;
}

.train table, .event table{
    width: 100%;
}

.train h1, .event h1{
    width: fit-content;
    padding: 1%;
    border-radius: 50px;
    color: white;
    margin: 1%;
    background-color: #019875;
}

.Booked{
    text-align: center;
    box-shadow: 2px 5px 7px grey;
    border: 10px solid whitesmoke;
    border-radius: 15px;
}

.Booked table thead{
    background-color: #017801;
    color: white;
}

.overflow{
    overflow: auto;
    height: 150px;
    display: block;
    background-color: white;
}

.flowOver{
    overflow: auto;
    height: 300px;
    display: block;
    background-color: white;
}

.overflow table tbody tr td, .flowOver table tbody tr td{
    border-bottom: 1px solid #017801;
    border-left: 1px solid #017801;
    border-right: 1px solid #017801;
    line-height: 2em;
}

.Booked table{
    background-color: #c0ffc0;
    border-collapse: collapse;
}

.no{
    width: 5%;
}

.id{
    width: 20%;
}

.name{
    width: 25%;
}

.date{
    width: 15%;
}

.time{
    width: 15%;
}

.Eno{
    width: 5%;
}

.Eid{
    width: 10%;
}

.Ename{
    width: 15%;
}

.Edate{
    width: 20%;
}

.Etime{
    width: 15%;
}

/* Responsive Screening */
@media only screen and (max-width: 1000px){
    .train{
        margin-top: 17%;
    }
}

@media only screen and (max-width: 620px){
    .training, .event{
        width: 90%;
    }
}
</style>

<!-- Training -->
<div class="training">
    <div class="train">
        <h1>Training Booked</h1>
        <div class="Booked">
            <table>
                <thead>
                    <th class="no">No.</th>
                    <th class="id">Student ID</th>
                    <th class="name">Name</th>
                    <th class="day">Day</th>
                    <th class="time">Time(pm)</th>
                    <th>Coach</th>
                </thead>
            </table>
            <div class="overflow">
                <table>
                    <tbody>
                        <?php
                            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                            $sql = 'SELECT * FROM coachbooking JOIN coaches ON coachbooking.CoachID = coaches.CoachID';
                            $result = $con->query($sql);
                            $TrainCounter = 1;
                            $foundRecords = false;
                            
                            while ($row = $result->fetch_assoc()){
                                if ($row['StudentID'] == $stdID){
                                    if ($row['CoachID'] == "C001"){
                                        if (date('N') == 1){
                                            $day = 'this Tuesday';
                                        }
                                        else {
                                            $day = 'next Tuesday';
                                        }
                                    }
                                    else if ($row['CoachID'] == "C002"){
                                        if (date('N') < 4 && date('N') > 0){
                                            $day = 'this Thursday';
                                        }
                                        else {
                                            $day = ' next Thursday';
                                        }
                                    }
                                    $starttrain = strtotime($day);
                                    $endtrain = strtotime($row['EndTrain']);
                                    if ($starttrain < $endtrain){
                                        while ($starttrain <= $endtrain) {
                                        printf('<tr>
                                                  <td class="no">%d. </td>
                                                  <td class="id">%s</td>
                                                  <td class="name">%s</td>
                                                  <td class="date">%s</td>
                                                  <td class="time">%s</td>
                                                  <td>%s</td>
                                              </tr>', 
                                              $TrainCounter++, $row['StudentID'], $row['StudentName'], 
                                              date("d M Y", $starttrain), $row['Time'], $row['CoachName']);
                                            $starttrain = strtotime("+1 week", $starttrain);
                                        }
                                        $foundRecords = true;
                                    }
                                    else {
                                        $sql2 = "DELETE FROM coachbooking WHERE StudentID = '$stdID'";
                                        $result2 = $con->query($sql2);
                                        $foundRecords = false;
                                    }
                                }
                            }
                            if (!$foundRecords){
                                printf('<tr><td colspan="6">No record</td></tr>');
                            }
                            $result->free();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Training -->

<!-- Event -->
<div class="event">
    <h1>Event Booked</h1>
    <div class="Booked">
        <table>
            <thead>
                <th class="Eno">No.</th>
                <th class="Eid">Student ID</th>
                <th class="Ename">Name</th>
                <th class="Edate">Date</th>
                <th class="Etime">Time</th>
                <th>Event Name</th>
            </thead>
        </table>
        <div class="flowOver">
            <table>
                <tbody>
                    <?php
                        $sql2 = 'SELECT * FROM eventdetails JOIN eventbooking ON eventdetails.EventID = eventbooking.EventID';
                        $result2 = $con->query($sql2);
                        $EventCounter = 1;
                        $recordsFound = false;
                        $today = date('Y-m-d');
                        
                        while ($row2 = $result2->fetch_assoc()){
                            if ($row2['StudentID'] == $stdID){
                                $startDate = date('d M Y', strtotime($row2['StartDate']));
                                $endDate = date('d M Y', strtotime($row2['EndDate']));
                                $endComp = date('Y-m-d', strtotime($row2['EndDate']));

                                $startTime = date("g:i A", strtotime($row2['StartTime']));
                                $endTime = date("g:i A", strtotime($row2['EndTime']));

                                if($endComp > $today){                                        
                                printf('<tr>
                                            <td class="Eno">%d. </td>
                                            <td class="Eid">%s</td>
                                            <td class="Ename">%s</td>
                                            <td class="Edate">%s - %s</td>
                                            <td class="Etime">%s ~ %s</td>
                                            <td>%s</td>
                                        </tr>', 
                                        $EventCounter++, $row2['StudentID'], $row2['StudentName'], $startDate, $endDate, 
                                        $startTime, $endTime, $row2['EventName']);

                                $recordsFound = true;
                                }
                            }
                        }
                        if (!$recordsFound){
                            printf('<tr><td rowspan="6">No record</td></tr>');
                        }
                        $result2->free();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Event -->

<?php 
    $con->close();
    require_once 'footer.php'
;?>