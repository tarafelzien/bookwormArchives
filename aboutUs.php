<?php session_start(); 
//include 'header.php';?>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/ajaxBooks.js" type="text/javascript"></script>
        <link rel="stylesheet" href="style.css"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">
	</head>

	<body>
        <div class="headerDiv">
	   <div class="header1">
            <div id="title">
                <div id = "logo">
                  <a href ="mainPage.php"> <img id = "logoImg" src="logo_withtext_300x100_white.png"> </a>
                </div>  
                <div id="navi">
                    <ul>
                         <li><?php
                    if(isset($_SESSION['username']) && !isset($_SESSION['account']['registered'])){ ?>
                        <div id = "loginForm">
                    <?php    echo "Welcome, " . $_SESSION['firstName'] . "!"; ?>
                            </div> <?php
                    }else{
                    ?>
                    <a href = "login.php"> Login</a>
                    <?php } ?></li>
                        <li> <a href="archive.php">My Archive</a>
                        <li> <a id = "currentPage" href="aboutUs.php">About Us</a>
                         <?php if(isset($_SESSION['username']) && !isset($_SESSION['account']['registered'])){ ?>
                         <li> <a href="logout.php">Logout</a>  
                         <?php } ?>
                
                    </ul>
                   
                </div>
                
            </div>
        </div>
        </div>
    <div class = "outsideDiv">
        <div id="descriptionAboutUs">
            <p>
               This site was inspired by the impossibility to remember exactly what books a person has read or not read, what they think of the book they read, and what books they want to read in the future. 
            </p>
            <p>
                Each user is given a personal archive to manage their own list of books where they can add or delete books. Thank you for visiting, I hope you enjoy your stay!
            </p>
            <p> Click <a id="pageLink" href = "login.php">here</a> to login!</p>
        </div>  
    </div>
    <div id = "footer">
            <li class = "centerText">&#x24B8;2017 Tara Felzien</li>
            <li><a href = "mainPage.php">Home Page</a></li>
            <li> <a href="archive.php">My Archive</a>
            <li> <a href="aboutUs.php">About Us</a></li>
        </div>
    </body>


</html>