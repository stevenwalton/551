
Importing a database into MySQL

You can do this using either the MySQL Browser tool or at the command line.

I.  using command line

Simply redirect the file, such as
 % mysql < company.sql

or

 % mysql -u root < company.sql

II.  MySQL Workbench (preferred)

Use the Open Script command to open the company.sql file.
It will open it into a script window rather than a query window.
That's fine, here a script is just a bunch of SQL commands.
Then hit the Execute button.

The new database may not immediately show up in the database tab.
To see if it's there, you have to Refresh the tab, which you do by 
right-clicking (PC) or control-clicking (Mac) to get a menu with the refresh
choice.

III.  Differences

The sakila database consists of two files.  sakila-schema.sql will create the database
(I hope) and the tables, but will not populate the tables.  For that you will need to run
sakil-data.sql in a script tab.  (There is also a skill.mwb file, but I don't know what
it's for.)