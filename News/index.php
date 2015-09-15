<?php
session_start('news');
include('./functions.php');

class NewsPanel extends WingedNews {
	var $tpl;
	var $userfile;
	var $notes;
	var $message;
	
	function NewsPanel() {
		$this->WingedNews();
		$this->tpl = './template/' . $this->configs['tpl'] . '/';
		$this->userfile = './data/users.txt';
		$this->notes = parse_ini_file($this->tpl . 'note.tpl');
		$this->message = $this->notes['welcome'];
	}
	
	function delElements($keys, $path, $begin, $end) {
		$output = '';
		$lines = file($path);
		for ($i=0, $n=count($lines); $i<$n; $i++) {
			if (trim($lines[$i])==$begin) {
				if (!in_array(trim($lines[$i+1]), $keys)) {
					for (;; $i++) {
						$output .= $lines[$i];
						if (trim($lines[$i])==$end) break;
					}
				} else $i+=2;
			}
		}
		return $output;
	}
	
	function isDuplicate($input, $array, $key) {
		if (get_magic_quotes_gpc()) {
			$input = htmlspecialchars(stripslashes($input), ENT_QUOTES);
		} else {
			$input = htmlspecialchars($input, ENT_QUOTES);
		}
		for ($i=0, $n=count($array); $i<$n; $i++) {
			if (strcasecmp($array[$i][$key], $input)===0) return true;
		}
		return false;
	}
	
	function isAuthorised() {
		return $_SESSION['news']['userid']==0;
	}

	function login($user, $pass) {
		if (get_magic_quotes_gpc()) $pass = stripslashes($pass);
		$lines = file($this->userfile);
		for ($i=0, $n=count($lines); $i<$n; $i++) {
			if (trim($lines[$i])=='<user>') {
				if (stripslashes(trim($lines[$i+2]))==$user) {
					$passwd = trim($lines[$i+3]);
					if (md5($pass)==$passwd) {
						$_SESSION['news']['userid'] = trim($lines[$i+1]);
						return true;
					}
					break;
				} else $i+=4;
			}
		}
		return false;
	}

	function getUserDetails($id) {
		$users = array();
		$lines = file($this->userfile);
		for ($i=0, $n=count($lines); $i<$n; $i++) {
			if (trim($lines[$i])=='<user>') {
				if (trim($lines[$i+1])==$id) {
					$users['id'] = $id;
					$users['user'] = htmlspecialchars(stripslashes(trim($lines[$i+2])), ENT_QUOTES);
					$users['pass'] = trim($lines[$i+3]);
					break;
				} else $i+=4;
			}
		}
		return $users;
	}

	function addPost($subject, $message, $cats=null, $locked=false, $time=null) {
		$locked=true;
		if (!get_magic_quotes_gpc()) {
			$subject = addslashes($subject);
			$message = addslashes($message);
		}
		$id = $time==null? ($this->configs['daylight']? time()+3600 : time()) : $time;
		$dates = $this->getDateArray($id);
		$file = $this->postpath . $dates['year'] . '-' . $dates['mon'] . '.txt';
		$content = "\n<post>\n" . $id . "\n" . $subject . "\n" . $message . "\n</post>";
		$handle = fopen($file, 'a') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($handle);
			exit('error2');
		}
		if ($cats!=null) {
			$content = '';
			for ($i=0, $n=count($cats); $i<$n; $i++) {
				$content .= "\n<cat>\n" . $cats[$i] . "\n</cat>";
			}
			$handle = fopen($this->catpath . $id . '.txt', 'w') or exit('error1');
			if (fwrite($handle, $content)===false) {
				fclose($handle);
				exit('error2');
			}
		}
		if ($locked) {
			$handle = fopen($this->lockfile, 'a') or exit('error1');
			if (fwrite($handle, "\n<post>\n" . $id . "\n</post>")===false) {
				fclose($handle);
				exit('error2');
			}
		}
		fclose($handle);
	}

	function delPosts($ids) {
		$archives = array();
		$locked_posts = $this->getLockedPosts();
		$num_lock = count($locked_posts);
		for ($i=0, $n=count($ids); $i<$n; $i++) {
			if (is_file($this->commentpath . $ids[$i]. '.txt')) {
				if (unlink($this->commentpath . $ids[$i]. '.txt')===false) exit('error4');
			}
			if (is_file($this->catpath . $ids[$i]. '.txt')) {
				if (unlink($this->catpath . $ids[$i]. '.txt')===false) exit('error4');
			}
			$dates = $this->getDateArray($ids[$i]);
			$key = $dates['year'] . '-' . $dates['mon'];
			$archives[$key][] = $ids[$i];
			$index = array_search($ids[$i], $locked_posts);
			if ($index!==false) unset($locked_posts[$index]);
		}
		if (count($locked_posts)<$num_lock) {
			$content = '';
			foreach ($locked_posts as $post) {
				$content .= "\n<post>\n" . $post . "\n</post>";
			}
			$handle = fopen($this->lockfile, 'w') or exit('error1');
			if (fwrite($handle, $content)===false) {
				fclose($handle);
				exit('error2');
			}
			fclose($handle);
		}
		foreach ($archives as $key => $vals) {
			$content = $this->delElements($vals, $this->postpath . $key . '.txt', '<post>' , '</post>');
			if (empty($content)) {
				if (unlink($this->postpath . $key . '.txt')===false) exit('error4');
			} else {
				$handle = fopen($this->postpath . $key . '.txt', 'w') or exit('error1');
				if (fwrite($handle, $content)===false) {
					fclose($handle);
					exit('error2');
				}
				fclose($handle);
			}
		}
	}

	function editPost($id, $subject, $message, $cats=null, $locked=false) {
		$dates = $this->getDateArray($id);
		$file = $this->postpath . $dates['year'] . '-' . $dates['mon'] . '.txt';
		$content = $this->delElements(array($id), $file, '<post>', '</post>');
		if (!get_magic_quotes_gpc()) {
			$subject = addslashes($subject);
			$message = addslashes($message);
		}
		$content .= "\n<post>\n" . $id . "\n" . $subject . "\n" . $message . "\n</post>";
		$handle = fopen($file, 'w') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($handle);
			exit('error2');
		}
		if ($cats!=null) {
			$content = '';
			for ($i=0, $n=count($cats); $i<$n; $i++) {
				$content .= "\n<cat>\n" . $cats[$i] . "\n</cat>";
			}
			$handle = fopen($this->catpath . $id . '.txt', 'w') or exit('error1');
			if (fwrite($handle, $content)===false) {
				fclose($handle);
				exit('error2');
			}
		} else if (is_file($this->catpath . $id . '.txt')) {
			if (unlink($this->catpath . $id . '.txt')===false) {
				fclose($handle);
				exit('error4');
			}
		}
		$locked_posts = $this->getLockedPosts();
		if ($locked) {
			if (!in_array($id, $locked_posts)) {
				$handle = fopen($this->lockfile, 'a') or exit('error1');
				if (fwrite($handle, "\n<post>\n" . $id . "\n</post>")===false) {
					fclose($handle);
					exit('error2');
				}
			}
		} else {
			$index = array_search($id, $locked_posts);
			if ($index!==false) {
				array_splice($locked_posts, $index, 1);
				$content = '';
				for ($i=0, $n=count($locked_posts); $i<$n; $i++) {
					$content .= "\n<post>\n" . $locked_posts[$i] . "\n</post>";
				}
				$handle = fopen($this->lockfile, 'w') or exit('error1');
				if (fwrite($handle, $content)===false) {
					fclose($handle);
					exit('error2');
				}
			}
		}
		fclose($handle);
	}

	function delComments($post, $ids) {
		$content = $this->delElements($ids, $this->commentpath . $post . '.txt', '<comment>', '</comment>');
		if (empty($content)) {
			if (unlink($this->commentpath . $post . '.txt')===false) exit('error4');
			return;
		}
		$handle = fopen($this->commentpath . $post . '.txt', 'w') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($hanlde);
			exit('error2');
		}
		fclose($handle);
	}

	function editUser($id, $user, $pass) {
		$content = $this->delElements(array($id), $this->userfile, '<user>', '</user>');
		if (get_magic_quotes_gpc()) {
			$pass = stripslashes($pass);
		} else {
			$user = addslashes($user);
		}
		$content .= "\n<user>\n" . $id . "\n" . $user . "\n" . md5($pass) . "\n</user>";
		$handle = fopen($this->userfile, 'w') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($handle);
			exit('error2');
		}
		fclose($handle);
	}

	function getConfigArray() {
		$cfgs = array(
					'tpl' => $this->configs['tpl'],
					'display' => $this->configs['display'],
					'flood' => $this->configs['flood'],
					'comment' => $this->configs['comment']? 'checked' : '',
					'filter' => $this->configs['filter'],
					'list' => $this->configs['list'],
					'date' => $this->configs['date'],
					'time' => $this->configs['time'],
					'daylight' => $this->configs['daylight']? 'checked' : '',
					'alias' => $this->configs['alias']? 'checked' : '',
					'uri' => $this->configs['uri'],
					'title' => $this->configs['title'],
					'description' => $this->configs['description'],
					'langs' => array(
								array(
									'"' . $this->configs['locale'] . '"',
									'<option value="' . $this->configs['zone'] . '"'
								),
								array(
									'"' . $this->configs['locale'] . '" selected ',
									'<option value="' . $this->configs['zone'] . '" selected '
									)
								)
				);
		return $cfgs;
	}

	function editConfig($uri, $title, $description, $zone, $date, $time, $tpl, $display, $flood, $filter, $list, $locale, $daylight=0, $comment=0, $alias=0) {
		$filter = str_replace(array("\r", "\n"), '', $filter);
		$list = str_replace(array("\r", "\n"), '', $list);
		$content = "zone = $zone
					date = \"$date\"
					time = \"$time\"
					tpl = \"$tpl\"
					display = \"$display\"
					flood = $flood
					comment = $comment
					filter = \"$filter\"
					list = \"$list\"
					locale = \"$locale\"
					daylight = $daylight
					alias = $alias
					uri = $uri
					title = $title
					description = $description
					";
		$handle = fopen($this->configfile, 'w') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($handle);
			exit('error2');
		}
		fclose($handle);
	}

	function previewPost($subject, $message) {
		$posts['subject'] = get_magic_quotes_gpc()? htmlspecialchars(stripslashes($subject), ENT_QUOTES) : htmlspecialchars($subject, ENT_QUOTES);
		$posts['message'] = get_magic_quotes_gpc()? $this->str2para($this->parseBB(htmlspecialchars(stripslashes($message), ENT_QUOTES))) : $this->str2para($this->parseBB(htmlspecialchars($message, ENT_QUOTES)));
		return $this->parseTemplate(file_get_contents($this->tpl . 'preview.tpl'), $posts);
	}

	function addCat($catname) {
		if (!get_magic_quotes_gpc()) {
			$catname = addslashes($catname);
		}
		$cats = $this->getCats();
		$id = 1;
		for ($i=0, $n=count($cats); $i<$n; $i++) {
			if ($cats[$i]['CAT_ID']>=$id) $id = $cats[$i]['CAT_ID'] + 1;
		}
		$content = "\n<cat>\n" . $id . "\n" . $catname . "\n</cat>";
		$handle = fopen($this->catfile, 'a') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($handle);
			exit('error2');
		}
		fclose($handle);
	}

	function editCats($edit, $cats, $catnames=null) {
		$content = $this->delElements($cats, $this->catfile, '<cat>', '</cat>');
		if ($edit=='r') {	// rename
			for ($i=0, $n=count($cats); $i<$n; $i++) {
				$name = get_magic_quotes_gpc()? $catnames[$i] : addslashes($catnames[$i]);
				$content .= "\n<cat>\n" . $cats[$i] . "\n" . $name . "\n</cat>";
			}
		} else if ($edit=='d') {	// delete
			$catposts = $this->getCatsPosts($cats);
			$posts = array();
			for ($i=0, $n=count($catposts); $i<$n; $i++) {
				for ($j=0, $m=count($catposts[$i]); $j<$m; $j++) {
					if (!in_array($catposts[$i][$j], $posts)) $posts[] = $catposts[$i][$j];
				}
			}
			$this->delPosts($posts);
		}
		$handle = fopen($this->catfile, 'w') or exit('error1');
		if (fwrite($handle, $content)===false) {
			fclose($handle);
			exit('error2');
		}
		fclose($handle);
	}
}





$thenews = new NewsPanel();


if (isset($_POST['do'])) {
	if ($_POST['do']=='login') {
		if (!(isset($_POST['user']) && isset($_POST['pass']))) exit('error3');
		if (!$thenews->login($_POST['user'], $_POST['pass'])) $thenews->message = $thenews->notes['login'];
		
	} else if ($_POST['do']=='newpost') {
		if (!(isset($_SESSION['news']['userid']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['hr']) && isset($_POST['min']))) {
			exit('error3');
		}
		if (isset($_POST['submit'])) {
			if ($thenews->isAuthorised()) {
				$post_subject = trim($_POST['subject']);
				$post_message = trim($_POST['message']);
				$post_cats = isset($_POST['cats'])? $_POST['cats'] : null;
				$post_locked = isset($_POST['locked']);
				$post_day = intval(substr($_POST['day'], 2));
				$post_month = intval(substr($_POST['month'], 2));
				$post_year = intval($_POST['year']);
				$post_hr = intval(substr($_POST['hr'], 2));
				$post_min = intval(substr($_POST['min'], 2));
				if (empty($post_subject) || empty($post_message) ||
					strpos($post_message, '</post>')!==false || strpos($post_message, '<post>')!==false ||
					(isset($_POST['time']) && (!checkdate($post_month, $post_day, $post_year) ||
					$post_hr<0 || $post_hr>23 || $post_min<0 || $post_min>59))
					)
				{
					$thenews->message = $thenews->notes['invalid'];
				} else if (isset($_POST['time'])) {
					$post_time = gmmktime($post_hr, $post_min, 0, $post_month, $post_day, $post_year) - $thenews->configs['zone']*3600;
					while ($thenews->getPostDetails($post_time)!==false) {
						$post_time++;
					}
					$thenews->addPost($post_subject, $post_message, $post_cats, $post_locked, $post_time);
					$thenews->message = $thenews->notes['post_add'];
				} else {
					$thenews->addPost($post_subject, $post_message, $post_cats, $post_locked);
					$thenews->message = $thenews->notes['post_add'];
				}
			} else {
				$thenews->message = $thenews->notes['access'];
			}
		} else if (isset($_POST['preview'])) {
			print $thenews->previewPost($_POST['subject'], $_POST['message']);
			exit('<!-- preview -->');
		}
		
	} else if ($_POST['do']=='post') {
		if (!isset($_SESSION['news']['userid'])) exit('error3');
		if (isset($_POST['del'])) {
			if ($thenews->isAuthorised()) {
				if (isset($_POST['ids'])) {
					$thenews->delPosts($_POST['ids']);
					$thenews->message = $thenews->notes['post_del'];
				} else {
					$thenews->message = $thenews->notes['invalid'];
				}
			} else {
				$thenews->message = $thenews->notes['access'];
			}
		} else if (isset($_POST['edit'])) {
			if (isset($_POST['ids'])) {
				$posts = $thenews->getPostDetails($_POST['ids'][0]);
				$cats = $posts['CATS'];
				$num_cat = count($cats);
				for ($i=0; $i<$num_cat; $i++) {
					unset($cats[$i]['POSTS'], $cats[$i]['NUM_POST']);
				}
				if ($num_cat>1) unset($cats[$num_cat-1]);
				unset($posts['CATS']);
				$thenews->message = $thenews->parseTemplate($thenews->parseRecTemplate(file_get_contents($thenews->tpl . 'post_detail.tpl'), '<!-- BEGIN -->', '<!-- END -->', $cats), $posts);
			} else {
				$thenews->message = $thenews->notes['invalid'];
			}
		} else if (isset($_POST['view'])) {
			if (isset($_POST['ids'])) {
				$posts = $thenews->getPostDetails($_POST['ids'][0]);
				if ($posts!==false) {
					$thenews->message = $thenews->getOutputPost($posts, $thenews->tpl . 'post_view.tpl', $thenews->tpl . 'post_comments.tpl');
				}
			} else {
				$thenews->message = $thenews->notes['invalid'];
			}
		}
		
	} else if ($_POST['do']=='editpost') {
		if (!(isset($_SESSION['news']['userid']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['id']))) {
			exit('error3');
		}
		if (isset($_POST['submit'])) {
			if ($thenews->isAuthorised()) {
				$post_subject = trim($_POST['subject']);
				$post_message = trim($_POST['message']);
				$post_cats = isset($_POST['cats'])? $_POST['cats'] : null;
				$post_locked = isset($_POST['locked']);
				if (empty($post_subject) || empty($post_message) || strpos($post_message, '</post>')!==false || strpos($post_message, '<post>')!==false) {
					$thenews->message = $thenews->notes['invalid'];
				} else {
					$thenews->editPost($_POST['id'], $post_subject, $post_message, $post_cats, $post_locked);
					$thenews->message = $thenews->notes['post_edit'];
				}
			} else {
				$thenews->message = $thenews->notes['access'];
			}	
		} else if (isset($_POST['preview'])) {
			print $thenews->previewPost($_POST['subject'], $_POST['message']);
			exit('<!-- preview -->');
		}
		
	} else if ($_POST['do']=='delcomment') {
		if (!(isset($_SESSION['news']['userid']) && isset($_POST['id']))) exit('error3');
		if ($thenews->isAuthorised()) {
			if (isset($_POST['ids'])) {
				$thenews->delComments($_POST['id'], $_POST['ids']);
				$thenews->message = $thenews->notes['comment_del'];
			} else {
				$thenews->message = $thenews->notes['invalid'];
			}
		} else {
			$thenews->message = $thenews->notes['access'];
		}
		
	} else if ($_POST['do']=='edituser') {
		if (!(isset($_SESSION['news']['userid']) && isset($_POST['id']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['newpass']) && isset($_POST['newpass1']))) {
			exit('error3');
		}
		if ($thenews->isAuthorised()) {
			$post_user = trim($_POST['user']);
			if ($_POST['id']==$_SESSION['news']['userid'] && !empty($post_user) && strpos($post_user, '</user>')===false && strpos($post_user, '<user>')===false) {
				$users = $thenews->getUserDetails($_POST['id']);
				$post_pass = get_magic_quotes_gpc()? stripslashes($_POST['pass']) : $_POST['pass'];
				$newpass = trim($_POST['newpass']);
				if (md5($post_pass)==$users['pass']) {
					if (empty($newpass)) {
						$thenews->editUser($_POST['id'], $post_user, $_POST['pass']);
						$thenews->message = $thenews->notes['prof_edit'];
					} else if ($newpass==$_POST['newpass1']) {
						$thenews->editUser($_POST['id'], $post_user, $newpass);
						$thenews->message = $thenews->notes['prof_edit'];
					} else {
						$thenews->message = $thenews->notes['invalid'];
					}
				} else {
					$thenews->message = $thenews->notes['invalid'];
				}
			} else {
				$thenews->message = $thenews->notes['invalid'];
			}
		} else {
			$thenews->message = $thenews->notes['access'];
		}
		
	} else if ($_POST['do']=='config') {
		if (!(isset($_SESSION['news']['userid']) && isset($_POST['uri']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['zone']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['tpl']) && isset($_POST['display']) && isset($_POST['flood']) && isset($_POST['filter']) && isset($_POST['list']) && isset($_POST['locale']))) {
			exit('error3');
		}
		if ($thenews->isAuthorised()) {
			if (is_dir('./template/' . $_POST['tpl']) && is_dir('./display/' . $_POST['display'])) {
				$post_daylight = isset($_POST['daylight'])? 1 : 0;
				$post_comment = isset($_POST['comment'])? 1 : 0;
				$post_alias = isset($_POST['alias'])? 1 : 0;
				$thenews->editConfig($_POST['uri'], $_POST['title'], $_POST['description'], $_POST['zone'], $_POST['date'], $_POST['time'], $_POST['tpl'], $_POST['display'], $_POST['flood'], $_POST['filter'], $_POST['list'], $_POST['locale'], $post_daylight, $post_comment, $post_alias);
				$thenews->message = $thenews->notes['conf_edit'];
			} else {
				$thenews->message = $thenews->notes['invalid'];
			}
		} else {
			$thenews->message = $thenews->notes['access'];
		}
		
	} else if ($_POST['do']=='category') {
		if (!isset($_SESSION['news']['userid'])) exit('error3');
		if ($thenews->isAuthorised()) {
			if (isset($_POST['new'])) {
				$post_catname = trim($_POST['cat_name']);
				if (empty($post_catname) || strpos($post_catname, '<cat>')!==false || strpos($post_catname, '</cat>')!==false || $thenews->isDuplicate($post_catname, $thenews->getCats(), 'CAT_NAME')) {
					$thenews->message = $thenews->notes['invalid'];
				} else {
					$thenews->addCat($post_catname);
					$thenews->message = $thenews->notes['cat_add'];
				}
			} else if (isset($_POST['rename'])) {
				if (isset($_POST['cats'])) {
					$post_cats = array('cat_id'=>array(), 'cat_name'=>array());
					$flag = true;
					$catlist = $thenews->getCats();
					for ($i=0, $n=count($_POST['cats']); $i<$n; $i++) {
						list($catid, $catname) = array_map('trim', explode("\n", $_POST['cats'][$i]));
						if (empty($catname) || strpos($catname, '<cat>')!==false || strpos($catname, '</cat>')!==false || $thenews->isDuplicate($catname, $catlist, 'CAT_NAME')) {
							$thenews->message = $thenews->notes['invalid'];
							$flag = false;
							break;
						} else {
							$post_cats['cat_id'][] = $catid;
							$post_cats['cat_name'][] = $catname;
						}
					}
					if ($flag) {
						$thenews->editCats('r', $post_cats['cat_id'], $post_cats['cat_name']);
						$thenews->message = $thenews->notes['cat_rename'];
					}
				} else {
					$thenews->message = $thenews->notes['invalid'];
				}
			} else if (isset($_POST['del'])) {
				if (isset($_POST['cats'])) {
					$thenews->editCats('d', $_POST['cats']);
					$thenews->message = $thenews->notes['cat_del'];
				} else {
					$thenews->message = $thenews->notes['invalid'];
				}
			}
		} else {
			$thenews->message = $thenews->notes['access'];
		}
	}
}



include($thenews->tpl . 'header.tpl');

if (isset($_GET['a'])) {
	if ($_GET['a']=='h') {
		include($thenews->tpl . 'help.tpl');
		
	} else if (isset($_SESSION['news']['userid'])) {
		if ($_GET['a']=='o') {
			unset($_SESSION['news']);
			print $thenews->notes['logout'];
			
		} else if ($_GET['a']=='n') {
			$cats = $thenews->getCats();
			$num_cat = count($cats);
			for ($i=0; $i<$num_cat; $i++) {
				unset($cats[$i]['POSTS'], $cats[$i]['NUM_POST']);
			}
			if ($num_cat>1) unset($cats[$num_cat-1]);	
			$todays = $thenews->getDateArray();
			$dates = array(
						array(
							'"da' . $todays['mday'] . '"',
							'"mo' . $todays['mon'] . '"',
							'"hr' . $todays['hours'] . '"',
							'"mi' . $todays['minutes'] . '"'
						),
						array(
							'"da' . $todays['mday'] . '" selected ',
							'"mo' . $todays['mon'] . '" selected ',
							'"hr' . $todays['hours'] . '" selected ',
							'"mi' . $todays['minutes'] . '" selected '
						)
					);
			$years = array();
			for ($i=$todays['year'], $n=$todays['year']+5; $i<$n; $i++) {
				$years[]['year'] = $i;
			}
			$tpl = str_replace($dates[0], $dates[1], file_get_contents($thenews->tpl . 'newpost.tpl'));
			print $thenews->parseRecTemplate($thenews->parseRecTemplate($tpl, '<!-- BEGIN1 -->', '<!-- END1 -->', $years), '<!-- BEGIN -->', '<!-- END -->', $cats);
		
		} else if ($_GET['a']=='p') {
			$users = $thenews->getUserDetails($_SESSION['news']['userid']);
			print $thenews->parseTemplate(file_get_contents($thenews->tpl . 'profile.tpl'), $users);
		
		} else if ($_GET['a']=='m') {
			include($thenews->tpl . 'management.tpl');
			if (isset($_GET['s'])) {
				if ($_GET['s']=='p') {
					$posts = $thenews->getPostList(0, array(), true);
					for ($i=0, $n=count($posts); $i<$n; $i++) {
						$posts[$i]['CATEGORY'] = '';
						$last_cat = count($posts[$i]['CATS'])-1;
						for ($j=0; $j<$last_cat; $j++) {
							if ($posts[$i]['CATS'][$j]['CHECK']) {
								$posts[$i]['CATEGORY'] .= $posts[$i]['CATS'][$j]['CAT_NAME'] . ', ';
							}
						}
						$posts[$i]['CATEGORY'] = empty($posts[$i]['CATEGORY'])? $posts[$i]['CATS'][$last_cat]['CAT_NAME'] : substr($posts[$i]['CATEGORY'], 0, -2);
						unset($posts[$i]['CATS'], $posts[$i]['MESSAGE']);
					}
					print $thenews->parseRecTemplate(file_get_contents($thenews->tpl . 'post_list.tpl'), '<!-- BEGIN -->', '<!-- END -->', $posts);
				} else if ($_GET['s']=='c') {
					$cats = $thenews->getCats(true);
					$last_cat = count($cats)-1;
					for ($i=0; $i<$last_cat; $i++) {
						unset($cats[$i]['POSTS']);
					}
					unset($cats[$last_cat]);
					print $thenews->parseRecTemplate(file_get_contents($thenews->tpl . 'category_list.tpl'), '<!-- BEGIN -->', '<!-- END -->', $cats);
				}
			}
		
		} else if ($_GET['a']=='s') {
			$configs = $thenews->getConfigArray();
			$langs = array_pop($configs);
			print $thenews->parseTemplate(str_replace($langs[0], $langs[1], file_get_contents($thenews->tpl . 'settings.tpl')), $configs);
		}
	
	} else {
		print $thenews->message;
		include($thenews->tpl . 'login.tpl');
	}
} else {
	print $thenews->message;
}
include($thenews->tpl . 'footer.tpl');

?>
