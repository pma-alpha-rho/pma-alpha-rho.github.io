<?php
// include the script at the _top_
include('../news.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<!-- link to the basic template from _this_ file -->
<link rel="stylesheet" type="text/css" href="../display/basic/style.css" />

<title>show_archives() or show_categories()</title>
</head>
<body>

<?php
// EITHER
//show_archives();

// OR
 show_categories();

//OR both
// show_archives();
// show_categories();


// empty show_news()	*required*
show_news();
?>

</body>
</html>
