var spellcheck = function(path, bbcode) {
	path += bbcode? "check.php?bbcode=1" : "check.php";
	var request;
	function _spellcheck() {
		request = false;
		if (window.XMLHttpRequest) {
			try {
				request = new XMLHttpRequest();
			} catch (e) {
				request = false;
			}		
		} else if (window.ActiveXObject) {
			try {
				request = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					request = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					request = false;
				}
			}
		}
		if (request) {
			var status = document.getElementById("spellStatus").getElementsByTagName("span");
			for (var i=0; i<status.length; i++) {
				if (status[i].className.match(/(start)|(update)/)) status[i].style.display = "none";
				else if (status[i].className.match("checking")) status[i].style.display = "inline";
			}
			var message = "message=" + encodeURIComponent(document.getElementById("spellMessage").value);
			request.onreadystatechange = handleResponse;
			request.open("POST", path, true);
			request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			request.setRequestHeader("Content-Length", message.length);
			request.send(message);
		} else {
			alert("Tough luck. No AJAX supported.");
		}
	}
	
	function handleResponse() {
		if (request.readyState==4) {
			if (request.status==200) {
				var status = document.getElementById("spellStatus").getElementsByTagName("span");
				for (var i=0; i<status.length; i++) {
					if (status[i].className.match(/(start)|(checking)/)) status[i].style.display = "none";
					else if (status[i].className.match("update")) status[i].style.display = "inline";
				}
				document.getElementById("spellMessage").style.display = "none";
				document.getElementById("spellSuggestion").innerHTML = request.responseText;
				document.getElementById("spellSuggestion").style.display = "block";
				addListeners();
			}
		}
	}
	
	function updateForm() {
		var status = document.getElementById("spellStatus").getElementsByTagName("span");
		for (var i=0; i<status.length; i++) {
			if (status[i].className.match(/(update)|(checking)/)) status[i].style.display = "none";
			else if (status[i].className.match("start")) status[i].style.display = "inline";
		}
		var text = document.getElementById("spellSuggestion").innerHTML;
		text = text.replace(/<span.*?class="?spelling.*?>(.*?)<\/span>.*?<\/span>/gi, "$1");
		text = text.replace(/&lt;/g, "<");
		text = text.replace(/&gt;/g, ">");
		text = text.replace(/&amp;/g, "&");
		if (navigator.userAgent.indexOf("MSIE")>-1) {
			text = text.replace(/(<br>)|(<br \/>)/gi, "\n");
		} else {
			text = text.replace(/(<br>)|(<br \/>)/gi, "");
		}
		document.getElementById("spellMessage").value = text;
		document.getElementById("spellMessage").style.display = "block";
		document.getElementById("spellSuggestion").style.display = "none";
	}
	
	function addListeners() {
		var words = document.getElementById("spellSuggestion").getElementsByTagName("select");
		for (var i=0; i<words.length; i++) {
			words[i].onchange = function() {
				this.parentNode.getElementsByTagName("span")[0].innerHTML = this.value;
			}
		}
	}
	
	return {
		check : function() { _spellcheck(); },
		resume : function() { updateForm(); }
	};
}(spellcheck_path, bbcode_is_used);