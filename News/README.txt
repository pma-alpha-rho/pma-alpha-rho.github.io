News System v1.3.4 (http://winged.info)
=================================
Licence: GPL (see license.txt for more information)

I.   Upgrade
II.  New Installation
III. Usage

I. Upgrade from version 1.0, 1.1 and 1.2:
------------------------------------------

   1. Extract the new version on to your local machine.
   2. In the 'data/' directory, delete '.htaccess', 'users.txt', 'posts/', 'comments/' and 'categories.txt' (v1.2), 'categories/' (v1.2).
   3. Upload everything to your server and overwrite existing files.
   4. Continue from step 2 of the new installation.


II. New Installation:
----------------------

   1. Extract all files to a directory on your server.
   2. Go to 'data/' directory:
          * CHMOD all subdirectories: 'posts/', 'comments/' 'and 'categories/' to 777.
          * CHMOD all text files: 'config.txt', 'logs.txt', 'users.txt', 'categories.txt' and 'post_locked.txt' to 666.
   3. Modify the "htaccess.txt" file included, then copy it to the directory where the page displaying news entries is placed, and rename it to ".htaccesss".
   4. Log in to the News Control Panel with the default account "demo/demo".


III. Usage:
------------

<?php
include('PATH/TO/NEWS/news.php');

// To display the news:
show_news(NUMBER);

// where NUMBER is the maximum number of the latest
// entries.

// OR
$categories = array(CAT1, CAT2, ...);
show_news(NUMBER, $categories);

// where CAT1, CAT2, etc. are the IDs of the categories
// you want to display.

// To display the archive list:
show_archives();

// To display the category list:
show_categories();


- Link to the display template's style sheet in the <head> section:

<link rel="stylesheet" type="text/css"
	href="PATH/TO/NEWS/display/basic/style.css" />
