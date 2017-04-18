$(function () {

    $("#bookForm").submit(function( event ) {
    var values = $("#bookForm").serialize();
    var title = $("#bookTitle").val();
    var author = $("#author").val();
    var releaseDate = $("#releaseDate").val();
    var dateRead = $("#dateRead").val();
    var genre = $("#genre").val();
    var yn = $("#readyn").val();
    if(yn < 2){
        yn = '&#x2713';
    }else{
        yn = '&#x2717';
    }
    $.ajax({
      type: "POST",
      url: "handler.php",
      data: values,
      success: function() {
        $('#booksIReadTable').prepend('<tr><td>' + 
          title + '</td><td>' + author + '</td><td>' + releaseDate + '</td><td>' + dateRead + '</td><td>' + genre + '</td><td>' + yn + '</td></tr>' );
        $('#title').val('');
        $('#author').val('');
        $('#releaseDate').val('');
        $('#dateRead').val('');
        $('#genre').val('');
        $('#readyn').val('');
      }
             
    });

  });
    
});