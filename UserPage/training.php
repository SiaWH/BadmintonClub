<?php
    $head = "Training";
    $active1 = 'class="actived"';
    $active2 = '';
    $active3 = '';
    $link1 = 'user.php';
    $link2 = 'mybooking.php';
    $link3 = 'contactus.php';
    $headTitle1 = 'Back to homepage';
    $headTitle2 = 'View Bookings';
    $headTitle3 = 'Contact Us';
    include 'header.php';
?>

<?php 
    $color = ''; 
    $disable = '';

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql3 = "SELECT StudentID FROM coachbooking WHERE StudentID = '$stdID'";
    
    $result3 = $con->query($sql3);
    
    if($result3->num_rows > 0){
        $disable = 'disabled';
        $color = '#93e4d1';
        $hoverColor = '#93e4d1';
    }
    else {
        $disable = '';
        $color = '#019875';
        $hoverColor = 'whitesmoke';
    }
    
?>

<style>
/* Coaches Details */

.coaches, .timetable{
    display: flex;
    flex-direction: column;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}

.coaches h1{
    width: fit-content;
    margin-top: 10%;
    padding: 1%;
    border-radius: 50px;
    color: white;
    background-color: #019875;
}

.coach{
    width: 100%;
    background-color: white;
    display: flex;
    flex-wrap: wrap;
    margin: 1.5% 0 1.5% 0;
    border: 5px solid #019875;
    box-shadow: 1px 3px 8px rgb(140, 140, 140);
}

.coach h3{
    text-align: center;
    background-color: #019875;
    color: white;
}

.coach img{
    width: 100%;
    height: 100%;
}

.cimg{
    border-right: 5px solid #019875;
    height: fit-content;
    width: 30%;
}

.cdetail{
    width: 70%;
    font-size: larger;
    display: flex;
    flex-direction: column;
    padding-left: 1%;
}

.cIdentity{
    width: 100%;
    height: 100%;
}

.rewardList{
    list-style-type: "-";
    width: 100%;
    height: 100%;
}

/* Timetable */

.timetable{
    margin-bottom: 3%;
}

.timetable h1{
    width: 100%;
    margin: 5% 0 2% 0;
    padding: 0.5%;
    border-radius: 50px;
    color: white;
    background-color: #019875;
    text-align: center;
}

.timetable table{
    border-collapse: collapse;
}

.timetable table th, .timetable table td{
    border: 2px solid #019875;
    padding: 1%;
}

col.timeColumn{
    width: 10%;
    background-color: rgb(215, 205, 151);
 }
 
 col.wDayColumns{
    width: 11%;
    background-color: rgb(236, 255, 211);
 }
 
 col.wEndColumns{
    width: 11%;
    background-color: rgb(255, 231, 255);
 }

.timetable thead{
    color: white;
    background-color: rgb(105, 177, 60);
 }

.timetable thead th:first-of-type{
    background-color: rgb(153, 86, 7);
 }
 
.timetable thead th:nth-of-type(7), thead th:nth-of-type(8){
    background-color: rgb(153, 0, 153);
 }

.timetable tbody tr td{
    text-align: center;
 }

.timetable tfoot{
    background-color: rgb(85, 85, 85);
    color: white;
 }

 /* Booking Form */
.hiddenBooking{
    display: none;
    position: fixed;
    overflow-y: none;
    z-index: 9999;
    width: 100%;
    height: 100%;
    align-items: center;
    justify-content: center;
    background-color: rgba(66, 66, 66, 0.604);
}

.msg{
    display: block;
    position: fixed;
    overflow-y: hidden;
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

 form.booking{
    border: 1px solid black;
    background-color: aliceblue;
    width: fit-content;
    padding: 1%;
    margin: 6% auto 0 auto;
 }

 #phone:focus:invalid{
     background-color: rgb(255, 230, 230);
 }
 
 #book{
    display: flex;
    flex-direction: column;
    width: 30%;
    margin: 0 auto 3% auto;
 }

 #book button{
    padding: 2%;
    background-color: <?php echo $color;?>;
    color: white;
    border: 0;
    border-radius: 60px;
    width: 100%;
    cursor: pointer;
    font-size: larger;
 }
 
 #book button:hover{
    background-color: <?php echo $hoverColor;?>;
    color: #019875;
 }

 /* Responsive Screening */
 @media only screen and (max-width: 1100px){
    .coaches h1{
        margin-top: 13%;
    }
    .words{
        margin-top: 25%;
    }
 }

 @media only screen and (max-width: 1010px){
    .cdetail{
        width: 100%;
    }
    .cimg{
        width: 100%;
        border: 0;
        text-align: center;
    }
    .cimg img{
        width: 65%;
    }
 }
 
 @media only screen and (max-width: 945px){
    .coaches h1{
        margin-top: 19%;
    }
 }
 
 @media only screen and (max-width: 700px){
     .words{
        margin-top: 35%;
    }
 }
 
 @media only screen and (max-width: 500px){
    .cimg img{
        width: 100%;
    }
    .words{
        margin-top: 50%;
    }
 }

 @media only screen and (max-width: 388px){
    .coaches h1{
        margin-top: 22%;
    }
    .words{
        margin-top: 60%;
    }
 }
</style>

<script>
// Booking 
function Booking(){
    var book = document.querySelector('.hiddenBooking');

    if (book.style.display === 'block'){
        book.style.display = 'none';
    }
    else {
        book.style.display = 'block';
    }
}

function closeBooking(){
    var bookclose = document.querySelector('.msg');

    bookclose.style.display = 'none';
}
</script>

<?php
    $sql2 = 'INSERT INTO `coachbooking` (`StudentName`, `StudentID`, `PhoneNumber`, `StudentEmail`, `CoachID`, `Time`, `EndTrain`, `Payment`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $errorPhone = '';
    
    if (isset($_POST['submit'])){
        
        $img_name = $_FILES['payment']['name'];
        $img_size = $_FILES['payment']['size'];
        $tmp_name = $_FILES['payment']['tmp_name'];
        $error = $_FILES['payment']['error'];
        
        if (empty($_POST['stdPhone'])){
            printf('<div class="msg">
                            <div class="words" style="background-color: rgb(255, 230, 230);">
                                <p>Please enter the contact number!</p>
                                <br>
                                <button onclick="closeBooking()">OK</button>
                            </div>
                        </div>');
        }
        else {
            $stdPhone = test_input($_POST['stdPhone']);
            
            $sql4 = "SELECT PhoneNumber FROM coachbooking WHERE PhoneNumber = '$stdPhone'";
            $result4 = $con->query($sql4);
            
            if (!preg_match('/^01\d*-\d{3,4}\s\d{4}$/', $stdPhone)){
                printf('<div class="msg">
                            <div class="words" style="background-color: rgb(255, 230, 230);">
                                <p>Please enter the correct contact number!</p>
                                <br>
                                <button onclick="closeBooking()">OK</button>
                            </div>
                        </div>');
            }
            else if ($result4->num_rows > 0){
                printf('<div class="msg">
                            <div class="words" style="background-color: rgb(255, 230, 230);">
                                <p>This phone number is already existed</p>
                                <br>
                                <button onclick="closeBooking()">OK</button>
                            </div>
                        </div>');
            }
            else if ($error !== 0){
                printf('<div class="msg">
                            <div class="words" style="background-color: rgb(255, 230, 230);">
                                <p>You cannot upload this file!</p>
                                <br>
                                <button onclick="closeBooking()">OK</button>
                            </div>
                        </div>');
            }
            else {
                if ($img_size > 1000000){
                printf('<div class="msg">
                            <div class="words" style="background-color: rgb(255, 230, 230);">
                                <p>Your image size is too big!</p>
                                <br>
                                <button onclick="closeBooking()">OK</button>
                            </div>
                        </div>');
                }
                else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg", "jpeg", "png", "webp");

                    if (in_array($img_ex_lc, $allowed_exs)){
                        $new_img_name = uniqid("$stdID-", true).'.'.$img_ex_lc;
                        $img_upload_path = 'picture/TrainingPayment/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
                        
                        if ($_POST['coach'] == "C001"){
                            if (date('N') == 1){
                                $today = date('Y-m-d', strtotime('this tuesday'));
                            }
                            else {
                                $today = date('Y-m-d', strtotime('next tuesday'));
                            }
                            $sixweeks = date('Y-m-d', strtotime($today . ' + 5 weeks'));
                        }
                        else {
                            if (date('N') < 4 && date('N') > 0){
                                $today = date('Y-m-d', strtotime('this thursday'));
                            }
                            else {
                                $today = date('Y-m-d', strtotime('next thursday'));
                            }
                            $sixweeks = date('Y-m-d', strtotime($today . ' + 5 weeks'));
                        }
                                                
                        $stm = $con->prepare($sql2);
                        $stm->bind_param('ssssssss', $name, $stdID, $stdPhone, $email, $_POST['coach'], $_POST['time'], $sixweeks, $new_img_name);
                        $stm->execute();

                        if ($stm->affected_rows > 0){
                            printf('<div class="msg">
                                        <div class="words" style="background-color: rgb(145, 226, 145);">
                                            <p>Booking successfully!</p>
                                            <br>
                                            <button onclick="closeBooking()">OK</button>
                                        </div>
                                    </div>');
                        }
                        else {
                            printf('<div class="msg">
                                        <div class="words" style="background-color: rgb(255, 230, 230);">
                                            <p>You already booked once!</p>
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
        }
    }
?>

<!-- Booking -->
<div class="hiddenBooking">
    <form action="" method="post" class="booking" enctype="multipart/form-data">
        <legend>Book for training</legend>
        <br>
        <label for="phone">Contact Number: </label>
        <br>
        <input type="tel" name="stdPhone" id="phone" required placeholder="E.g. 012-345 6789" maxlength="14">
        <br>
        <br>
        <label for="faculty">Coach: </label>
        <br>
        <select name="coach" id="faculty" required>
            <option disabled selected value="">-- Choose --</option>
            <option value="C001">Ow Kah Rok</option>
            <option value="C002">Kenneph Ooi Wei Jie</option>
        </select>
        <br>
        <br>
        <label for="timeSelected">Time: </label>
        <br>
        <select name="time" id="timeSelected" required>
            <option disabled selected value="">-- Choose --</option>
            <option value="6.00 ~ 7.30">6.00 ~ 7.30</option>
            <option value="7.30 ~ 9.00">7.30 ~ 9.00</option>
        </select>
        <br>
        <br>
        <label>Payment: RM15</label>
        <br>
        <img src="./picture/touchngo.jpg" style="width: 150px;">
        <br>
        <input type="file" name="payment" accept=".jpeg, .jpg, .png, .webp" required>
        <br><br>
        <input type="submit" name="submit" value="Submit" style="cursor: pointer;" title="Submit" id="book-btn">
        <input type="reset" value="Reset" style="cursor: pointer;" title="Reset">
        <button onclick="Booking()" style="cursor: pointer;" title="Cancel">Cancel</button>
    </form>
</div>
<!-- Booking -->

<!-- Coaches -->
<div class="coaches">
    <h1>Our Coaches:</h1>
    <?php
        $sql = "SELECT * FROM coaches JOIN coachrewards ON coaches.CoachID = coachrewards.CoachID";
        $rewardList = array();
        
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            $cID = $row['CoachID'];
            $cName = $row['CoachName'];
            $cProfile = $row['CoachProfile'];
            $cAge = $row['Age'];
            $cGender = $row['Gender'];
            $cBDate = date('d M Y', strtotime($row['BirthDate']));
            $reward = $row['Rewards'];

            // Check if coach has been added to the array
            if (!isset($coaches[$cID])) {
                // If not, add coach to the array with an empty rewards array
                $coaches[$cID] = array(
                    'name' => $cName,
                    'profile' => $cProfile,
                    'age' => $cAge,
                    'gender' => $cGender,
                    'bdate' => $cBDate,
                    'rewards' => array()
                );
            }

            // Add reward to the coach's rewards array
            $coaches[$cID]['rewards'][] = $reward;
        }

        // Loop through the coaches array and display their details and rewards
        foreach ($coaches as $coach) {
            $cName = $coach['name'];
            $cProfile = $coach['profile'];
            $cAge = $coach['age'];
            $cGender = $coach['gender'];
            $cBDate = $coach['bdate'];
            $rewards = implode('</li><li>', $coach['rewards']);

            if ($cGender == 'M') {
                $cTitle = 'Mr. ';
                $fullGender = 'Male';
            } else if ($cgender == 'F') {
                $cTitle = 'Miss ';
                $fullGender = 'Female';
            }

            printf('
                <div class="coach">
                    <div class="cimg">
                        <img src="./picture/Coach/%s" alt="">
                        <h3>%s%s</h3>
                    </div>
                    <div class="cdetail">
                        <p class="cIdentity">
                            <strong>Name: </strong>%s<br>
                            <strong>Age: </strong>%d<br>
                            <strong>Gender: </strong>%s<br>
                            <strong>Birth Date: </strong>%s<br>
                        </p>
                        <ul class="rewardList">
                            <strong>Rewards:</strong>
                            <li>%s</li>
                        </ul>
                    </div>
                </div>
            ', $cProfile, $cTitle, $cName, $cName, $cAge, $fullGender, $cBDate, $rewards);
        }

        $result->free();
    ?>
</div>
<!-- Coaches -->

<!-- Timetable -->
<div class="timetable">
    <h1>Training Timetable</h1>
    <table>
        <colgroup>
            <col class="timeColumn"/>
            <col class="wDayColumns" span="5"/>
            <col class="wEndColumns" span="2"/>
            <thead>
                <th>Time (PM)</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </thead>
            <tbody>
                <tr>
                    <th>6:00</th>
                    <td rowspan="8">No Training</td>
                    <td rowspan="4">O</td>
                    <td rowspan="8">No Training</td>
                    <td rowspan="4">K</td>
                    <td rowspan="8">No Training</td>
                    <td rowspan="8">Rest day</td>
                    <td rowspan="8">Rest day</td>
                </tr>
                <tr>
                    <th>6:30</th>
                </tr>
                <tr>
                    <th>7:00</th>
                </tr>
                <tr>
                    <th>7:30</th>
                </tr>
                <tr>
                    <th>7:30</th>
                    <td rowspan="4">O</td>
                    <td rowspan="4">K</td>
                </tr>
                <tr>
                    <th>8:00</th>
                </tr>
                <tr>
                    <th>8:30</th>
                </tr>
                <tr>
                    <th>9:00</th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8"><strong>
                        K = Kenneph Ooi Wei Jie <br>
                        O = Ow Kah Rok</strong>
                    </td>
                </tr>
            </tfoot>
        </colgroup>
    </table>
</div>
<!-- Timetable -->

<div id="book">
    <div>
        <button onclick="Booking()" title="Booking" <?php echo $disable;?>>Booking Now!</button>
    </div>
</div>

<?php 
    $con->close();
    require_once 'footer.php';
?>