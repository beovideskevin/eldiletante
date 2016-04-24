
// estas son las escenas
var map={
	'cama' : {
		'name' : '<p><u>Frente a la cama.</u></p>',
		'description' : '<p>Tony yace muerto. Hay sangre por todas partes. Tu primer impulso es vomitar. Las arqueadas se suceden como mareas, y todo tu cuerpo se contrae con los embates. Pero logras contenerte. El sabor ácido en la garganta te produce náuseas y piensas, en un instante que dura lo que el fogonazo de un disparo, que tendrás que lidiar con ese sabor el resto del día.</p> <p>Vuelves a mirar a la cama donde yace el cadáver. Hay sangre por todas partes. El orificio de la bala es visible y “como del grosor de un dedo”, calculas de pasada. Sientes el impulso, la curiosidad brutal e instintiva, pero no te atreves a ver el otro lado del rostro. Sospechas que no queda más que un volcán de piel y carne. No quieres ver eso.</p> <p>Apartas la vista de la cama y la paseas por el cuarto. Inspeccionas todo sin detenerte en nada. A tu alrededor se despliega el mundo de Tony. Algo en este inmenso reguero debe explicar qué ha pasado, quién hizo esto... Pero la penumbra, como un velo de dudas, lo envuelve todo. Apenas unos rayos de luz entran por la ventana y caen, como redondeles del tamaño de monedas, en el suelo. “Como a través de agujeros de bala”, aflora en tu mente. Sobrecogido e incrédulo examinas el origen del haz. No hay agujeros de bala, sino varias rendijas entre las dos hojas de la ventana.</p> <p>A tu izquierda hay una mesita de noche. Sobre la misma descansan varios objetos: una lámpara, un teléfono celular y algunos papeles sueltos. </p>',
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
		}
	},
	'librero' : {
		'name' : '<p><u>Frente al librero.</u></p>',
		'description' : '.',
		'exits' : {
			'cama' : ['cama', true],
			'closet' : ['closet', true]
		},
		'items' : {}
	},
	'closet' : {
		'name' : '<p><u>Frente al closet.</u></p>',
		'description' : '.',
		'exits' : {
			'cama' : ['cama', true],
			'librero' : ['librero', true]
		},
		'items' : {
			'pantalones' : items.pantalones,
			'camisa azul' : items['camisa azul']
		}
	},
	'sala' : {
		'name' : '<p><u>En la sala de la casa.</u></p>',
		'description' : '.',
		'exits' : {
			'cama' : ['cama', true],
			'cocina' : ['cocina', true],
			'baño' : ['baño', true],
			'umbral' : ['umbral', true]
		},
		'items' : {
		}
	},
	'baño' : {
		'name' : '<p><u>En el baño.</u></p>',
		'description' : '.',
		'exits' : {
			'sala' : ['sala', true]
		},
		'items' : {
		}
	},
	'cocina' : {
		'name' : '<p><u>En la cocina.</u></p>',
		'description' : '.',
		'exits' : {
			'sala' : ['sala', true],
			'patio' : ['patio', true]
		},
		'items' : {
		}
	},
	'patio' : {
		'name' : '<p><u>En el patio.</u></p>',
		'description' : '.',
		'exits' : {
			'cocina' : ['cocina', true]
		},
		'items' : {
		}
	},
	'umbral' : {
		'name' : '<p><u>En el umbral de la casa.</u></p>',
		'description' : '.',
		'exits' : {
			'sala' : ['sala', true]
		},
		'items' : {
		}
	}
};
