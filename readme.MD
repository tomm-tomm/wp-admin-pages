This code adds custom theme settings pages to WordPress (WP) admin interface and generate custom CSS for pages that contain CSS settings. Can be used as a part of custom WP theme and it's possible to combine this code with the codes in these repositories:
- https://github.com/tomm-tomm/wp-init-db-tables - automatic creation of tables using the init-db-tables.php file
- https://github.com/tomm-tomm/wp-init-pages-and-menu - automatic creation of the pages and menus using the init-pages-menu.php file

Step 1:
[Set menu structure] Add first-, second- and third-level menu items in the structure in menu.php file (in rt_admin_settings() and rt_admin_load_page() functions).

Step 2:
[Create database tables] In the database, create a tables with required columns.

Step 3:
[Add the content] Add the content of the pages in the "forms" directory. Set the file names in this format: "second-level page name"-"third-level page name".php (f.e. page1-subpage2.php).
Note: To upload images, use the admin-file-uploader.js file stored in the "javascript" directory.

Step 4:
[Set custom CSS generator] Leave the code below "Generate custom CSS" comment uncommented in db.php file. Set required MySQL queries and CSS for each page in styles/get-custom-css.php file. At the beginning of the same file, set the name of the table with custom CSS created in the database into the line with this comment "Custom CSS table name". Also, set the name of the specific column of the table with custom CSS created in the database into the line with this comment "Key = custom CSS column name in the table above".

Step 5:
[Generate custom CSS] After submitting any form (by pressing the submit button), custom CSS is generated and stored in the corresponding database table/column.

Code enhancement options:
1. Create a configuration file for the variables from the steps 1 and 4.
2. Consider OOP realization.