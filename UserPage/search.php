<?php
    $head = "Badminton Club";
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $link1 = 'training.php';
    $link2 = 'mybooking.php';
    $link3 = 'contactus.php';
    $headTitle1 = 'Training';
    $headTitle2 = 'View Bookings';
    $headTitle3 = 'Contact Us';
    include 'header.php';
?>

<style>
    
.blocker{
    display: flex;
    flex-direction: column;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    justify-content: center;
}

.search{
    margin-top: 13%;
    background-color: white;
    height: fit-content;
    margin-bottom: 5%;
}

.search table{
    width: 100%;
    line-height: 3em;
}

.search table thead th{
    text-align: start;
    border-bottom: 1px solid black;
}

@media only screen and (max-width: 1000px){
    .search{
        margin-top: 15%;
    }
}
@media only screen and (max-width: 945px){
    .search{
        margin-top: 20%;
    }
}
@media only screen and (max-width: 600px){
    .search{
        margin-top: 25%;
    }
}
@media only screen and (max-width: 470px){
    .search{
        margin-top: 30%;
    }

</style>

<?php
    $results = 'Searching Results:';
?>

<div class="blocker">
    <div class="search">
        <?php
            if(isset($_POST['submit'])){
                $counter = 1;
                $search = $_POST['search'];
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                $sql = "SELECT EventID, EventName, Venue, StartDate FROM eventdetails WHERE EventName LIKE '%$search%'";
                $result = $con->query($sql);
                if($result->num_rows > 0){
                    printf("<h1>Searching Results:</h1>
                            <table>
                                <thead>
                                    <th>No.</th>
                                    <th>Event name</th>
                                    <th>Event Venue</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>");
                    $counter = 1;
                    $result->data_seek(0);
                    while($row = $result->fetch_assoc()){
                        $date = date('d M Y', strtotime($row['StartDate']));
                        printf("<tr>
                                    <td>%d.</td>
                                    <td><a href='event.php?eventid=%d' title='View details'>%s</a></td>
                                    <td>%s</td>
                                    <td>%s</td>
                                </tr>", 
                                    $counter, $row['EventID'], $row['EventName'], $row['Venue'], $date);
                        $counter++;
                    }
                    printf("    </tbody>
                            </table>");
                    $con->close();
                }
                else {
                    echo '<h1>No relevant data</h1><br><a href="user.php" style="font-size: 180%;">Back to main page</a>';
                }
            }
            else {
                echo '<h1>You have to search something to come here.</h1><br>'
                . '<a href="user.php" style="font-size: 180%;">Back to main page</a>';
            }
        ?>
    </div>
</div>

</body>
</html>