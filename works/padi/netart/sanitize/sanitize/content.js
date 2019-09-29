const names = [
	"Marx", "Karl", "Friedrich", "Frederich", "Engels", 
	"Lenin", "Vladimir", "Joseph", "Josef", "Stalin", "Zedong", "Mao", "Leon", "Trotsky", "Alexander", "Dubček", 
	"Kim", "Jong-il", "Leonid", "Ilyich", "Brezhnev", "Kim", "il", "Sung", "Mengistu", "Haile", "Mariam",
	"Pol", "Pot", "Adolf", "Hitler", "Benito", "Mussolini",
	"Rosa", "Luxemburg", "Slavoj", "Žižek", "Antonio", "Gramsci", "Nikita", "Khrushchev",
	"Fidel", "Raul", "Raúl", "Castro", "Miguel", "Díaz", "Diaz", "Canel", "Ernesto", "Che", "Guevara", "Hugo", "Chávez", "Chavez", "Nicolás", "Nicolas", "Maduro"
];
let body = document.body.innerHTML;
names.forEach((item, index) => {
	regex = new RegExp('(?![^<>]*>)\\b' + item + '\\b', 'gi');
	body = body.replace(regex, "<span style='color:#000 !important; background-color:#000 !important'>" + item + "</span>");
});
document.body.innerHTML = body;
