# bookwormArchives
Website that allows users to organize their own private archives

Overall, the website functions well, but I'd like to spend some time creating it more user friendly such as creating a drop down list for deleting a book so that the user wouldn't have to worry about typos when inputting a book.

The functionality was a long process, but once I figured out the mySQL database, it was fairly simple working with sessions and the functions I created in dao.php.

Take note, that bookwormArchives has a bug. When you add the same book to the database and then try to delete them, it won't delete either of the books. I am currently working on a way to fix by ensuring that a book can only be inserted once in the database. I can also do some debugging and find why it won't delete both books through the deleteBook method in the dao.php file.
