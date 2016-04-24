function esta_repetido (un_array,valor) 
{
  var index;
 
  for (index=0;index < un_array.length;index++)
     if (un_array[index] == valor) 
       return true;
  return false;
}

function generar_orden (cantidad)
{
  var orden = new Array();
  var index, aleatorio;
    
  for (index=0; index < cantidad;) {
	  aleatorio=Math.round((cantidad-1)*Math.random());
	  if (!esta_repetido (orden,aleatorio)) {
	     orden[index]=aleatorio;  
	     index++;
	    }
	}
  return orden;
}


function separa_frases (cadena) 
{
  var retvalue = new Array();
  var ret_index, index, cont;
  
  for (ret_index=0, index=0;index<cadena.length;index++)
    if (cadena.charAt(index)=='{') {
      for (cont=index; cont < cadena.length; cont++)
        if (cadena.charAt(cont) == '}')
          break;
      retvalue[ret_index] = cadena.substring(index+1,cont);     
      ret_index++;
    }
  return retvalue;  
}

function cambiar_frases (cadena, frases, un_arreglo) 
{
 var index_a=0, index_c, cont=0;
 var cadena_total="";
 
   for (index_c=0; index_c<cadena.length; index_c++) 
     if (cadena.charAt(index_c)=='{') {
       cadena_total+=cadena.substring(cont, index_c);
       cadena_total+=frases[un_arreglo[index_a]];
       index_a++;
       for (cont=index_c;cont < cadena.length;cont++)
         if (cadena.charAt(cont) == '}')
           break;
       cont++;    
     }   
 cadena_total+=cadena.substring(cont,cadena.length);
 return cadena_total;
}

function genera_array (value)
{
  var i;
  var frases = new Array();
  
  for (i=0; obj_span=findObj(value+i); i++) {
    frases[i]=obj_span.texto;
    }
    return frases;
}

function intercambiar_frases (arreglo_total) 
{
  var index,cont;
  var frases = new Array();
  var orden = new Array();
  
  for (index=0;index<arreglo_total.length;index++) {
    frases = separa_frases(arreglo_total[index]);
    if (frases.length==0)
      continue;
    orden = generar_orden(frases.length);
    arreglo_total[index] = cambiar_frases(arreglo_total[index],frases,orden);
  }  
  return arreglo_total;
}

function pegar_en_orden (un_array,orden) 
{
  var index;
  var retvalue="";
  
  for (index=0; index < un_array.length; index++) 
     retvalue=retvalue+un_array[orden[index]];    
  return retvalue;
}

function coger_palabras (cadena,pos) 
{
  var retvalue=new Array();
  var index=0, cont, cont2;
  for (cont=pos;cont<cadena.length;) 
  {
    if (cadena.charAt(cont)==']') 
      break;
    for (cont2=cont;cadena.charAt(cont2)!=' ' && cadena.charAt(cont2)!=']' ;cont2++);
    retvalue[index] = poner_string_char(cadena.substring(cont,cont2),"_"," ");
    index++;
    cont=(cadena.charAt(cont2)==' ')?cont2+1:cont2;
  }
  return retvalue;
}


function ponerConjunciones(cadena) 
{
  var index_corchete, i, aleatorio;
  var retvalue="", final_cadena="";
  var palabras=new Array();
  
  for (i=0;i<cadena.length;i++) {
    if (cadena.charAt(i)=='['){
      for (index_corchete=i;index_corchete<cadena.length;index_corchete++)
          if (cadena.charAt(index_corchete)==']')
            break;
      if (cadena.charAt(i+1)=='+' && cadena.charAt(i+2)!=']'){
        palabras=coger_palabras(cadena,i+2);
        aleatorio=Math.round((palabras.length-1)*Math.random());
        final_cadena=cadena.substring(index_corchete+1,cadena.length);
        cadena=cadena.substring(0,i);
        cadena=cadena+" "+palabras[aleatorio]+" "+final_cadena;
      }else{
        final_cadena=cadena.substring(index_corchete+1,cadena.length);
        cadena=cadena.substring(0,i);
        cadena+=final_cadena;
      }  
    }
  }
  retvalue=cadena;
  return retvalue;
}

function poner_string_char(cadena,busco,reemplazo) 
{
  re = new RegExp(busco,"g");
  cadena=cadena.replace(re,reemplazo);
  return cadena;
}


function orden (value)
{
  var orden, index;
  var frases = new Array();
  
  frases = genera_array(value);
  frases = intercambiar_frases (frases);
  for (index=0;index < frases.length; index++)
    frases[index] =  ponerConjunciones(frases[index]); 
  
  orden = generar_orden(frases.length); 
  
  for (i=0; i < frases.length; i++) 
  {
    findObj (value+i).innerHTML  = frases[orden[i]];
  }  
}


/***
*
*  EJEMPLO
*
*
*

</script>
</head>

<body onload="orden('frase_a'); orden('frase_b');">
<span id="frase_a0" texto="[+pero quizas] {otro} y {uno}">frase 0 </span>
espacio reservado para texto fijo<br>
<span id="frase_b0" texto="otro {codigo} sin {sentido}">frase b</span>
<p>mas espacio reservado </p>
<span id="frase_a1" texto="dos" conjunciones="Pero_otro Quizas_nada_otro Otro" >frase1 </span>


</body>*/