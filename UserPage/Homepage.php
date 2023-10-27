<?php 
    $PAGE_TITLE = 'Badminton Club';
    $active1 = '';
    $active2 = '';
    $active3 = '';
    $log = 'login.php';
    $regis = 'register.php';
    $list = 'eventList.php';
    $title1 = 'Login';
    $title2 = 'Register';
    $title3 = 'Event List';
    $width = 0;
    include 'HPheader.php';
?>

<style>
    .background {
        width: 100%;
        opacity: 0.9;
    }


    .backgroundImage {
        background-image: url(./Picture/back.jpg);
        background-position: 100%;
        background-repeat: no-repeat;
        padding-top: 14%;
        padding-bottom: 10%;
        width: 100%;
        opacity: 1;
    }

    .backgroundImage h1 {
        color: rgb(129, 73, 0);
        display: block;
        text-align:center;
        line-height: 130%;
        font-size: 60px;
        width: 100%;
        text-decoration: underline;
    }

    /* body img end here */

    .sectionTitle {
        text-align: center;
        padding-top: 2%;
        padding-bottom: 2%;
        width: 100%;
        font-size: larger;
    }

    .sectionTitle h2 {
        font-weight: 600;
        text-decoration: underline;
    }

    .aboutUs {
        padding: 0 3% 3% 3%;

    }

    .boxContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .box {
        margin: 0 1% 3% 1%;
        border-radius: 20px;
        background-color: white;
        box-shadow: 1px 3px 8px rgb(140, 140, 140);
        padding: 1.2%;
    }

    .box img {
        width: 400px;
        border-radius: 10px;
    }

    .box p {
        padding-top: 2%;
    }

    /* About Us end here */

    .reward {
        width: 100%;
        text-align: center;
        font-size: larger;
        font-weight: 600;
    }

    .reward h2{
        text-decoration: underline;
        width: 100%;
        padding: 1% 0 2% 0;
        margin: 0 auto 0 auto;
    }

    /* Responsive Screening */

    @media only screen and (max-width: 875px) {
        .backgroundImage {
            padding-top: 20%;
        }

        .backgroundImage h1 {
            font-size: 280%;
        }

        .sectionTitle {
            font-size: 1.5rem;
        }

        .reward {
            font-size: 1.5rem;
        }
    }

    @media only screen and (max-width: 500px) {
        .backgroundImage h1{
            padding-top: 9%;
        }
    }
</style>

<div class="background">
    <div class="backgroundImage">
        <h1>WELCOME TO<br />TARUMT<br />BADMINTON CLUB</h1>
    </div>
</div>  

    <div class="sectionTitle">
        <h2>ABOUT US</h2>
        <br/>
        <p class="aboutUs">
            On May 19th 2017. A new badminton club was introduced on campus. This club is designed
            for students who enjoy playing badminton and want to improve their skills. It provides
            a platform for like-minded individuals to come together and play the sport they love.
            The club is open to all students and is aimed at both beginners and advanced players.
            Regular training sessions and competitions will be organized for members to help them
            hone their skills and have fun at the same time.
        </p>

    <div class="boxContainer">
        <div class="box">
            <img src="./picture/gallery.jpg" alt="BadmintonclubImage" />
        </div>
        <div class="box">
            <img src="./picture/gallery1.jpg" alt="BadmintonclubImage" />
        </div>
        <div class="box">
            <img src="./picture/gallery2.jpg" alt="BadmintonclubImage" />
        </div>

        <div class="box">
            <img src="./picture/gallery3.jpg" alt="BadmintonclubImage" />
        </div>

        <div class="box">
            <img src="./picture/gallery4.jpg" alt="BadmintonclubImage" />
        </div>

        <div class="box">
            <img src="./picture/gallery5.jpg" alt="BadmintonclubImage" />
        </div>
    </div>
</div>

<div class="reward">
        <h2>CHAMPION</h2>

        <div class="boxContainer">
            <div class="box">
                <img src="./picture/menSinglesChamp.jpg" alt="BadmintonclubImage" />
                <p>Men's Single Champion</p>
            </div>

            <div class="box">
                <img src="./picture/mixedDoublesChamp.jpg" alt="BadmintonclubImage" />
                <p>Mixed Doubles Champion</p>
            </div>

            <div class="box">
                <img src="./picture/menDoubleChamp.jpg" alt="BadmintonclubImage" />
                <p>Men's Doubles Champion</p>
            </div>

        </div>
</div>

<?php include 'footer.php';?>