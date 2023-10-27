<!DOCTYPE html>

<html>
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $PAGE_TITLE?></title>
    <style>
        
        * {
            margin: 0%;
            padding: 0%;
            box-sizing: border-box;
        }

        body::-webkit-scrollbar{
            width: 0.4rem;
        }

        body::-webkit-scrollbar-track{
            background-color: rgb(147, 147, 147);
        }

        body::-webkit-scrollbar-thumb{
            background-color: rgb(100, 100, 100);
            border-radius: 5px;
        }

        body::-webkit-scrollbar-thumb:hover{
            background-color: rgb(50, 50, 50);
        }
        
        header {
            background-color: rgb(255, 255, 255);
            width: 100%;
            display: flex;
            box-shadow: 1px 3px 8px rgb(140, 140, 140);
            border-radius: 0px 0px 10px 10px;
            position: fixed;
            z-index: 1000;
        }

        body {
            background-image: url(./picture/background.jpg);
            overflow-x: hidden;
            justify-content: center;
        }

        table {
            width: 100%;
        }
        
        .logo {
            width: 90px;
        }
        
        .toplink a {
            text-decoration: none;
            background-color: white;
            color: #019875;
            border-radius: 50px;
            padding: 10%;
            cursor: pointer;
        }

        .toplink a:hover, .toplink a.actived {
            background-color: rgb(33, 137, 33);
            color: whitesmoke;
            transition: all linear 0.2s;
        }
        
        .blocker{
            display: flex;
            flex-direction: column;
            width: <?php echo $width?>%;
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
        }
        
        @media only screen and (max-width: 945px){
            .club{
                font-size:70%;
            }
            .logo{
                width: 70px;
            }
        }
        
    </style>
    </head>

    <body>

        <header>
            <table>
                <tr>
                    <td style="width: 7%; text-align: end;">
                        <a href="Homepage.php"><img src="./Picture/logo.jpg" alt="Logo" class="logo" title="Back"/></a>
                    </td>
                    <td style="width: 48%; color: rgb(70, 70, 70)" class="club">
                        <h1><i>Badminton<br>Club</i></h1>
                    </td>
                    <td class="toplink" style="width: 15%; text-align: end;">
                        <a href="<?php echo $list?>" <?php echo $active3?> title="<?php echo $title3?>">EventList</a>
                    </td>
                    <td class="toplink" style="width: 15%; text-align: center;">
                        <a href="<?php echo $log?>" <?php echo $active1?> title="<?php echo $title1?>">Login</a>
                    </td>
                    <td class="toplink" style="width: 15%; text-align: start;">
                        <a href="<?php echo $regis?>" <?php echo $active2?> title="<?php echo $title2?>">Register</a>
                    </td>
                </tr>
            </table>
        </header>
        
    </body>
</html>
