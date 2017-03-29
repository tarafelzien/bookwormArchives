<?php
class render{

    public static function renderTable($rows){

        $table = "
            <table id='booksIReadTable'>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author Name</th>
                    <th>Released Date</th>
                    <th>Date Read</th>
                    <th>Read</th>
                </tr>
            </thead>";
        foreach($rows as $row){
            
            $i = $row['book_id'];
            if(htmlentities($row['readyn']) > "0"){
//                $t = '<input type = "checkbox" name = "checkbox" value = $i id = "checkbox" checked>';
                $t = '&#x2713';
            }else{
//                $t = '<input type = "checkbox" name = "checkbox" value = $i id = "checkbox">';
                $t = '&#x2717';
            }
            $table .= "<tr>
                <td>" . htmlentities($row['bookTitle']) . "</td>
                <td>" . htmlentities($row['author']) . "</td>
                <td>" . htmlentities($row['bookReleaseDate']) . "</td>
                <td>" . htmlentities($row['dateRead']) . "</td>" .
                "<td>" . $t . "</td></tr>";
            
        }
        $table .="</table>";
        echo $table;
    }
        
}