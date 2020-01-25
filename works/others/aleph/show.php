<?php

require ('$_.php');

if (! empty($_GET['id'])) {
	
	$all = $_("assoc: SELECT * FROM `aleph` WHERE `orderlink` = '" . queryOut($_GET['id']) . "'");
	
	if ( ! empty($all['text'])) {

		// get the title
		$title = $all['title'];
		
		// get the author
		$author = $all['author'];
		
		// output the header 
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
			<HTML><HEAD><TITLE>' . (htmlOut($author) . ' ' . htmlOut($title)) . '</TITLE>
			<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<META content="MSHTML 6.00.2600.0" name=GENERATOR><LINK 
			href="css/pens_estilo.css" type=text/css rel=STYLESHEET></HEAD>
			<BODY text=#000000 vLink=#006499 aLink=#ffffff link=#006499 bgColor=#999999>
			<CENTER><TABLE cellSpacing=0 cellPadding=0 width="90%" border=0><TBODY>';
		
		// output title and author
		echo '<TR><TD bgColor=#006499><DIV class=titulo><B>' . (htmlOut($title)) . '</B></DIV></TD></TR>';
		echo '<TR><TD><DIV class=autor><I>' . (htmlOut($author)) . '</I> </DIV></TD></TR>';
		echo '<TR><TD><DIV class=Section1><p><br></p></DIV>';
		
		$lines = explode ("\n", $all['text']);
		foreach ($lines as $l) {
			echo '<DIV class=Section1><p>' . (htmlOut($l)) . '</p></DIV>';
		}
		
		// finish the page
		echo '<DIV class=Section1><p><br></p><p><br></p><p><br></p></DIV></TD></TR></TBODY></TABLE></CENTER></BODY></HTML>';
	}
	
}