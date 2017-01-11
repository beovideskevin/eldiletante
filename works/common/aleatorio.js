function esta_repetido (un_array,valor) 
{
  var index;
 
  for (index=0;index < un_array.length;index++)
     if (un_array[index] == valor) 
       return true;
  return false;
}

function generar_orden (cantidad,excepciones)
{
  var orden = new Array();
  var index, aleatorio;
    
  for (index=0; index< excepciones.length;index++) 
    orden[excepciones[index]] = excepciones[index];
  
  for (index=0; index < cantidad;) {
     if (orden[index] != undefined) {
       index++;
       continue;
     }
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

function intercambiar_frases (arreglo_total) 
{
  var index,cont;
  var frases = new Array();
  var orden = new Array();
  
  for (index=0;index<arreglo_total.length;index++) {
    frases = separa_frases(arreglo_total[index]);
    if (frases.length==0)
      continue;
    orden = generar_orden(frases.length,new Array());
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
  
  
  cadena="[+" + cadena;
  //cadena=cadena.substring(cadena.indexOf(']')+1,cadena.length);
  for (i=cadena.length-1;i >= 0; i--) 
    if (cadena.charAt(i)=='[') {
      cadena=cadena.substring(0,i);
      break;
     }
   
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

function hazletodo (parrafos,excepciones) 
{
	var salida="";
	parrafos = intercambiar_frases(parrafos);
	salida = pegar_en_orden (parrafos,generar_orden (parrafos.length, excepciones));
	salida = ponerConjunciones(salida); 
	salida = poner_string_char(salida,"\n","<BR>");
	return salida;
}

/*
*  EJEMPLO CON MEGACITY BLUES
*
*
*

<body>
<script language="JavaScript">
      <!--
                       
var estribillo = new Array ("]Todo tiene precio y todo tiene dueño.[-",
                          "]Cuatrocientos millones de habitantes viviendo apiñados en la gran ciudad. Adonde quiera que mires hay gente, mucha gente. Pero todo tiene precio y todo tiene dueño.[-",
                          "]La ciudad ha crecido más allá de cualquier horizonte. No la hemos hecho nosotros, se ha construido a sí misma y nos ha encerrado en su interior.[-",
                          "]Y todo tiene precio y todo tiene dueño.\n[-",
                          "]A los nadie, a los ninguno, los encerramos en ¨ghetos¨ para que se maten entre ellos.[-",
                          "]A los de clase alta los encerramos  en grandes avenidas para que se despojen unos a otros.[-",
                          "]Porque todo tiene precio y todo tiene dueño.[-",
                          "]Y cuando la ciudad cubra el mundo entero ya veremos, yeah.[-",
                          "]Cuando la ciudad se quede sin nada nos comerá a nosotros.[-",
                          "]Así es, todo tiene precio y todo tiene dueño.\n[-", 
                          "]Menos la gente... la gente no vale nada.\n[-");

                          
var versos = new Array ("]Si compras una caja de condones, te regalamos una chica asiática.[-",
                          "]Cuando compras  una Macdonald, el niño africano que la sirve es una regalía. Dos cuadras después lo abandonas y se queda con ojos de perro callejero.[-",
                          "]Si compras un periódico, te damos a un intelectual. Te aseguramos que siempre tendrá los puntos de vista que tú quieras.[-",
                          "]Las aspiradoras vienen con gordas que las manejan.[-",
                          "]Las grabadoras traen encadenado a un músico.[-");
                          

var anclados = new Array();
var orden = new Array();
var salida1="",
     salida2="",
     salida3="";
var index;

anclados[0]=0;
anclados[1]=3;
anclados[2]=6;
anclados[3]=9;
anclados[4]=10;

estribillo = intercambiar_frases(estribillo);
orden = generar_orden (estribillo.length, anclados);

for (index=0; index < 4; index++)
  salida1 = salida1+estribillo[orden[index]];
salida1 = ponerConjunciones(salida1); 
salida1 = poner_string_char(salida1,"\n","<BR>");
	
for (; index < 11; index++)
  salida3 = salida3+estribillo[orden[index]];
salida3 = ponerConjunciones(salida3); 
salida3 = poner_string_char(salida3,"\n","<BR>");

versos = intercambiar_frases(versos);
orden = generar_orden (versos.length, new Array());

for (index=0; index < 5; index++)
   salida2 = salida2 + versos[orden[index]];
salida2 = ponerConjunciones(salida2); 
   
document.write (salida1+salida2+"<BR>"+salida3);
-->
</script>
</body>

*/