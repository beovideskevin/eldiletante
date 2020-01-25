<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require ('$_.php');

if (empty($_GET['q']) || $_GET['s'] != 'SS') {
	header ("Location: pens_main.html");
}
else {
	$all = $_("assoclist: SELECT * FROM `aleph` WHERE MATCH(`text`, `author`, `title`) AGAINST('" . queryOut($_GET['q']) . "' IN NATURAL LANGUAGE MODE) ORDER BY id ASC");
	
	// error_log("SELECT * FROM `aleph` WHERE MATCH(`text`) AGAINST('" . queryOut($_GET['q']) . "' IN NATURAL LANGUAGE MODE)");
	
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
			<HTML><HEAD><TITLE>aleph · [ pensamiento ] (originalmente en http://www.aleph-arts.org/pens/main.htm )</TITLE>
			<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
			<META content="MSHTML 6.00.2600.0" name=GENERATOR>
			<META content=Lsa name=Author><LINK href="css/pens_estilo.css" type=text/css 
			rel=STYLESHEET></HEAD>
			<BODY text=#000000 vLink=#006499 aLink=#ffffff link=#006499 bgColor=#999999 
			background=images/lampe.gif>
			<SCRIPT language=Javascript>
			<!--

			function statusbartext(message)	{
					window.status=message;
					}

			// -->
			</SCRIPT>

			<CENTER>
			<TABLE height="80%" cellSpacing=0 cellPadding=0 border=0>
			  <TBODY>
			  <TR>
				<TD>
				  <DIV class=titulo>&nbsp; 
				  <CENTER>
				  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
					<TBODY>
					<TR>
						<TD><B>[ <FONT face="Verdana, Tahoma, Arial, Helvetica, sans-serif" 
						  size=1>Reaultados de la busqueda</FONT>]</B></TD></TR></TBODY></TABLE></CENTER></DIV>
					<CENTER>
					<TABLE cellSpacing=0 cellPadding=0 border=0>
					  <TBODY>
						<TR>
							<TD height=20>
							  <DIV align=right><FONT 
							  face="Verdana, Tahoma, Arial, Helvetica, sans-serif"><FONT 
							  face="Verdana, Tahoma, Arial, Helvetica, sans-serif"><FONT 
							  size=1></FONT></FONT></FONT></DIV></TD>
							<TD width=15><FONT 
							  face="Verdana, Tahoma, Arial, Helvetica, sans-serif" 
							size=1></FONT></TD>
							<TD><FONT face="Verdana, Tahoma, Arial, Helvetica, sans-serif" 
							  size=1></FONT></TD></TR>';
	
	if (! empty($all)) {
		foreach ($all as $docs) {
			
			// get the title
			$title = $docs['title'];
			
			echo '<TR>
					<TD>
					  <DIV align=right><FONT 
					  face="Verdana, Tahoma, Arial, Helvetica, sans-serif" 
					  size=1>';
			
			// get the author
			if (empty($author) || $author != $docs['author']) {
				$author = $docs['author'];
				echo htmlOut($author);				
			}
			else {
				echo '-';
			}
			
			echo '</FONT></DIV></TD>
					<TD><FONT face="Verdana, Tahoma, Arial, Helvetica, sans-serif" 
					  size=1></FONT></TD>
					<TD><FONT face="Verdana, Tahoma, Arial, Helvetica, sans-serif" 
					  size=1>[ <A 
					  href="show.php?id=' . $docs['orderlink'] . '">' . htmlOut(strlen($title) > 80 ? substr($title, 0, 80) . '...' : $title). '</A> ]</FONT></TD></TR>';
		}
	}
	
	echo '</TBODY></TABLE></CENTER></TD></TR></TBODY></TABLE></CENTER>
			<CENTER>
			<P>&nbsp;</P>
			<TABLE cellSpacing=0 cellPadding=0 width=130 border=0>
			  <TBODY>
			  <TR align=middle>
				<TD><A onmouseover="statusbartext(\'aleph\');return true" 
				  onmouseout="statusbartext(\'\');return true" 
				  href="index.html" target=_top><IMG height=30 
				  src="images/menu1.gif" width=30 border=0></A><A 
				  onmouseover="statusbartext(\'net.art\');return true" 
				  onmouseout="statusbartext(\'\');return true" 
				  href="net_art.html" target=_top><IMG height=30 
				  src="images/menu2.gif" width=30 border=0></A><A 
				  onmouseover="statusbartext(\'e-shows\');return true" 
				  onmouseout="statusbartext(\'\');return true" 
				  onclick="alert(\'We don\\\'t have the content of this link.\nNo tenemos el contenido de este vinculo.\')"
				  href="javascript:;" target=_top><IMG 
				  height=30 src="images/menu3.gif" width=30 border=0></A><A 
				  onmouseover="statusbartext(\':: eco ::\');return true" 
				  onmouseout="statusbartext(\'\');return true" 
				  href="eco.html" target=_top><IMG height=30 
				  src="images/menu4.gif" width=30 border=0></A></TD></TR>
			  <TR>
				<TD height=20></TD></TR>
			  <TR>
				<TD>
				  <CENTER><IMG height=30 src="images/menu_def.gif" width=120 border=0 
				  name=holder> </CENTER></TD></TR></TBODY></TABLE></CENTER><BR>&nbsp; 
			</BODY></HTML>';
}
