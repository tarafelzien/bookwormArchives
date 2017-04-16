<?php
    session_start();

    require_once 'classes/dao.php';
    require_once 'classes/render.php';
    $dao = new dao();

    if(isset($_POST['createAccountForm'])){
        $firstName = trim(htmlentities($_POST['firstName']));
        $lastName = trim(htmlentities($_POST['lastName']));
        $email = trim(htmlentities($_POST['email']));
        $username = trim(htmlentities($_POST['username']));
        $password = trim(htmlentities($_POST['password']));
        $_SESSION['inputs']['firstName'] = $firstName;
        $_SESSION['inputs']['lastName'] = $lastName;
        $_SESSION['inputs']['email'] = $email;
        $_SESSION['inputs']['username'] = $username;
        $_SESSION['inputs']['password'] = $password;
        if(!isset($firstName) || $firstName == ''){
            $_SESSION['whoops']['firstName'] = "TRUE";
        }elseif(strlen($firstName) < 2 || !preg_match("/^[a-zA-Z ]+$/", $firstName)){
            $_SESSION['whoops']['invalidFirstName'] = "TRUE";
        } elseif(!isset($lastName) || $lastName == ''){
            $_SESSION['whoops']['lastName'] = "TRUE";
        }elseif(strlen($lastName) < 2 || !preg_match("/^[a-zA-Z ]+$/", $lastName)){
            $_SESSION['whoops']['invalidLastName'] = "TRUE";
        }elseif(!isset($email) || $email == ''){
            $_SESSION['whoops']['email'] = "TRUE";
        }elseif(!isset($username) || $username == ''){
            $_SESSION['whoops']['noUsername'] = "TRUE";
        }elseif(!isset($password) || $password == ''){
            $_SESSION['whoops']['noPassword'] = "TRUE";
        }elseif(strlen($password) < 5){
            $_SESSION['whoops']['shortPass'] = "TRUE";
        }else{
            if(($dao->validAccount($email, $username)) == TRUE){
                unset($_SESSION['inputs']);
                unset($_SESSION['whoops']['firstName']);
                $dao->createAccount($firstName, $lastName, $email, $username, $password);
                $_SESSION['username'] = $username;
                $_SESSION['account']['registered'] = "true";
                header("Location:login.php"); 
                }
                
            }
            header("Location:login.php");
        }


    if(isset($_POST['Login'])){
        $username = trim(htmlentities($_POST['username']));
        $password = trim(htmlentities($_POST['password']));
        $_SESSION['inputs']['userLogin'] = $username;
        if(!isset($username) || $username == ''){
            $_SESSION['whoops']['noLoginUser'] = "TRUE";
        }else if(!isset($password) || $password == ''){
            $_SESSION['whoops']['noLoginPass'] = "TRUE";
        }else{
            if(($dao->checkAccount($username, $password)) == TRUE){
                setcookie('username', $username, time()+60*60*7);
                unset($_SESSION['inputs']['userLogin']);
                unset($_SESSION['account']['registered']);
                $_SESSION['username'] = $username;
                $_SESSION['Loggedin'] = "TRUE";
                
            }
        }
         header("Location:login.php");
    }


    if(isset($_POST['bookForm'])){

    $bookTitle = trim(htmlentities($_POST['bookTitle']));
    $author = trim(htmlentities($_POST['author']));
    $bookReleaseDate = trim(htmlentities($_POST['releaseDate']));
    $dateRead = trim(htmlentities($_POST['dateRead']));
    $genre = trim(htmlentities($_POST['genre']));
    $thoughts = trim(htmlentities($_POST['thoughts']));
    $readyn = trim(htmlentities($_POST['readyn']));
    $_SESSION['bookInputs']['bookTitle'] = $bookTitle;
    $_SESSION['bookInputs']['author'] = $author;
    $_SESSION['bookInputs']['bookReleaseDate'] = $bookReleaseDate;
    $_SESSION['bookInputs']['dateRead'] = $dateRead;
    $_SESSION['bookInputs']['genre'] = $genre;
    $_SESSION['bookInputs']['thoughts'] = $thoughts;
    $_SESSION['bookInputs']['readyn'] = $readyn;
    if(!isset($bookTitle) || $bookTitle == ''){
        $_SESSION['whoops']['bookTitleError'] = "TRUE";
    }elseif(!isset($author) || $author == ''){
        $_SESSION['whoops']['authorError'] = "TRUE";
    }else{
        unset($_SESSION['whoops']['bookTitleError']);
        unset($_SESSION['whoops']['authorError']);
        $dao->addBook($bookTitle, $author, $bookReleaseDate, $dateRead, $genre, $thoughts, $readyn);
    }
    header("Location:archive.php");
    }

    if(isset($_POST['deleteForm'])){
        $bookTitle = htmlentities($_POST['bookTitle']);
        $dao->deleteBook($bookTitle);
        header("Location:archive.php");
    }

   

    exit;