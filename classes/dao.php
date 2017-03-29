<?php

class dao {
    
private $host = "us-cdbr-iron-east-04.cleardb.net";
private $db = "heroku_b6c9f881c359025";
private $user = "be5c0e36fb03ab";
private $pass = "6c2e934d";

    
    public function getConnection () {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            return $conn;
    }

    public function createAccount($firstName , $lastName,  $email, $userName, $password){

     $conn = $this->getConnection();
     $saveQuery = "insert into tbl_user ( userName, password, email, firstName, lastName) values (:userName, :password, :email, :firstName, :lastName);";
        $idRow = $conn->query("SELECT userName_id FROM tbl_user WHERE userName = '".$username."'");
        $result = $idRow->fetch();
        $_SESSION['userName_id'] = $result[0];
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":userName", $userName);
        $q->bindParam(":password", $password);
        $q->bindParam(":email", $email);
        $q->bindParam(":firstName", $firstName);
        $q->bindParam(":lastName", $lastName);
        $q->execute();
    }
    
    public function validAccount($email, $username){
        $conn = $this->getConnection();
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
            return FALSE;
        }else{
             $row = $conn->query("SELECT count(userName) FROM tbl_user WHERE userName = '".$username."'");
             $result = $row->fetch();
             $count = $result[0];
             if($count < 1){
                return TRUE;
             }else{
                return FALSE;
             }      
        }
    }
    
    public function checkAccount($username, $password){
        $conn = $this->getConnection();
        $sql = $conn->query("SELECT count(username) FROM tbl_user WHERE username='".$username."'");
        $result = $sql->fetch();
        $count = $result[0];
        if($count < 1){
            $_SESSION['whoops']['incorrectAccount'] = "TRUE";
            return FALSE;
        }else{
          if(($this->is_password_correct($username, $password)) == TRUE){
            $idRow = $conn->query("SELECT userName_id, firstName FROM tbl_user WHERE userName = '".$username."'");
            $result = $idRow->fetch();
            $_SESSION['userName_id'] = $result[0];
            $_SESSION['firstName'] = $result[1];
             return TRUE;
          }else{
              return FALSE;
          }
              
        }
     
    }
    
     public function is_password_correct($name, $password){
        $conn = $this->getConnection();
        $row = $conn->query("SELECT count(password) FROM tbl_user WHERE userName = '".$name."'");
        $result = $row->fetch();
        $count = $result[0];
         if($count > 0){
                $selectPass = $conn->query("SELECT password FROM tbl_user WHERE userName='".$name."'");
                $passwordResult = $selectPass->fetch();
                $pwd = $passwordResult[0];
                if($password == $pwd){
                    return TRUE;
                }
        }
        $_SESSION['whoops']['incorrectPass'] = "TRUE";
        return FALSE;
    }
    
    
     public function addBook($bookTitle, $author, $bookReleaseDate, $dateRead, $genre, $readyn){
        $conn = $this->getConnection();
        $idRow = $conn->query("SELECT userName_id FROM tbl_user WHERE userName = '".$_SESSION['username']."'");
        $result = $idRow->fetch();
        $id = $result[0];
        $saveQuery = "insert into tbl_book (userName_id, bookTitle, author, bookReleaseDate, dateRead, genre, readyn) values (:id, :bookTitle, :author, :bookReleaseDate, :dateRead, :genre, :readyn);";

         $q = $conn->prepare($saveQuery);
         $q->bindParam(":id", $id);
         $q->bindParam(":bookTitle", $bookTitle);
         $q->bindParam(":author", $author);
         $q->bindParam(":bookReleaseDate", $bookReleaseDate);
         $q->bindParam(":dateRead", $dateRead);
         $q->bindParam(":genre", $genre);
         $q->bindParam(":readyn", $readyn);
         $q->execute();
    }
    
    public function getBooks($st = 'author'){
        $conn = $this->getConnection();
        if($st === 'author'){
            return $conn->query("select book_id, bookTitle, author, bookReleaseDate, dateRead, readyn from tbl_book where userName_id = '".$_SESSION['userName_id']."' order by REVERSE(SUBSTR(REVERSE(author),1,LOCATE(' ',REVERSE(author),1)-1)), bookTitle");
            
        }
    }

 
    public function deleteBook($bookTitle){
        $conn = $this->getConnection(); 
        $conn->query("delete from tbl_book where bookTitle = '".$bookTitle."' and userName_id = '".$_SESSION['userName_id']."'");
    }
    
        
}