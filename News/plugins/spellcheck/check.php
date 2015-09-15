<?php
if (isset($_POST['message'])) {
	include('./spell.php');
	$post_message = get_magic_quotes_gpc()? stripslashes($_POST['message']) : $_POST['message'];
	$spell = new SpellCheck();
	$errors = $spell->getErrors(isset($_GET['bbcode'])? $spell->filterBB($post_message) : $post_message);
	print $spell->getCorrectedText($post_message, $errors['word'], $errors['suggest']);
}
?>