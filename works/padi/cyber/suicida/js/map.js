// estas son las escenas
var map = {
	// cuarto
	'cuarto' : {
		'name' : '<p><u>Frente a la cama</u></p>',
		'description' : '<p>Tony yace muerto. Hay sangre por todas partes. Tu primer impulso es vomitar. Las arqueadas se suceden como mareas, \n\
						y todo tu cuerpo se contrae con los embates. Pero logras contenerte. El sabor ácido en la garganta te produce náuseas y piensas, \n\
						en un instante que dura lo que el fogonazo de un disparo, que tendrás que lidiar con ese sabor el resto del día.</p> <p>Vuelves \n\
						a mirar a la cama donde yace el cadáver. Hay sangre por todas partes. El orificio de la bala es visible y "como del grosor de un \n\
						dedo", calculas de pasada. Sientes el impulso, la curiosidad brutal e instintiva, pero no te atreves a ver el otro lado del rostro. \n\
						Sospechas que no queda más que un volcán de piel y carne. No quieres ver eso.</p> <p>Apartas la vista de la cama y la paseas por el \n\
						cuarto. Inspeccionas todo sin detenerte en nada. A tu alrededor se despliega el mundo de Tony. Algo en este inmenso reguero debe \n\
						explicar qué ha pasado, quién hizo esto... Pero la penumbra, como un velo de dudas, lo envuelve todo. Apenas unos rayos de luz entran \n\
						por la ventana y caen, como redondeles del tamaño de monedas, en el suelo. "Como a través de agujeros de bala", aflora en tu mente. \n\
						Sobrecogido e incrédulo examinas el origen del haz. No hay agujeros de bala, sino varias rendijas entre las dos hojas de la ventana.</p>\n\
						<p>A tu izquierda hay una mesita de noche. Sobre la misma descansan varios objetos: una lámpara, un teléfono celular y algunos \n\
						papeles sueltos. </p>',
		'exits' : {
			'librero' : ['librero', true],
			'closet' : ['closet', true],
			'sala' : ['sala', true]
		},
		'items' : {
			'mesita' : items['mesita'],
			'lampara' : items['lampara'],
			'telefono' : items['telefono'],
			'ventana' : items['ventana'],
			'sangre' : items['sangre'],
			'tony' : items['tony'],
			'papeles' : items['papeles']
		},
		'commands' : [
			'ir librero', 
			'ir closet', 
			'ir sala'
		]
	},
	
	// cuarto: closet
	'closet' : {
		'name' : '<p><u>Frente al closet</u></p>',
		'description' : '.',
		'exits' : {
			'cama' : ['cuarto', true],
			'librero' : ['librero', true],
			'sala' : ['sala', true]
		},
		'items' : {
			'pantalones' : items.pantalones,
			'camisa azul' : items['camisa azul']
		},
		'commands' : [
			'ir cama', 
			'ir librero', 
			'ir sala'
		]
	},
	
	// cuarto: librero
	'librero' : {
		'name' : '<p><u>Frente al librero</u></p>',
		'description' : '.',
		'exits' : {
			'cama' : ['cuarto', true],
			'closet' : ['closet', true],
			'sala' : ['sala', true]
		},
		'items' : {},
		'commands' : [
			'ir cama', 
			'ir closet', 
			'ir sala'
		]
	},
	
	// sala 
	'sala' : {
		'name' : '<p><u>En la sala de la casa</u></p>',
		'description' : '<p>La sala luce descuidada. Hay un sofa destartalado y una mesita de centro con el cristal rajado. Un televisor descansa sobre \n\
						una silla de madera en una esquina. En el piso hay periódicos regados, con salpicaduras de pintura. "No es del color de la paredes".</p>',
		'exits' : {
			'cuarto' : ['cuarto', true],
			'cocina' : ['cocina', true],
			'baño' : ['baño', true],
			'umbral' : ['umbral', true]
		},
		'items' : {
			'tv': items.tv,
			'periodicos': items.periodicos
		},
		'commands' : [
			'ir cuarto', 
			'ir cocina', 
			'ir baño', 
			'ir umbral', 
			'empujar periodicos',
			'leer periodicos',
			'encender tv',
			'apagar tv'
		]
	},
	
	// bano
	'baño' : {
		'name' : '<p><u>En el baño</u></p>',
		'description' : '.',
		'exits' : {
			'sala' : ['sala', true]
		},
		'items' : {
		},
		'commands' : [
			'ir sala'
		]
	},
	
	// cocina
	'cocina' : {
		'name' : '<p><u>En la cocina</u></p>',
		'description' : '.',
		'exits' : {
			'sala' : ['sala', true],
			'patio' : ['patio', true]
		},
		'items' : {
		},
		'commands' : [
			'ir sala', 'ir patio'
		]
	},
	
	// patio
	'patio' : {
		'name' : '<p><u>En el patio</u></p>',
		'description' : '.',
		'exits' : {
			'cocina' : ['cocina', true]
		},
		'items' : {
		},
		'commands' : [
			'ir cocina'
		]
	},
	
	// umbral
	'umbral' : {
		'name' : '<p><u>En el umbral de la casa</u></p>',
		'description' : '.',
		'exits' : {
			'sala' : ['sala', true]
		},
		'items' : {
		},
		'commands' : [
			'ir sala'
		]
	},
	
	// just fucking with people
	'pinga': {
		'name' : '<p><u>En casa de la pinga</u></p>',
		'description' : 'Estás en casa de la pinga. Como podrás notar sólo hay graciosos como tú. Espero que te sientas como en casa.',
		'exits' : {
			'carajo' : ['carajo', true]
		},
		'commands' : [
			'ir carajo'
		]
	},
	'carajo': {
		'name' : '<p><u>En el carajo</u></p>',
		'description' : 'Estás en el carajo. Hasta donde alcanza la vista sólo hay tarados como tú. Nunca te vas a sentir solo.',
		'exits' : {
			'pinga' : ['pinga', true]
		},
		'commands' : [
			'ir pinga'
		]
	}
	
};
