<?php
    $head = "Event";
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

<?php
    $em = '';
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if (isset($_GET['eventid'])){
        $back1 = 'block';
        $back2 = 'none';
        $event = $_GET['eventid'];
        $sql = "SELECT * FROM eventdetails WHERE EventID = '$event'";

        $result = $con->query($sql);
        
        if ($result->num_rows > 0){
            $back1 = 'block';
            $back2 = 'none';
            $row = $result->fetch_assoc();
            $startDate = date('d M Y', strtotime($row['StartDate']));
            $endDate = date('d M Y', strtotime($row['EndDate']));
            $startTime = date("g:i A", strtotime($row['StartTime']));
            $endTime = date("g:i A", strtotime($row['EndTime']));
        }
        else {
            $back1 = 'none';
            $back2 = 'block';
        }
    }
    else {
        $back1 = 'none';
        $back2 = 'block';
    }
    
?>

<?php
    
    $sql3 = "SELECT * FROM eventbooking WHERE StudentID = '$stdID' AND EventID = '$event'";
    $result3 = $con->query($sql3);
    $sql4 = "SELECT Availability FROM eventdetails WHERE EventID = '$event'";
    $result4 = $con->query($sql4);
    if($result4->num_rows > 0){
        $row2 = $result4->fetch_assoc();
        $available = $row2['Availability'];
        
        if ($result3->num_rows > 0){
            $disable = 'disabled';
            $color = '#93e4d1';
            $hover = '#93e4d1';
        }
        else if ($available == 0){
            $disable = 'disabled';
            $color = '#93e4d1';
            $hover = '#93e4d1';
        }
        else {
            $disable = '';
            $color = '#019875';
            $hover = '#006950';
        }
    }
    
    

?>

<script src="event.js" defer></script>
<style>
    .boxcontainer {
        font-weight: 600;
        font-size: large;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 10%;
        padding-bottom: 2%;
    }

    .payment{
        display: none;
        text-align: center;
        flex-wrap: wrap;
        position: fixed;
        z-index: 9999;
        background-color: rgba(66, 66, 66, 0.604);
        width: 100%;
        height: 100%;
        padding-top: 1%;
    }
    
    .payment img{
        width: 30%;
    }
    
    .payment form input{
        background-color: white;
    }

    .msg{
        display: block;
        position: fixed;
        overflow-y: none;
        z-index: 9999;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        background-color: rgba(66, 66, 66, 0.4);
    }

    .words{
        padding: 5%;
        width: fit-content;
        text-align: center;
        margin: 16% auto 0;
    }
    
    .showDetails{
        display: <?php echo $back1;?>;
    }
    
    .noDetails{
        display: <?php echo $back2;?>;
        text-align: center;
        padding: 20%;
        background-color: white;
    }
    
    .box {
        display: flex;
        flex-wrap: wrap;
    }

    .detailLeft, .detailRight {
        padding: 2% 2%;
    }

    .detailLeft img {
        width: 300px;
        height: 300px;
    }

    .detailRight {
        width: 60%;
    }

    .box, .detail {
        background-color: bisque;
        border: 2px solid #019875;
        box-shadow: 1px 3px 8px rgb(140, 140, 140);
    }

    .detail {
        padding: 3% 10%;
    }

    .eventname {
        text-decoration: underline;
    }

    #bookingbtn{
        width: 15%;
        margin-top: 1%;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        background-color: <?php echo $color;?>;
        border: 0;
        padding: 1%;
        cursor: pointer;
        font-size: large;
    }
    
    .back {
        width: 15%;
        margin-top: 1%;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        background-color: #019875;
        border: 0;
        padding: 1%;
        cursor: pointer;
        font-size: large;
    }

    #bookingbtn:hover{
        background-color: <?php echo $hover;?>;
    }
    
    .back:hover{
        background-color: #006950;
    }
    
    /* Responsive Screening */

    @media only screen and (max-width: 1046px) {
        .detailLeft{
            width: 100%;
            text-align: center;
            border-bottom: 3.5px solid #019875;
        }
        .detailLeft img{
            width: 60%;
        }

        .detailRight{
            width: 100%;
            text-align: center;
        }
        .words{
            margin-top: 25%;
        }
    }
    
    @media only screen and (max-width: 945px) {
        .boxcontainer {
            padding-top: 18%;
        }
        .payment img{
            width: 40%;
        }
    }

    @media only screen and (max-width: 875px) {
        .boxcontainer {
            padding-top: 22%;
            padding-bottom: 3%;
        }

        .box, .detail{
            font-size: larger;
        }

        .detailLeft{
            width: 100%;
            text-align: center;
            border-bottom: 3.5px solid #019875;
        }
        .detailLeft img{
            width: 90%;
        }

        .detailRight{
            width: 100%;
        }

        #bookingbtn {
            width: 30%;
        }
        .payment{
            padding-top: 7%;
        }
        .words{
            margin-top: 35%;
        }
    }

    @media only screen and (max-width: 585px) {
        .boxcontainer {
            padding-top: 22%;
            padding-bottom: 3%;
        }
        .payment img{
            width: 50%;
        }
        .payment{
            padding-top: 13%;
        }
    }

    @media only screen and (max-width: 553px) {
        .boxcontainer {
            padding-top: 26%;
        }
        .payment img{
            width: 55%;
        }
        .payment{
            padding-top: 18%;
        }
        .words{
            margin-top: 50%;
        }
    }
    @media only screen and (max-width: 388px){
        .words{
            margin-top: 60%;
        }
     }
    
</style>

<?php
    if (isset($_POST['submit'])){

        $img_name = $_FILES['payment']['name'];
        $img_size = $_FILES['payment']['size'];
        $tmp_name = $_FILES['payment']['tmp_name'];
        $error = $_FILES['payment']['error'];

        if ($error === 0){
            if ($img_size > 1000000){
                printf('<div class="msg">
                            <div class="words" style="background-color: rgb(255, 230, 230);">
                                <p>Your image size is too big!</p>
                                <br>
                                <button onclick="closeBooking()">OK</button>
                            </div>
                        </div>');
            }
            else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
                
                if (in_array($img_ex_lc, $allowed_exs)){
                    $new_img_name = uniqid("$stdID-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'picture/EventPayment/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $sql2 = "INSERT INTO eventbooking(StudentID, StudentName, Payment, EventID) VALUES(?, ?, ?, ?)";
                    $stm = $con->prepare($sql2);
                    $stm->bind_param('ssss', $stdID, $name, $new_img_name, $event);
                    $stm->execute();
                    
                    if ($stm->affected_rows > 0){
                        printf('<div class="msg">
                                    <div class="words" style="background-color: rgb(145, 226, 145);">
                                        <p>Booking successfully!</p>
                                        <br>
                                        <button onclick="closeBooking()">OK</button>
                                    </div>
                                </div>');
                        $disable = 'disabled';
                        $color = '#019875';
                        $hover = '#006950';
                    }
                    else {
                        printf('<div class="msg">
                                    <div class="words" style="background-color: rgb(255, 230, 230);">
                                        <p>Booking Failed!</p>
                                        <br>
                                        <button onclick="closeBooking()">OK</button>
                                    </div>
                                </div>');
                    }
                                        
                }
                else {
                    printf('<div class="msg">
                                <div class="words" style="background-color: rgb(255, 230, 230);">
                                    <p>You cannot upload this file!</p>
                                    <br>
                                    <button onclick="closeBooking()">OK</button>
                                </div>
                            </div>');
                }
            }
        }
        else {
            printf('<div class="msg">
                        <div class="words" style="background-color: rgb(255, 230, 230);">
                            <p>Unknown error occured!</p>
                            <br>
                            <button onclick="closeBooking()">OK</button>
                        </div>
                    </div>');
        }
    }
?>

<div class="payment">
    <form action="" method="post" enctype="multipart/form-data">
        <img src="./picture/touchngo.jpg">
        <br>
        <input type="file" name="payment" accept=".jpeg, .jpg, .png" required>
        <input type="submit" name="submit" value="Upload">
    </form>
    <button id="clsBookingBtn">Cancel</button>
</div>

<div class="boxcontainer">
    <div class="showDetails">
        <div class="box">
            
            <div class="detailLeft">
                <img src="./picture/Event/<?php echo $row['EventPoster'];?>">
            </div>
            <div class="detailRight">
                <h3 class="eventname"><?php echo $row['EventName'];?></h3>
                <br>
                <h3 class="venue">Venue:&nbsp;&nbsp;<?php echo $row['Venue'];?></h3>
                <br>
                <h3 class="startDate">Date Start:&nbsp;&nbsp;<?php echo $startDate;?></h3>
                <br>
                <h3 class="endDate">Date End:&nbsp;&nbsp;<?php echo $endDate;?></h3>
                <br>
                <h3 class="value">Seat available:&nbsp;&nbsp;<?php echo $row['Max'];?></h3>
                <br>
                <h3>Time: &nbsp;&nbsp;<?php echo $startTime.' - '.$endTime;?></h3>
                <br>
                <h3>Fee: &nbsp;&nbsp;RM<?php echo $row['Fee'];?></h3>
            </div>

        </div>
        <div class="detail">
            <p><?php echo $row['EventDetails'];?></p>
        </div>
        <button id="bookingbtn" <?php echo $disable;?>>Participate</button>
        <button onclick="window.location.href='user.php';" class="back">Back to main page</button>
    </div>
    <div class="noDetails">
        <h2>There is no such event.</h2>
        <h3>Back to <a href="user.php">homepage</a></h3>
    </div>
</div>    

<?php 
    $con->close();
    require_once 'footer.php';
?>