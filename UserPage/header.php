<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title><?php echo $head?></title>
        <link rel="stylesheet" href="header.css">
        <script src="jquery-1.9.1.js"></script>
        <script src="header.js" defer></script>
        <?php include('Helper.php');?>
    </head>

    <body>
        <?php             
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            session_start();
            $userID = $_SESSION['stdID'];
        ?>
        
        <?php
            $stmt = $con->prepare("SELECT * FROM studentlogin WHERE StudentID = ?");
            if (!$stmt) {
            die("Error preparing statement: " . $con->error);
            }
            $stmt->bind_param("s", $userID);

            $stmt->execute();
            if (!$stmt->execute()) {
                die("Error executing statement: " . $stmt->error);
            }

            $result4 = $stmt->get_result();
            if ($result4->num_rows > 0) {
                $row = $result4->fetch_assoc();
                $profile = $row['StudentProfile'];
                $name = $row['StudentName'];
                $title = explode(" ", $name);
                $firstName = $title[0];
                $stdGender = $row['Gender'];
                $stdID = $row['StudentID'];
                $email = $row['StudentEmail'];
                $pass = $row['Password'];
            } else {
                header("Location: login.php");
            }
        ?>
                
        <!-- Header -->
        <header>
            <table>
                <tr>
                    <td style="width: 7%; text-align: end;">
                        <a href="user.php" title="Homepage"><img src="./picture/logo.jpg" alt="Logo" class="logo"/></a>
                    </td>
                    <td style="width: 10%; color: rgb(70, 70, 70)" class="club">
                        <h1><i>Badminton<br>Club</i></h1>
                    </td>
                    <td style="text-align: center;">
                        <form method="post" action="search.php">
                            <label for="search"></label>
                            <input type="text" id="search" name="search" placeholder="&nbsp;&nbsp;Search events" title="Type to search">
                            <button type="submit" name="submit" id="srchbtn" title="Search">Search</button>
                          </form>              
                    </td>
                    <nav>
                        <ul>
                            <li style="list-style-type: none;">
                                <td class="toplink">
                                    <a href="<?php echo $link1;?>" <?php echo $active1;?> title="<?php echo $headTitle1;?>">Training</a>
                                </td>
                            </li>
                            <li style="list-style-type: none;">
                                <td class="toplink" style="width: 11%;">
                                    <a href="<?php echo $link2;?>" <?php echo $active2;?> title="<?php echo $headTitle2;?>">MyBooking</a>
                                </td>
                            </li>
                            <li style="list-style-type: none;">
                                <td class="toplink" style="width: 11%;">
                                    <a href="<?php echo $link3;?>" <?php echo $active3;?> title="<?php echo $headTitle3;?>">ContactUs</a>
                                </td>
                            </li>
                            <li style="list-style-type: none;">
                                <td class="toplinks" style="width: 7%;">                                    
                                    <img src="./picture/Profile/<?php echo $profile;?>" title="<?php echo strtoupper($firstName);?>" alt="">
                                    <div class="profile">
                                        <div style="background-color: rgba(194, 194, 194, 0.799); border-radius: 5px 5px 0 0;">
                                            <img src="./picture/Profile/<?php echo $profile;?>" title="View Picture" alt="">
                                        </div>
                                        <div style="padding: 5% 0 5% 0; line-height: 30px;">
                                            <p><?php echo $name;?></p>
                                            <p><?php echo $stdID;?></p>
                                            <p><?php echo $email;?></p>
                                        </div>
                                        <a class="acc" href="account.php">Manage Account</a>
                                        <a onclick="logOut()">Logout</a>
                                    </div>
                                </td>
                            </li>
                        </ul>
                    </nav>
                    <td class="menu">
                        <button id="open" title="Menu">&#9776;</button>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Header -->

        <!-- View Profile Picture -->
        <div class="view">
            <img src="./picture/Profile/<?php echo $profile;?>" alt="">
        </div>
        <!-- View Profile Picture -->     
        
        <!-- Hidden Menu -->
        <div id="menuList">
            <ul>
                <li class="close" style="background-color: rgb(38, 38, 38);">
                    <h1 id="heading">Menu</h1>
                    <button id="close" title="Close">&#10006;</button>
                </li>
                <li class="hp">
                    <a><img src="./picture/Profile/<?php echo $profile;?>" title="View profile" alt=""></a>
                    <p class="hname"><?php echo $name;?></p>
                </li>
                <li class="nav"><a href="training.php">&#9751;&nbsp;&nbsp;&nbsp;Training</a></li>
                <li class="nav"><a href="mybooking.php">&#9873;&nbsp;&nbsp;&nbsp;MyBooking</a></li>
                <li class="nav"><a href="contactus.php">&#9742;&nbsp;&nbsp;&nbsp;ContactUs</a></li>
                <li class="nav"><a href="account.php">&#9881;&nbsp;&nbsp;&nbsp;Setting</a></li>
                <li class="nav"><a onclick="logOut()">&#9754;&nbsp;&nbsp;&nbsp;Logout</a></li>
            </ul>
        </div>
        <!-- Hidden Menu -->

        <?php 
            $con->close();
        ?>
        