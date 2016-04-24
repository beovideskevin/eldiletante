// JavaScript Document
// Example: obj = findObj("image1");
function findObj(theObj, theDoc)
{
  var p, i, foundObj;
  
  if(!theDoc) theDoc = document;
  if( (p = theObj.indexOf("?")) > 0 && parent.frames.length)
  {
    theDoc = parent.frames[theObj.substring(p+1)].document;
    theObj = theObj.substring(0,p);
  }
  if(!(foundObj = theDoc[theObj]) && theDoc.all) foundObj = theDoc.all[theObj];
  for (i=0; !foundObj && i < theDoc.forms.length; i++) 
    foundObj = theDoc.forms[i][theObj];
  for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++) 
    foundObj = findObj(theObj,theDoc.layers[i].document);
  if(!foundObj && document.getElementById) foundObj = document.getElementById(theObj);
  
   return foundObj;
}

function showHideLayers() { //v6.0
  var i,p,v,obj,args=showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
     if ((obj=findObj(args[i]))!=null) { 
	   v=args[i+2];
       if (obj.style) { 
	     obj=obj.style; 
		 v=(v=='show')?'inline':(v=='hide')?'none':v; 
	   }
       obj.display=v; 
	 }
}

function swapImage() { //v3.0
var i,j=0,x,a=swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function swapImgRestore() { //v3.0
var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function AbrirVentana(url, idVentana, scrollBar, ancho, alto)
{
var nuevaVentana=open(url,idVentana,'toolbar=no,directories=no,menubar=no,status=no,resizable=yes,width='+ancho+',height='+alto+',scrollbars='+scrollBar);
nuevaVentana.focus();
}

function AbrirCuento (nombre) {
        var w = Math.round((900-1)*Math.random()),h = Math.round((700-1)*Math.random()),t = Math.round((700-1)*Math.random()),l = Math.round((900-1)*Math.random());
        open(nombre+'.html','','toolbar=no,directories=no,menubar=no,status=no,resizable=yes,width='+((w<450)?450:w)+',height='+((h<350)?350:h)+',scrollbars=yes,top='+t+',left='+l);
}

function irapagina (i)
{
  window.location = direccion[i];
}

/***************
*
*
*
*
*  child y phater son contrarios, si se muestra uno se esconde el otro.
*
***************/

function outliner(img_obj) 
{
  
   var child = findObj(img_obj.getAttribute("child",false));
   var phater = findObj(img_obj.getAttribute("phater",false));
 
   if (null != child)
     if (child.className == "collapsed") {
       child.className="expanded";
       phater.className="collapsed";
     }else{
       child.className="collapsed";
       phater.className="expanded";    
     }
}

function outliner_sin_hide(img_obj)
{
   var child = findObj(img_obj.getAttribute("child",false));
   if (null != child)
     if (child.className == "collapsed") {
       child.className="expanded";
     }else{
       child.className="collapsed";
     }
}

function turnvisible (img_obj) 
{
	var child = findObj(img_obj.getAttribute("child",false));
    if (null != child)
      if (child.className == "invisible") {
        child.className="visible";
      }else {
        child.className="invisible";
      }

}

/*******
*
* Las funciones que vienen ahorta son para resaltar subtextos, destaca y fixonoff
* se usan como se muetra en este pedazo de texto:
*
*     <span id="frase_a0" onClick="fixonoff('frase_a')" onMouseOut="destaca('bold','#dddddd','transparent','frase_a')" 
*  onMouseOver="destaca ('bolder','#996699','#99ff99','frase_a')">La agricultura org&aacute;nica</span> es
*	              un sistema
* que	<span id="frase_a1" onClick="fixonoff('frase_a')" onMouseOut="destaca('bold','#dddddd','transparent','frase_a')" 
*  onMouseOver="destaca ('bolder','#996699','#99ff99','frase_a')">promueve</span> la
* obtenci&oacute;n de alimentos, fibras y madera <span id="frase_b0" onClick="fixonoff('frase_b')" onMouseOut="destaca('bold','#dddddd','transparent','frase_b')" 
*  onMouseOver="destaca ('bolder','#996699','#99ff99','frase_b')">desde 
* un punto de vista ambiental , econ&oacute;mico y social</span>, m&aacute;s sano
* y sostenible, ya que evita <span id="frase_a2" onClick="fixonoff('frase_a')" onMouseOut="destaca('bold','#dddddd','transparent','frase_a')" 
*  onMouseOver="destaca ('bolder','#996699','#99ff99','frase_a')">el</span> uso
* de fertilizantes sint&eacute;ticos , pesticidas y f&aacute;rmacos qu&iacute;micos.<br />
*
* destaca (ancho del font, color de letra, color de fondo o transparent, patron de la frase)
* si el color de fondo o el ancho no quieren ser cambiados, se pasa la cadena ''.
*
* fixonoff (patron de la frase) 
********/

var fixed = "";

function fixonoff(value)  
{
  if (value==fixed) {
    fixed="";
  }else {
    if (fixed=="") {
  	  fixed=value;
	}else { ;
	}
  }
}

function destaca (ancho,color,bgcolor,patron)
{
  var i = 0;
  if (fixed=="") {
  do {
    obj_span=findObj(patron+i);
    obj_span.style.color=color;
    if (bgcolor)
	  obj_span.style.background=bgcolor;	
	if (ancho) 
      obj_span.style.fontWeight=ancho; 
	i++;
  }while(findObj(patron+i)); 
  }
}
