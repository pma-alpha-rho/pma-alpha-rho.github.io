<?php
class SpellCheck {
	var $link;
	
	function SpellCheck($dic='en', $mode=PSPELL_FAST) {
		$this->link = pspell_new($dic, '', '', '', $mode);
	}
	
	function getErrors($text, $max=10) {
		$separator = "!$%^&*()-_=+{}[]\\|;:\",.?/\n\r|\t ";
		$errors = array('word'=>array(), 'suggest'=>array());
		$word = strtok($text, $separator);
		while ($word!==false) {
			if (!is_numeric($word) && !in_array($word, $errors['word']) && !pspell_check($this->link, $word)) {
				$errors['word'][] = $word;
				$suggests = pspell_suggest($this->link, $word);
				if (array_key_exists($max, $suggests)) array_splice($suggests, $max);
				$errors['suggest'][] = $suggests;
			}
			$word = strtok($separator);
		}
		return $errors;
	}
	
	function getCorrectedText($text, $words, $suggests) {
		$replaces = array();
		for ($i=0, $n=count($words); $i<$n; $i++) {
			$replaces[$i] = '$1<span><span class="spelling">' . $words[$i] .
							'</span><select><option value="' . $words[$i] . '">' . $words[$i] . '</option>';
			for ($j=0, $m=count($suggests[$i]); $j<$m; $j++) {
				$replaces[$i] .= '<option value="' . $suggests[$i][$j] . '">' . $suggests[$i][$j] . '</option>';
			}
			$replaces[$i] .= '</select></span>$2';
			$words[$i] = "/([^'\w])" . $words[$i] . "([^'\w])/";
		}
		return nl2br(trim(preg_replace($words, $replaces, ' ' . htmlspecialchars($text) . ' ')));
	}
	
	function filterBB($content) {
		$codes['bb'][] = '@\[url=.*?\](.*?)\[/url\]@i';
		$codes['bb'][] = '@\[url\](https?|ftps?)://.*?\[/url\]@i';
		$codes['bb'][] = '@\[img\](.*?)\[/img\]@i';
		$codes['bb'][] = '@\[embed\](.*?)\[/embed\]@i';
		$codes['bb'][] = '@\[del\](.*?)\[/del\]@i';
		$codes['bb'][] = '@\[code\]((.|\r|\n)*?)\[/code\]@i';
		$codes['bb'][] = '@\[img=\s*(left|right)\](.*?)\[/img\]@i';
		$codes['bb'][] = '@\[raw\]((.|\r|\n)*?)\[/raw\]@i';
		$codes['bb'][] = '@\[sub\](.*?)\[/sub\]@i';
		$codes['bb'][] = '@\[sup\](.*?)\[/sup\]@i';
		
		$codes['html'][] = '$1';
		$codes['html'][] = ' ';
		$codes['html'][] = ' ';
		$codes['html'][] = ' ';
		$codes['html'][] = '$1';
		$codes['html'][] = ' ';
		$codes['html'][] = ' ';
		$codes['html'][] = ' ';
		$codes['html'][] = ' $1 ';
		$codes['html'][] = ' $1 ';
		
		return preg_replace($codes['bb'], $codes['html'], $content);
	}
}
?>