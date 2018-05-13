***************
*Autor Note*
***************
This program has been developed by: Alberto Melchor Herrera, melchorherrera@gmail.com. I am greateful to those people that have developed software in which I got inspiration. This version of the software is free to use and modify. 
Feel free to contact me for any question.

***************
*About*
***************
This is experimental sofware that performs an ORM Framework to create web sites. Documentation is at the main website: http://hierarnodesys.sourceforge.net/lngs/en/

**************
*Installation*
**************
1 - Get the software needed to edit and execute this software.
	To execute it you will need Php, Mysql, a Web server and a Web browser. These programs can be obtained in a pack from Mozilla Apache. You may find easer to pay for these services to an Internet Web Provider.
	To edit the software we recommend Scintilla Scite text editor, PhMyAdmin for the database and Mozilla firefox developer tools for testing. Text files are coded in utf-8 so for edit them in Scite I recommend you to make this settings: click options -> open global options file and search for code.page=65001, remove the comments on it, include comments on the next line code.page=0 and save the file.
2 - Unpack the source code to the desired folder
3 - Create a database and import database.sql. You can use PhpMyAdmin for this purpose.
4 - Edit database settings at:
	includes/config.php
	dbmanager/includes/config.php

*****************
*Getting started*
*****************
Execute it at the main folder and at the dbmanager subfolder for the database edition tool.