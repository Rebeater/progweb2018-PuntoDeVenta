$(document).ready(function(){

	// MOSTRANDO Y OCULTANDO MENU
	$('#button-menu').click(function(){
		if($('#button-menu').attr('class') == 'fa fa-bars' ){

			$('.navegacion').css({'width':'100%', 'background':'rgba(0,0,0,.5)'}); // Mostramos al fondo transparente
			$('#button-menu').removeClass('fa fa-bars').addClass('fa fa-times'); // Agregamos el icono X
			$('.navegacion .menu').css({'left':'0px'}); // Mostramos el menu

		} else{

			$('.navegacion').css({'width':'0%', 'background':'rgba(0,0,0,.0)'}); // Ocultamos el fonto transparente
			$('#button-menu').removeClass('fa fa-times').addClass('fa fa-bars'); // Agregamos el icono del Menu
			$('.navegacion .submenu').css({'left':'-320px'}); // Ocultamos los submenus
			$('.navegacion .menu').css({'left':'-320px'}); // Ocultamos el Menu

		}
	});

	// MOSTRANDO SUBMENU
	$('.navegacion .menu > .item-submenu a').click(function(){
		
		var positionMenu = $(this).parent().attr('menu'); // Buscamos el valor del atributo menu y lo guardamos en una variable
		console.log(positionMenu); 

		$('.item-submenu[menu='+positionMenu+'] .submenu').css({'left':'0px'}); // Mostramos El submenu correspondiente

	});

	// OCULTANDO SUBMENU
	$('.navegacion .submenu li.go-back').click(function(){

		$(this).parent().css({'left':'-320px'}); // Ocultamos el submenu

	});

	$('.photo-prev').click(function(){
		$('#card-user').toggleClass("prevUserMostrar");
	});


	$("#btn_prevUsr_logout").click(function(){
		location.href = "logout.php";
	});

	$("#btn_prevUsr_help").click(function(){
		location.href = "help.php";
	});

	$("#btn_prevUsr_Cuenta").click(function(){
		location.href = "Perfil.php";
	});
	

});

function show_snackbar(msg){
	// Get the snackbar DIV
	var x = document.getElementById("snackbar");
			
	x.innerText  = msg;

	// Add the "show" class to DIV
	x.className = "show";

	// After 3 seconds, remove the show class from DIV
	setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}