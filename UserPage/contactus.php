<?php
    $head = "Contact Us";
    $active1 = '';
    $active2 = '';
    $active3 = 'class="actived"';
    $link1 = 'training.php';
    $link2 = 'mybooking.php';
    $link3 = 'user.php';
    $headTitle1 = 'Training';
    $headTitle2 = 'View Bookings';
    $headTitle3 = 'Back to homepage';
    include 'header.php';
?>

<style>
.contactUs {
    color: #3e8e41;
    width: 100%;
    text-align: center;
    font-weight: 600;
    padding-top: 10%;
    font-size: larger;
}

.contactUs h2 {
    padding-bottom: 1%;
}

.boss {
    color: black;
}

.boxContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.box {
    margin: 1% 3%;
    border: 5px solid #019875;
    border-radius: 20px;
    background-color: white;
    box-shadow: 1px 3px 8px rgb(140, 140, 140);
    padding: 1.2%;
}

.box img{
    width: 150px;
    height: 240px;
}

.box p {
    padding-top: 2%;
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

/* Contact Us end here */

.contactForm {
	max-width: 500px;
	margin-top: 1%; 
    margin-bottom: 1%;
	border: 2px solid #ccc;
	border-radius: 5px;
    background-color: #179678;
    font-size: larger;
    width: 80%;
    padding: 20px;
    padding-top: 2%;
    margin-left: auto;
    margin-right: auto;
}

.contactForm label {
	display: block;
	font-weight: bold;
	margin-bottom: 5px;
}

.contactForm input[type="text"],input[type="email"], textarea {
	display: block;
	width: 100%;
	padding: 10px;
	border: 2px solid #ccc;
	border-radius: 5px;
	margin-bottom: 10px;
	font-size: 16px;
	box-sizing: border-box;
}

.contactForm textarea {
	height: 150px;
    max-width: 100%;
}

.contactForm input[type="submit"] {
	background-color: #4CAF50;
	color: #fff;
	border: none;
	padding: 10px 20px;
	border-radius: 5px;
	cursor: pointer;
	font-size: 16px;
}

.contactForm input[type="submit"]:hover {
	background-color: #3e8e41;
}

 @media only screen and (max-width: 1010px){
    .words{
        margin-top: 25%;
    }
 }

 @media only screen and (max-width: 945px){
     .contactUs{
         padding-top: 15%;
     }
 }
 
 @media only screen and (max-width: 700px){
     .words{
        margin-top: 35%;
    }
 }
 
 @media only screen and (max-width: 500px){
    .words{
        margin-top: 50%;
    }
 }

 @media only screen and (max-width: 388px){
    .words{
        margin-top: 60%;
    }

</style>

<script>
function closeBooking(){
    var bookclose = document.querySelector('.msg');

    bookclose.style.display = 'none';
}
</script>

<?php

function validateStudentName($name) {
    if ($name == null)
    {
        return 'Please enter <strong>Student Name</strong>.';
    }
    else if (strlen($name) > 30) 
    {
        return '<strong>Student Name</strong> must not more than 30 letters.';
    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name))
    {
        return 'There are invalid letters in <strong>Student Name</strong>.';
    }
}

function validateEmail($email) {
    if ($email == null)
    {
        return 'Please enter <strong>Email</strong>.';
    }
    else if (strlen($email) > 40) 
    {
        return '<strong>Email</strong> must not more than 40 letters.';

    }
    else if (!preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}+$/', $email))
    {
        return 'There are invalid letters in <strong>Email</strong>.';
    }
}

function validateFaculty($faculty) {
    if ($faculty == null)
    {
        return 'Please enter <strong>Faculty</strong>.';
    }
}

function validateMessage($message) {
    if ($message == null)
    {
        return 'Please enter <strong>Message</strong>.';
    }
}


if(!empty($_POST)){
    $name    = test_input($_POST['name']);
    $email   = test_input($_POST['email']);
    $faculty = test_input($_POST['faculty']);
    $message = test_input($_POST['message']);
    
    $error['name']    = validateStudentName($name);
    $error['email']   = validateEmail($email);
    $error['faculty'] = validateFaculty($faculty);
    $error['message'] = validateMessage($message);
    $error = array_filter($error);

    if (empty($error)) {
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "INSERT INTO `form` (`Name`, `Email`, `Faculty`, `Message`) VALUES (?, ?, ?, ?);" ;

        $stm1 = $con->prepare($sql);
        $stm1->bind_param('ssss', $name, $email, $faculty, $message);
        $stm1->execute();
            
        if ($stm1->affected_rows > 0) {
            printf('<div class="msg">
                        <div class="words" style="background-color: rgb(145, 226, 145);">
                            <p>Your message has send successfully!</p>
                            <br>
                            <button onclick="closeBooking()">OK</button>
                        </div>
                    </div>');
            $con->close();
        }
        else
        {
            printf('<div class="msg">
                        <div class="words" style="background-color: rgb(255, 230, 230);">
                            <p>Your message is failed to send.</p>
                            <br>
                            <button onclick="closeBooking()">OK</button>
                        </div>
                    </div>');
        }

    }
    else
    {
        printf('<div class="msg">
                    <div class="words" style="background-color: rgb(255, 230, 230);">
                        <ul>');
        foreach ($error as $err => $value)
        {
            echo "<li>$value</li>";
        }
        printf('        </ul>
                        <br>
                        <button onclick="closeBooking()">OK</button>
                    </div>
                </div>');
    }
}
else
{
    $id = '';
    $name = '';
    $gender = '';
    $program = '';
}
?>

    <div class="contactUs">
        <h2>CONTACT US</h2>

        <div class="boxContainer">
            <div class="box">
                <video width="280" height="240" loop autoplay>
                    <source src="./picture/kaiwen.mp4" type="video/mp4">
                </video>
                <h2 class="boss">"CHAIRMAN"</h2>
                <h2 class="boss">LEW KAI WEN</h2>
                <p class="boss">&#9993;lewkw-wm22@student.tarc.edu.my&#9993;</p>
                <p class="boss">&#9742;016-56897418&#9742;</p>   
            </div>

            <div class="box">
                <img src="./picture/weihang.jpeg">
                <h2 class="boss">"VICE CHAIRMAN"</h2>
                <h2 class="boss">SIA WEI HANG</h2>
                <p class="boss">&#9993;siawh-wm22@student.tarc.edu.my&#9993;</p>
                <p class="boss">&#9742;010-98851256&#9742;</p>   
            </div>

            <div class="box">
                <img src="./picture/zhihao.jpeg">
                <h2 class="boss">"SECRETARY"</h2>
                <h2 class="boss">WONG ZI HAO</h2>
                <p class="boss">&#9993;wongzh-wm22@student.tarc.edu.my&#9993;</p>
                <p class="boss">&#9742;011-65987615&#9742;</p>   
            </div>
        </div>
    </div>


    <form action="" method="post" class="contactForm">
        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name" required maxlength="30">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required maxlength="30">

        <label for="faculty">Faculty: </label>
        <select name="faculty" id="faculty" required>
            <option disabled selected value="">-- Choose --</option>
            <option value="FAFB">FAFB</option>
            <option value="FSSH">FSSH</option>
            <option value="FCCI">FCCI</option>
            <option value="FOET">FOET</option>
            <option value="FOBE">FOBE</option>
            <option value="FOCS">FOCS</option>
            <option value="FOAS">FOAS</option>
            <option value="CPUS">CPUS</option>
        </select>
        <br><br>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required maxlength="1000"></textarea>

        <input type="submit" value="Submit"/>
    </form>

<?php include_once 'footer.php';?>