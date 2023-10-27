<?php
    $head = 'Badminton Club';
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
    
    if (isset($_SESSION['welcome'])){
        $welcome = $_SESSION['welcome'];
    }
    else {
        $welcome = '';
    }
?>
    
<script><?php echo $welcome;?></script>

<link href="user.css" rel="stylesheet"/>
<script src="user.js" defer></script>
 
<?php             
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

<!-- Image Slider -->
<div class="box">
    <div class="main">
        <a id="left" onclick="nextSlide(-1)">&#x2B9C;</a>
        <a id="right" onclick="nextSlide(1)">&#x2B9E;</a>
        <div class="slider">
            <?php
                $sql = "SELECT EventID, EventPoster FROM eventdetails WHERE (Availability = 1)";

                if ($result = $con->query($sql))
                {
                    while ($row = $result->fetch_object())
                    {
                        printf('
                            <div class=" sliders fade">
                                <a href="event.php?eventid=%d"><img src="./picture/Event/%s" alt="" title="Click for more information"></a>
                            </div>',
                            $row->EventID,
                            $row->EventPoster);
                    }
                }
                $result->free();
            ?>
        </div>
    </div>
</div>
<!-- Image Slider -->

<!-- Event List -->
<div class="title">
    <h1>~~~~ <i>Events List</i> ~~~~</h1>
</div>
<div class="events">

    <?php
        $sql2 = "SELECT * FROM eventdetails ORDER BY EventID DESC LIMIT 6";

                if ($result2 = $con->query($sql2))
                {            
                    while ($row = $result2->fetch_assoc())
                    {
                        $date = date('d M Y', strtotime($row['StartDate']));
                        $available = $row['Availability'];
                        if ($available == 1){
                            $valid = 'Available Now';
                            $validClass = 'valid';
                        }
                        else {
                            $valid = 'Unavailable';
                            $validClass = 'unvalid';
                        }
                        printf('
                            <a href="event.php?eventid=%d">
                                <div class="event" title="Click for more information">
                                    <img src="./picture/Event/%s" alt="">
                                    <h3>%s</h3>
                                    <h5>Venue: %s</h5>
                                    <h5>Date: %s</h5>
                                    <h5>Maximum available for %d person</h5>
                                    <br>
                                    <h4 class="%s">%s</h4>
                                </div>
                            </a>',
                                $row['EventID'],
                                $row['EventPoster'],
                                $row['EventName'],
                                $row['Venue'],
                                $date,
                                $row['Max'],
                                $validClass,
                                $valid);
                    }
                }
        $result2->free();
    ?>

    <div id="press">
        <?php
            $sql3 = 'SELECT * FROM eventdetails WHERE EventID ORDER BY EventID DESC LIMIT 18446744073709551615 OFFSET 6';

            if ($result3 = $con->query($sql3))
                {            
                    while ($row = $result3->fetch_assoc())
                    {
                        $date = date('d M Y', strtotime($row['StartDate']));
                        $available = $row['Availability'];
                        if ($available == 1){
                            $valid = 'Available Now';
                            $validClass = 'valid';
                        }
                        else {
                            $valid = 'Unavailable';
                            $validClass = 'unvalid';
                        }
                        printf('
                            <a href="event.php?eventid=%d">
                                <div class="event" title="Click for more information">
                                    <img src="./picture/Event/%s" alt="">
                                    <h3>%s</h3>
                                    <h5>Venue: %s</h5>
                                    <h5>Date: %s</h5>
                                    <h5>Maximum available for %d person</h5>
                                    <br>
                                    <h4 class="%s">%s</h4>
                                </div>
                            </a>',
                                $row['EventID'],
                                $row['EventPoster'],
                                $row['EventName'],
                                $row['Venue'],
                                $date,
                                $row['Max'],
                                $validClass,
                                $valid);
                    }
                }
            $result3->free();
        ?>
    </div>

</div>
<button id="more" onclick="showMore()">Click for more...</button>
<!-- Event List -->

<?php
    $con->close();
    unset($_SESSION['welcome']);
    require_once 'footer.php';
?>