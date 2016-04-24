
/****************************** fun stuff *************************************/

// los verbos asociados a funciones
var verbs={
	//
	'ayuda' : helpme,
	'?' : helpme,
	
	//
	'coger' : take,
	'recoger' : take,
	'tomar' : take,
	
	//
	'soltar' : drop,
	'dejar' : drop, 
	'tirar' : drop,
	
	//
	'empujar' : push,
	'presionar' : push,
	
	//
	'usar' : use,
	
	'encender' : turnon,
	
	'apagar' : turnoff,
	
	//
	'mirar' : look,
	'm' : look,
	'ver' : look,
	
	//
	'abrir' : open,
	
	//
	'cerrar' : close,
	
	//
	'inventario' : inventory,
	'i' : inventory,
	
	//
	'x' : leave,
	'irse' : leave,
	'salir' : leave,
	
	//
	'ir' : move,
	'caminar' : move
	
	/*
	'n' : move,
	's' : move,
	'e' : move,
	'w' : move,
	'u' : move,
	'd' : move
	*/
};

// estas on algunas abreviaciones para los nombres de los objetos
var aliases = {
	'camisa' : 'camisa azul',
	'celular' : 'telefono',
	'movil' : 'telefono',
	'móvil' : 'telefono',
	'bano' : 'baño'
}

// este es el interprete general
function interpret (txt) { 
	txt = txt.replace(/[^A-Za-z0-9?]/, ' ');
	txt = txt.toLowerCase(); //alert(" minisculas : " + txt );
	txt = makeSortString(txt); //alert(" remove accent : " + txt);
	txt = delete_keyword(txt); //alert("remove preposiciones : " + txt);
	for (i in aliases) {
		txt = txt.replace(i, aliases[i]);
	}
	var response = '';
	if (txt != "") {
		parts = txt.split(/\s+/);
		while ((part = parts.shift())) {
			if (verbs[part]) response = verbs[part]();
		}
		if (!response) response = '<p>Lo siento, no entendí. Para leer las reglas del juego puedes en cualquier momento escribir ayuda o ?.</p> ';	
	}	
	var out = document.createElement('div');
	out.style.width = "99%";
	out.innerHTML = response;
	scr.appendChild(out);
}

var makeSortString = (function () {
  var translate_re = /[áéíóúÁÉÍÓÚöäüÖÄÜ]/g;
  /*[ñÑáéíóúÁÉÍÓÚöäüÖÄÜ]*/
  var translate = {
    /*"ñ" : "n", "Ñ" : "N", */
    "á" : "a", "é" : "e", "í" : "i", "ó" : "o", "ú" : "u",
	"Á" : "A", "É" : "E", "Í" : "I", "Ó" : "O", "Ú" : "u",
    "ä" : "a", "ö" : "o", "ü" : "u",
    "Ä" : "A", "Ö" : "O", "Ü" : "U"   // probably more to come
  };
  return function (s) {
    return ( s.replace(translate_re, function (match) { 
      return translate[match]; 
    }) );
  }
}) ();

function delete_keyword (s) {
    var words = ['a', 'de', 'para', 'ante', 'desde', 'por', 'bajo', 'en', 'segun', 'cabe', 'entre', 'sin', 'con', 'hacia', 'so', 'contra', 'hasta', 'sobre', 'tras', 'la', 'el', 'mediante', 'al'];
    var re = new RegExp('\\b(' + words.join('|') + ')\\b', 'g');
    return (s || '').replace(re, '').replace(/[ ]{2,}/, ' ');
}

// estas son las acciones
function look () {
	var w = parts.shift();
	if (!w) {
		var r = '<br>' + map[loc].name + '' + map[loc].description + '';
		/*
		var it = '';
		for (i in map[loc].items) {
			if (!map[loc].items[i]) 
				alert('Objeto '+i+' no existe'); 
			else
				it += map[loc].items[i].description+'';
		}
		if(it) r += '<p>' + it + '</p>';
		*/
		it = '';
		for (i in map[loc].exits) {
			if (it != '') 
				it += ', ';
			it += i;
		}
		it += '.';
		if (it) r += '<p>Puedes ir a estos lugares: ' + it + '</p>';
		return r;
	}
	if (map[loc].items[w]) return map[loc].items[w].description;
	if (map[loc].exits[w]) return map[map[loc].exits[w][0]].name;
	if (inv[w]) return inv[w].description;
	return '<p>No ves nada especial.</p>';
}

function move () {
	w = parts.shift(); // added by me
	if (!w) return "<p>¿A dónde?</p>"
	if (!map[loc].exits[w]) {
		return "<p>No puedes ir.</p>";
	}
	if (!map[loc].exits[w][1]) {
		return "<p>Está cerrado.</p>";
	}
	loc = map[loc].exits[w][0];
	if (!map[loc]) {
		alert('El luegar: ' + loc + '; no existe.');
	}
	return look();
}

function leave () { 
	var c = 0;
	var e = '';
	for (var i in map[loc].exits) {
		e = i;
		c++;
	}
	if (c > 1) {
		return "<p>Hay más de una salida.</p>";
	}
	if (c == 0) {
		return "<p>Parece que estás atrapado.</p>";
	}
		
	if (!map[loc].exits[e]) {
		return "<p>No puedes ir.</p>";
	}
	if (!map[loc].exits[e][1]) {
		return "<p>Está cerrado.</p>";
	}
	loc = map[loc].exits[e][0];
	if (!map[loc]) {
		alert('El lugar: ' + loc + '; no existe.');
	}
	return look(); // map[loc].name;
}

function take () {
	var w = parts.join(' ');
	if (!w) return "<p>¿Agarrar qué?</p>";
	if (map[loc].items[w]) {
		if (!map[loc].items[w].movable) {
			return '<p>No puedes agarrar: ' + w + '.</p>';
		}
		else if (map[loc].items[w].actions.take) {
			return map[loc].items[w].actions.take();
		} 
		else if (invcount < invmax) {
			inv[w] = (map[loc].items[w]);
			delete map[loc].items[w];
			invcount++;
			return '<p>Agarraste: ' + w + ".</p>";				
		}
	}
	else if (inv[w]) {
		return '<p>Ya está en tu mano.</p>';
	}
	return '<p>No veo eso aquí.</p>';
}

function drop () {
	var w = parts.join(' ');
	if (!w) return "<p>¿Soltar qué?</p>";
	if (inv[w]) {
		if (inv[w].actions.drop) {
			return inv[w].actions.drop();
		} 
		else{
			map[loc].items[w] = inv[w];
			delete inv[w];
			invcount--;
			return '<p>Soltaste: ' + w + ".</p>";
		}
	}
	else {
		return '<p>No tienes: ' + w + '.</p>';
	}
}

function use () {
	var w = parts.join(' ');
	if (!w) return "<p>¿Usar qué?</p>";
	if (inv[w]) {
		if (!inv[w].actions.use) {
			return '<p>Nada pasa.</p>';
		}
		return inv[w].actions.use();
	}
	return '<p>No tienes: ' + w + '.</p>';
}

function push () {
	var w = parts.join(' ');
	if (!w) return '<p>¿Empujar qué?</p>';
	var item = false;
	if (map[loc].items[w]) {
		item = map[loc].items[w];
	}
	else if (inv[w]) {
		item = inv[w];
	}
	if (!item) {
		return '<p>No veo: ' + w + '; por aquí.</p>';
	}
	if (!item.actions.push) {
		return '<p>No puedes empujar: ' + w + '.</p>';
	}
	return item.actions.push();
}

function pull () {

}

function open () {
	var w = parts.shift();
	if (!w) return '<p>¿Abrir qué?</p>';
	var item = false;
	if (map[loc].items[w]) {
		item = map[loc].items[w];
	}
	else if(inv[w]) {
		item = inv[w];
	}
	if (!item) {
		return '<p>No veo: ' + w + '; por aquí.</p>';
	}
	if (!item.actions.open) {
		return '<p>No puedes abrir: ' + w + '.</p>';
	}
	return item.actions.open();
}

function close () {
	var w = parts.shift();
	if (!w) return '<p>¿Cerrar qué?</p>';
	var item = false;
	if (map[loc].items[w]) {
		item = map[loc].items[w];
	} 
	else if(inv[w]) {
		item = inv[w];
	}
	if (!item) {
		return '<p>No veo: ' + w + '; por aquí.</p>';
	}
	if (!item.actions.close) {
		return '<p>No puedes cerrar: ' + w + '.</p>';
	}
	return item.actions.close();
}

function turnon () {
	var w = parts.join(' ');
	if (!w) return '<p>¿Enceder qué?</p>';
	var item = false;
	if (map[loc].items[w]) {
		item = map[loc].items[w];
	}
	else if (inv[w]) {
		item = inv[w];
	}
	if (!item) {
		return '<p>No tengo ningún ' + w + ' a mano.</p>';
	}
	if (!item.actions.turnon) {
		return '<p>No puedes encender el ' + w + '.</p>';
	}
	return item.actions.turnon();
}

function turnoff () {
	var w = parts.join(' ');
	if (!w) return '<p>¿Apagar qué?</p>';
	var item = false;
	if (map[loc].items[w]) {
		item = map[loc].items[w];
	}
	else if(inv[w]) {
		item = inv[w];
	}
	if (!item) {
		return '<p>No tengo ningún ' + w + ' a mano.</p>';
	}
	if (!item.actions.turnoff) {
		return '<p>No puedes apagar el '+w+'.</p>';
	}
	return item.actions.turnoff();
}

function inventory() {
	var s = '';
	for (var i in inv) {
		s += inv[i].description + '';
	}
	if (s == '') 
		s = '<p>No tienes absolutamente nada.</p>'; 
	else 
		s = '<p>Tienes:</p>' + s;
	return s;
}

function talk () {

}

function helpme() {
	return "<br><p><u>Ayuda:</u></p><p>...</p>";
}