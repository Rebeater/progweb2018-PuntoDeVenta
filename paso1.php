<!DOCTYPE html>
<html lang="es">
<head>
  	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="no-cache" />
    <script src="js/jquery-3.3.1.min.js"></script>

	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<script src="js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="css/grid-login.css" >
    <title>Paso2</title>
</head>
<body>
<body style="background:#f1f1f1">
    <header style="height: 43px; background: #34495E;">
    </header>
        <form id="loginform" class="grid-container-paso1" role="form" action="procesa_recuperar.php" method="POST" autocomplete="off">
            <h4 id="title" >Autentificación de 2 pasos: Paso 1</h4>
            <p id="lblInstructions">Ingresa el codigo que enviamos a tu número celular</p>
            <div class="grid-container-inputs">
                <input  type="text"  class="form-control" id="code1" name="code1" placeholder="•" required autofocus maxlength="1">
                <input  type="text"  class="form-control" id="code2" name="code2" placeholder="•" required autofocus maxlength="1">
                <input  type="text"  class="form-control" id="code3" name="code3" placeholder="•" required autofocus maxlength="1">
                <input  type="text"  class="form-control" id="code4" name="code4" placeholder="•" required autofocus maxlength="1">
            </div>
            <button type="submit" class="form-control" id="btn-siguiente" name="btn-siguiente" >Siguiente</button>
            <div class="grid-container-linksBack">
                <a href="login.php" id="linkBack">Regresar</a> 
                <span id="reenviar1" style="text-align:right;">¿No has recibido tu código? <a href="recuperar.php"> Prueba de nuevo!</a> </span> 

                <a id="reenviar2" style="text-align:right;" href="recuperar.php">Reenviar codigo</a>
            </div>
        </form>
        
<script>
    function isnumber(e){
            var n = parseInt(e)
            return (n >= 0 && n <= 9 ) ? true : false;
    }
    function keyIsNumber(e){
        var a = (e.keyCode >= 48 && e.keyCode <= 57);
        var b = (e.keyCode >= 96 && e.keyCode <= 105);
        return ((e.keyCode >= 48 && e.keyCode <= 57) | (e.keyCode >= 96 && e.keyCode <= 105) ) ? true : false;        
    }

    $(document).ready(function() {
        code1= $('#code1');
        code2= $('#code2');
        code3= $('#code3');
        code4= $('#code4');
        btn = $('#btn-siguiente');
        code1.keyup(function(e){
            if(isnumber(code1.val())){
                if(keyIsNumber(e)){
                    code1.val(e.key);
                    code2.focus();
                }
            }
            else
                code1.val("")
        });
        code2.keyup(function(e){
            if(isnumber(code2.val())){
                if(keyIsNumber(e)){
                    code2.val(e.key);
                    code3.focus();
                }
            }
            else
                code2.val("")
        });
        code3.keyup(function(e){
            if(isnumber(code3.val())){
                if(keyIsNumber(e)){
                    code3.val(e.key);
                    code4.focus();
                }
            }
            else
                code3.val("")
        });
        code4.keyup(function(e){
            if(isnumber(code4.val())){
                if(keyIsNumber(e)){
                    code4.val(e.key);
                    btn.focus();
                }
            } 
            else
                code4.val("")
        });
    });
        
    </script>
</body>
</html>
