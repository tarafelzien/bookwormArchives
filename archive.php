<?php
  include 'header.php';
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("Location:login.php");
      $_SESSION['whoops']['noAccount'] = 'true';
        exit();
    }
  $username = $_SESSION['username'];
  require_once 'classes/dao.php';
  require_once 'classes/render.php';
  $dao = new Dao();

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
        <div class="outsideDiv">
                <div id = "inputBookForm">
<!--
                <div id = "formTitle">
                    <h3>Add a Book</h3>
                </div>
-->
                <table id = 'formTable'>
                <h3>Add a Book</h3>
                <form  method="POST" action="handler.php">
                    
                    <tr>
                        <td>Book Title:</td>
                        <td><input type= "text" <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError'])){ ?> value = "<?php echo trim($_SESSION['bookInputs']['bookTitle']); } ?>" name = "bookTitle"></td>
                    </tr>
                    
                    <tr>
                        <td>Author Name:</td>
                        <td><input type= "text" <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError'])){ ?> value = "<?php echo trim($_SESSION['bookInputs']['author']); } ?>" name = "author"> </td>
                    </tr>
                    
                    <tr>
                        <td>Release Date:</td>
                        <td><input type= "date" <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError'])){ ?> value = "<?php echo trim($_SESSION['bookInputs']['bookReleaseDate']); } ?>" name = "releaseDate"></td>
                    </tr>
                    
                    <tr>
                        <td>Date Read:</td>
                        <td><input type= "date" <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError'])){ ?> value = "<?php echo trim($_SESSION['bookInputs']['dateRead']); } ?>" name = "dateRead"></td>
                    </tr>
                    
                    <tr>
                        <td>Genre:</td>
                        <td><input type= "text" <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError'])){ ?> value = "<?php echo trim($_SESSION['bookInputs']['genre']); } ?>" name = "genre"></td>
                    </tr>
                     <tr>
                        <td>Thoughts:</td>
                        <td><input type= "text" <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError'])){ ?> value = "<?php echo trim($_SESSION['bookInputs']['thoughts']); } ?>" name = "thoughts"></td>
                    </tr>
                    <tr>
                        <td><input type = "radio" name = "readyn" value = "1"
                                   <?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError']) && $_SESSION['bookInputs']['readyn'] == 1){ echo "checked"; } ?>
                       checked > Read</td>
                        <td><input type = "radio" name = "readyn" value = "2"<?php if(isset($_SESSION['whoops']['authorError'])||isset($_SESSION['whoops']['bookTitleError']) && $_SESSION['bookInputs']['readyn'] == 2){ echo "checked"; } ?>> Want to Read</td>
                    </tr>
                    <tr><td><input type = "submit" name ="bookForm" value = "Add"></td></tr>
                </form>
                </table>
                <span id = "bookError">
                    <?php if(isset($_SESSION['whoops']['bookTitleError'])){ echo "You must input a book title, silly!"; unset($_SESSION['whoops']['bookTitleError']);}
                    ?>
                    
                    <?php
                        if(isset($_SESSION['whoops']['authorError'])){
                            echo "Who is this mysterious author?";
                            unset($_SESSION['whoops']['authorError']);
                        }
                    ?>
                    
                    <?php
                        if(isset($_SESSION['whoops']['bookExists'])){
                            echo "This book already exists in your archive.";
                            unset($_SESSION['whoops']['bookExists']);
                        }
                    ?>
                
                </span>
            </div>
                <div id = "bookFormat">
                    <div id = "booksReadHeader"><h2><?php echo "".$_SESSION['username']."'s" ?> Archive</h2>
                    </div>
                    
                    <div id="booksIRead">
                    <?php 
                        render::renderTable($dao->getBooks()); 
                        ?>
                    </div>                   
                </div>
                <div id = "optionsBookForm">
                        <div>
                            <h3>Delete a Book</h3>
                        <table id = 'formTable'>
                            <form  method="POST" action="handler.php">
                                <tr>
                                    <td>Book Title:</td>
                                    <td><input type= "text" name = "bookTitle"></td>
                                    <td><input type = "submit" name ="deleteForm" value = "Delete"></td>
                                </tr>
                            </form>
                        </table>
                        </div>
                        <div>
                        </div>
                </div>
        </div>
        <div id = "footer">
            <li class = "centerText">&#x24B8;2017 Tara Felzien</li>
            <li> <a href = "mainPage.php">Home Page</a></li>
            <li> <a href="archive.php">My Archive</a>
            <li> <a href="aboutUs.php">About Us</a></li>
        </div>
    </body>
</html>