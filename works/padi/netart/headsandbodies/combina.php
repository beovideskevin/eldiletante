<?php 
  function lee_total($fd) 
  {
    $total="";
    while (!feof($fd)) {
      $buffer = fgets($fd,4000);
      $total = $total . $buffer;
    }
    return $total;
  }
 
  function saca_contenido ($total, $begin_tag, $end_tag) 
  {
    $trad = get_html_translation_table (HTML_ENTITIES);
    $trad = array_flip ($trad);
    $total = strtr ($total, $trad);
    $pos1 = strpos ($total, $begin_tag);
    //$pos1+=7;
    $pos2 = strpos ($total, $end_tag); 
    $contenido = substr ($total,$pos1,$pos2-$pos1);
    return $contenido; 
} 
  
  if ($_GET['t_head'] || $_GET['t_body']) 
  {
    $head = "resources/".$_GET['t_head'].".html";
    $body = "resources/".$_GET['t_body'].".html";
    if (($fh = fopen ($head, "r")) && ($fb = fopen ($body, "r"))) 
    {
      $head_file = lee_total ($fh);
      $body_file = lee_total ($fb);
      echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\"><html>";
      echo saca_contenido ($head_file, "<head", "</head>")."</head>"; 
      echo saca_contenido ($body_file, "<body", "</body>")."</body></html>";
    }
    else
    {
      echo "No pude abrir los archivos!!!";
    }
  }
  else
  {
    echo "No pude coger los argumentos!!!";
  }

?>