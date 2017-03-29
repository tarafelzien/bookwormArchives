<?php
    include 'header.php';
    session_destroy();
?>
<html>
<head>
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
        <div class = "outsideDiv">
            <div id = "insideDivLogin"><p id = "welcome">
                You successfully logged out. Click <a id="pageLink" href = 'login.php'>here</a> to login again.
            </p>
           
            </div>
        </div>
        <div id = "footer">
            <li class = "centerText">&#x24B8;2017 Tara Felzien</li>
            <li><a href = "mainPage.php">Home Page</a></li>
            <li> <a href="archive.php">My Archive</a>
            <li> <a href="publicArchives.php">Public Archives</a>
            <li> <a href="aboutUs.php">About Us</a></li>
        </div>
        
    </body>
</html>