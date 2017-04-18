<?php 
    session_start(); 
    //include 'header.php';
?>
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
                    <a id = "currentPage" href = "login.php"> Login</a>
                    <?php } ?></li>
                        <li> <a href="archive.php">My Archive</a>
                        <li> <a href="aboutUs.php">About Us</a>
                         <?php if(isset($_SESSION['username']) && !isset($_SESSION['account']['registered'])){ ?>
                         <li> <a href="logout.php">Logout</a>  
                         <?php } ?>
                
                    </ul>
                   
                </div>
                
            </div>
        </div>
        </div>
        <div class = "outsideDiv">
            <div id = "insideDivLogin">
            <div id = "CreateAccount">
                <h3>Login</h3>
                <table class = 'loginTable'>
                <form method="POST" action="handler.php">
                <div id = "loginForm"> 
                    <tr>
                        <td>Username:</td>
                        <td><input type = "text" <?php
                        if(isset($_SESSION['inputs']['userLogin'])){ ?>
                            value = "<?php echo trim($_SESSION['inputs']['userLogin']); } ?>" name = "username"></td>
                    </tr>
                    
                    <tr>
                        <td>Password:</td>
                        <td><input type = "password" name = "password"></td>
                    
                    </tr>
                    
                    <tr>
                        <td><input type = "submit" name = "Login" value="Login"></td>
                    </tr>
                    </div>
                </form>
                </table>
                <div id = "noAccount">
                    <?php
                        if(isset($_SESSION['whoops']['noAccount'])){
                            echo "Looks like you don't have access to archives. Create an account or login to begin organizing books.";
                            unset($_SESSION['whoops']['noAccount']);
                        }
                        if(isset($_SESSION['whoops']['noLoginUser'])){
                            echo "Who are you? What's your username?";
                            unset($_SESSION['whoops']['noLoginUser']);
                        }
                        if(isset($_SESSION['whoops']['noLoginPass'])){
                            echo "Whoops, where's your password?";
                            unset($_SESSION['whoops']['noLoginPass']);
                        }
                        if(isset($_SESSION['whoops']['incorrectAccount'])){
                            echo "This account doesn't seem to exist yet.";
                            unset($_SESSION['whoops']['incorrectAccount']);
                        }
                        if(isset($_SESSION['whoops']['incorrectPass'])){
                            echo "This password isn't quite right.";
                            unset($_SESSION['whoops']['incorrectPass']);
                        }
                    //Message if logged in correctly
                        if(isset($_SESSION['Loggedin'])){
                            echo $_SESSION['firstName'] . ", you logged in successfully.";
                        }
                    ?>
                
                </div>
                </div>
    
            <div id = "CreateAccount">
                <h3>Create an Account</h3>
                <table class = 'loginTable'>
                <form method="POST" action="handler.php">
                <div id = "accountForm">           
                   
                    <tr>
                        <td>First Name:</td>
                        <td><input type = "text" id ="firstName" 
                        <?php
                        if(isset($_SESSION['inputs']['firstName'])){ ?>
                            value = "<?php echo trim($_SESSION['inputs']['firstName']); } ?>" name = "firstName"> </td>
                    </tr>
                    
                     <tr>
                        <td>Last Name:</td>
                        <td><input type = "text" <?php
                        if(isset($_SESSION['inputs']['lastName'])){ ?>
                            value = "<?php echo trim($_SESSION['inputs']['lastName']); } ?>" name = "lastName"> </td>
                    </tr>
                    
                    <tr>
                        <td>E-mail Address:</td>
                        <td><input type = "text" <?php
                        if(isset($_SESSION['inputs']['email'])){ ?>
                            value = "<?php echo trim($_SESSION['inputs']['email']); } ?>" name = "email"></td>
                    </tr>
                    
                    <tr>
                        <td>Username:</td>
                        <td><input type = "text" <?php
                        if(isset($_SESSION['inputs']['username'])){ ?>
                            value = "<?php echo trim($_SESSION['inputs']['username']); } ?>" name = "username"></td>     
                    </tr>
                    
                    <tr>
                        <td>Password:</td>
                        <td><input type = "password" name = "password"> </td>
                    </tr>
                    
                    <tr>
                        <td><input type = "submit" name = "createAccountForm" value = "Create Account"></td>
                    </tr>
                </div>
                </form>
                </table>
                <div id = "noAccount">
                    <?php
                        if(isset($_SESSION['username']) && isset($_SESSION['account']['registered'])){
                            echo "You successfully registered! You can now log in to start creating your own archive!";
                            unset($_SESSION['acount']['registered']);
                        }
                        if(isset($_SESSION['whoops']['firstName'])){
                            echo "What's your first name?";
                            unset($_SESSION['whoops']['firstName']);
                        }
                        if(isset($_SESSION['whoops']['lastName'])){
                            echo "Don't forget your last name!";
                            unset($_SESSION['whoops']['lastName']);
                        }
                        if(isset($_SESSION['whoops']['email'])){
                            echo "Gotta have an email for this to work";
                            unset($_SESSION['whoops']['email']);
                        }
                        if(isset($_SESSION['whoops']['invalidEmail'])){
                            echo "Surely that's not a real email.";
                            unset($_SESSION['whoops']['invalidEmail']);
                        }
                        if(isset($_SESSION['whoops']['noUsername'])){
                            echo "How am I supposed to know who you are without a username?";
                            unset($_SESSION['whoops']['noUsername']);
                        }
                        if(isset($_SESSION['whoops']['usernameExists'])){
                            echo "Sorry! That username's been taken.";
                            unset($_SESSION['whoops']['usernameExists']);
                        }
                        if(isset($_SESSION['whoops']['noPassword'])){
                            echo "Passwords helps protect you from dragons trying to steal your book archive.";
                            unset($_SESSION['whoops']['noPassword']);
                        }
                         if(isset($_SESSION['whoops']['invalidFirstName'])){
                            echo "First name is invalid.";
                            unset($_SESSION['whoops']['invalidFirstName']);
                        }  
                        if(isset($_SESSION['whoops']['invalidLastName'])){
                            echo "Last name is invalid.";
                            unset($_SESSION['whoops']['invalidLastName']);
                        }
                        if(isset($_SESSION['whoops']['shortPass'])){
                            echo "Password must have at least 5 characters.";
                            unset($_SESSION['whoops']['shortPass']);
                        }
                    ?>
                
                </div>
            </div>
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