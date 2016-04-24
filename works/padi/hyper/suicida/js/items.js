// estos son los objetos
var items = {
	'telefono' : {
		'description' : '<p>Sobre la mesa de noche, abierto descuidadamente,  ves el celular de Tony. Es un modelo pasado de moda. En la época de los teléfonos inteligentes, este se te antoja como particularmente arcaico. “Bueno para llamar y nada más”, piensas.</p> ',
		'movable' : true,
		'state' : 'mesita',
		'actions' : {
			'turnon' : function () {
				if (items['telefono'].state == 'encendido') {
					return '<p>El teléfono ya está encendido.</p>';
				}
				else if (items['telefono'].state == 'suelo') {
					return '<p>Primero deberías recogerlo del suelo.</p>';
				}
				else if (items['telefono'].state == 'mesita') {
					return '<p>Primero deberías cogerlo de la mesa.</p>';
				}
				items['telefono'].state = 'encendido';
				items['telefono'].description = messages.telefono_encendido; 
				return '<p>La música de inicio te recuerda vagamente a los video-juegos de los ochenta.</p>';
			},
			'turnoff': function() {
				if (items['telefono'].state == 'apagado') {
					return '<p>El teléfono ya está apagado.</p>';
				}
				else if (items['telefono'].state == 'suelo') {
					return '<p>Primero deberías recogerlo del suelo.</p>'; 
				}
				else if (items['telefono'].state == 'mesita') {
					return '<p>Primero deberías cogerlo de la mesa.</p>';
				}
				items['telefono'].state = 'apagado';
				items['telefono'].description = messages.telefono_apagado;
				return '<p>La pantalla del teléfono se torna negra.</p>';
			},
			'take' : function () {
				if (items['telefono'].state == 'suelo') {
					items['telefono'].state = 'encendido';
					items['telefono'].description = messages.telefono_encendido; 
					inv['telefono'] = map[loc].items['telefono'];
					delete map[loc].items['telefono'];
					invcount++;
					delete map[loc].items['piezas'];
					map['cama'].description = map['cama'].description.replace(messages.telefono_map_description, '');
					return '<p>Recoges las partes, te arrodillas y alcanzas la batería. Enciendes el teléfono. La música de inicio te recuerda vagamente a los video-juegos de los ochenta.</p>';
				}
				else if (items['telefono'].state == 'mesita') {
					items['telefono'].state = 'suelo';
					items['telefono'].description = messages.telefono_roto;
					map['cama'].description = map['cama'].description.replace(', un teléfono celular', '');
					map['cama'].description += messages.telefono_map_description; 
					map['cama'].items['piezas'] = items['piezas'];
					return "<p>El teléfono se cae al suelo. Se desarma en piezas. La batería rueda debajo de la cama.</p>";
				}
			},
			'drop' : function () {
				return '<p>Observas el teléfono detenidamente. Decides que no vas a dejarlo aquí.</p>';	
			}
		}
	},
	'piezas' : {
		'movable' : true,
		'actions' : {
			'take' : function () { 
				return items['telefono'].actions.take(); 
			}
		}
	},
	'mesita' : {
		'description' : '<p>La madera parece vieja. Ahora que piensas en ello, todos los muebles de la casa parecen heredados. El barniz deja ver la historia de abusos y descuidos a que han sido sometidos. “Las cosas de antes se hacían para durar”, la idea cruza tu mente.</p> ',
		'movable' : false,
		'actions' : {}
	},
	'lampara' : {
		'description' : '<p>Una lámpara negra, cubierta por una visible capa polvo, descansa sobre la mesita de noche. “Todo en esta casa está lleno de polvo”,  observas. Aparentemente, Tony nunca se tomó el trabajo de limpiar durante los... ¿cuántos? ¿10 años que vivió en este lugar?</p> ',
		'movable' : false,
		'state' : 'apagada',
		'actions' : {
			'turnon' : function () {
				if (items['lampara'].state == 'encendida') {
					return '<p>La lámpara ya está encendida.</p>';
				}
				items['lampara'].state = 'encendida';
				//items['lampara'].description = '<p>.</p>'; // messages.lampara_encendida; 
				map['cama'].items['llave'] = items['llave'];
				map['cama'].description = map['cama'].description.replace('algunos papeles sueltos. </p>', 'algunos papeles sueltos. ' + messages.llave_map + ' </p>');
				return '<p>Un círculo de luz cae con desgano. El bombillo vacila, titila varias veces, y luego vuelve a su poca gloria. Algo brilla, parcialmente oculto debajo de los papeles, no lo habías notado antes: es una llave. </p>';
			},
			'turnoff' : function() {
				if (items['lampara'].state == 'apagada') {
					return '<p>La lámpara ya está apagada.</p>';
				}
				items['lampara'].state = 'apagada';
				//items['lampara'].description = '<p>.</p>'; // messages.lampara_apagada;
				delete(map['cama'].items['llave']);
				map['cama'].description = map['cama'].description.replace('algunos papeles sueltos. ' + messages.llave_map + ' </p>', 'algunos papeles sueltos. </p>');
				return '<p>El cuarto regresa a la oscuridad anterior.</p>';
			}
		}
	},
	'papeles' : {
		'description' : '<p>Un montón notas sin sentido y varias listas de compras. No ves nada interesante.</p> ',
		'movable' : false,
		'actions' : {}
	},
	'ventana' : {
		'description' : '<p>Las hojas de la ventana están clavadas al marco. Aquí y allá las cabezas de clavo dobladas contra la madera o enterradas de lado, prueban que los martillazos cayeron sin precisión. “Con poca maña”, piensas y te detienes a ponderar que podría significar esto, porque Tony, sin llegar a ser un maestro, le sabía algo a la carpintería. </p>',
		'movable' : false,
		'state' : 'cerrada',
		'actions' : {
			'open' : function () {
				return '<p>No puedes. Esta clausurada. Necesitarías algunas herramientas para abrir la ventana.</p> ';
			}
		}
	},
	'sangre': {
		'description' : '<p>La sangre no está coagulada del todo. Un poco aun luce roja en los lugares donde se aposentó.</p> ',
		'movable' : true,
		'actions' : {
			'take' : function () { 
				return "<p>Eww! Te da demasiado asco.</p>";
			}
		}
	},
	'tony': {
		'description' : '<p>.</p> ',
		'movable' : false,
		'actions' : {}
	},
	'pantalones' : {
		'description' : '.',
		'movable' : false,
		'actions' : {}
	},
	'camisa azul' : {
		'description' : '.',
		'movable' : false,
		'actions' : {}
	},
	'llave': {
		'description' : '<p>Una llave gastada y vieja, pero no tanto como para que deje de ser vulgar.</p>',
		'movable' : true,
		'actions' : {
			'take' : function () {
				inv['llave'] = map[loc].items['llave'];
				delete map[loc].items['llave'];
				invcount++;
				map['cama'].description = map['cama'].description.replace(messages.llave_map, '');
				return '<p>Detenidamente, recoges la llave y la pones en tu bolsillo. Te preguntas qué puerta abrirá. </p>';	
			},
			'drop' : function () {
				return '<p>Observas la llave detenidamente. Decides que no vas a dejarla aquí.</p>';	
			},
			'use' : function (){
				if (loc == 'patio'){
					if (map['patio'].exits.closet) {
						map['patio'].exits.closet[1] = true;
						return "<p>La puerta del closet se abre y una avalancha de tarecos cae a tus pies.</p> ";
					}
					else {
						map['patio'].exits.closet[1] = false;
						return "<p>Empujas como puedes las cosas dentro del closet y cierras la puerta.</p> ";
					}
				}
				else {
					return "<p>La llave no parece que funcione aquí.</p> ";
				}
			}
		}
	}
};
