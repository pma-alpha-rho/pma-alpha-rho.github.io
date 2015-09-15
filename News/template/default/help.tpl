<div style="text-align:right"><a href="#" onclick="credits(); return false">Help / About</a></div>

<div id="help">
<table border="1" frame="void" rules="all" cellspacing="0" cellpadding="0">
	<tr><th colspan="2" class="header">Basic BBCode <a href="http://www.phpbb.com/phpBB/faq.php?mode=bbcode" class="help" title="similar to phpBB's">&nbsp;?&nbsp;</a></th></tr>
	<tr>
		<th>Input</th>
		<th>Output</th>
	</tr>
	<tr>
		<td>[b]example[/b]</td>
		<td><b>example</b></td>
	</tr>
	<tr>
		<td>[i]example[/i]</td>
		<td><i>example</i></td>
	</tr>
	<tr>
		<td>[u]example[/u]</td>
		<td><span style="text-decoration:underline">example</span></td>
	</tr>
	<tr>
		<td>[size=20]example[/size]</td>
		<td><span style="font-size:20px">example</span></td>
	</tr>
	<tr>
		<td>[color=red]example[/color] &nbsp;&nbsp;&nbsp;<span class="help" title="similar for [color=#ff0000]">[?]</span></td>
		<td><span style="color:red">example</span></td>
	</tr>
	<tr>
		<td>[url]http://example.com[/url] &nbsp;&nbsp;&nbsp;<span class="help" title="the URL must be either http(s):// or ftp(s)://">[?]</span></td>
		<td><a href="http://example.com">http://example.com</a></td>
	</tr>
	<tr>
		<td>[url=http://example.com]description[/url]</td>
		<td><a href="http://example.com">description</a></td>
	</tr>
	<tr>
		<td title="[img]http://www.w3.org/Icons/valid-xhtml10[/img]">[img]http://www.w3.org/...[/img]</td>
		<td><img alt="http://www.w3.org/Icons/valid-xhtml10" src="http://www.w3.org/Icons/valid-xhtml10" /></td>
	</tr>
	<tr>
		<td>[quote]<br />example<br />[/quote]</td>
		<td><blockquote>example</blockquote></td>
	</tr>
	<tr>
		<td>[code]<br />int main() {<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cout << "example";<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return 0;<br />}<br />[/code]</td>
		<td>
<pre>
int main() {
   cout &lt;&lt; "example";
   return 0;
}		
</pre></td>
	</tr>
	<tr>
		<td>[list]<br />[*]example<br />[*]another example<br />[/list]</td>
		<td><ul><li>example</li><li>another example</li></ul></td>
	</tr>
	<tr>
		<td>[list=1]<br />[*]example<br />[*]another example<br />[/list]</td>
		<td><ul style="list-style-type:decimal"><li>example</li><li>another example</li></ul></td>
	</tr>
	<tr>
		<td>[list=a]<br />[*]example<br />[*]another example<br />[/list]</td>
		<td><ul style="list-style-type:lower-alpha"><li>example</li><li>another example</li></ul></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><th colspan="2" class="header">Extended BBCode</th></tr>
	<tr>
		<th>Input</th>
		<th>Output</th>
	</tr>
	<tr>
		<td title="[img=right]http://www.w3.org/Icons/valid-xhtml10[/img]">[img=right]http://www.w3.org/...[/img]  &nbsp;&nbsp;<span class="help" title="similar for [img=left]">[?]</span></td>
		<td><img alt="http://www.w3.org/Icons/valid-xhtml10" src="http://www.w3.org/Icons/valid-xhtml10" style="float:right" /></td>
	</tr>
	<tr>
		<td>[acronym=United Nation]UN[/acronym]</td>
		<td><acronym title="United Nation">UN</acronym></td>
	</tr>
	<tr>
		<td>[del]example[/del]</td>
		<td><del>example</del></td>
	</tr>
	<tr>
		<td>example [sup](1)[/sup]</td>
		<td>example <sup>(1)</sup></td>
	</tr>
	<tr>
		<td>H[sub]2[/sub]O</td>
		<td>H<sub>2</sub>O</td>
	</tr>
	<tr>
		<td>[center]example[/center]</td>
		<td><div style="text-align:center">example</div></td>
	</tr>
	<tr>
		<td>[embed]example.swf[/embed]</td>
		<td>Used to embed Flash movies</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><th colspan="2" class="header">Useful Extended BBCode</th></tr>
	<tr>
		<th>Input</th>
		<th>Output</th>
	</tr>
	<tr>
		<td>
		[raw]<br />&lt;strong&gt;example&lt;/strong&gt;<br />&lt;em&gt;another example&lt;/em&gt;<br />[/raw]</td>
		<td><strong>example</strong> <em>another example</em> &nbsp;&nbsp;&nbsp;<span class="help" title="HTML code inside the [raw] tag is preserved">[?]</span></td>
	</tr>
	<tr>
		<td>[more]<br />my full example<br />[/more]</td>
		<td>( <a href="#more123">Read more...</a> ) &nbsp;&nbsp;&nbsp;<span class="help" title="Used to hide partial contents">[?]</span></td>
	</tr>
	<tr>
		<td>[more=description]<br />my full example<br />[/more]</td>
		<td>( <a href="#more456">description</a> ) &nbsp;&nbsp;&nbsp;<span class="help" title="Customized partial content's description">[?]</span></td>
	</tr>
</table>
</div>

<div id="about">
	<ul>
		<li><b>PHP News System</b></li>
		<li>Version: 1.3</li>
		<li>Author: Trinh Nguyen</li>
		<li>Licence: <a href="http://www.gnu.org/licenses/gpl.txt">GNU General Public License</a></li>
	</ul>
	<p>Please feel free to review the script at <a href="http://hotscripts.com/Detailed/58363.html">HotScripts</a>.</p>	
</div>

<script type="text/javascript"><!--
document.getElementById("about").style.display = "none";
function credits() {
	var about = document.getElementById("about");
	var help = document.getElementById("help");
	if (about.style.display == "none") {
		about.style.display = "block";
		help.style.display = "none";
	} else {
		about.style.display = "none";
		help.style.display = "block";
	}
}
--></script>