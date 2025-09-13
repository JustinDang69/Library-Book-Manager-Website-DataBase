# Library-Book-Manager-Website-DataBase

# Overview 

In this project, we created a Library Book Manager which is a PHP+ HTML+ CSS+ MySQL web application that allows users to manage books across categories. On the website, you can do a myriad of things such as adding, deleting, modifying, sorting (in ascending or descending order), and viewing the book list.


# How To Access

In the Xammp control panel(Web Server), Apache and MySql must be running to open the website and database. 


To access the database (Must do before running the website), search http://www.localhost/phpmyadmin/, create new database and import the sql file (database_code.sql) within the zipped folder to create the database.

On a web browser, search http://localhost/the file name (in htdocs folder) in order to access website. 
 

If you find errors accessing the website (if related to database). I suggest you check the privileges of account. Good luck!


# On the website, these are your options: 

View Book List 


Add Book: 

-Click “Add Book”. 

-Fill in category, code, name, and price. 

-Submit → New book appears in the list. 


Delete Book: 

-Click “Delete” beside a book. 

-The record is removed. If undo is implemented, use “Undo” to restore. 


Modify Book: 

-Click “Modify” beside a book. 

-A new form opens with pre-filled details. 

-Edit name/price → Save → Changes reflected. 


Sort Books: 

-Click “Sort Ascending” → books appear A→Z. 

-Click “Sort Descending” → books appear Z→A. 

Use “View Book List” link to return 

