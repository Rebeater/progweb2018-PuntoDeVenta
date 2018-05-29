<?php
    session_start();
    
    include_once("Clases/usuario.php");        
    include_once("Clases/validaciones.php");    
    include_once("smsup/smsuplib.php");
    $valida = new validaciones();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {    
        if(isset($_POST['btn-recuperar'])){    
            $usuario = $valida->test_input($_POST['email']);
            $usr = new usuario();
            $user = $usr->validarExistenciaUsuario($usuario);
            if($usr != ""){
                $s = new smsup\smsuplib('22fa24052582a4e0d9e242d34d924755', 'a068a4614ca4add5e63ebc944b8c8d205d5efcd2');
                $resul = '';
                
                $token = generarKey();
                $_SESSION['token'] = $token;
                $texto = "Codigo de verificacion: ".$token;
                $numeros = array("+52 ".$user['telefono']);
                $referencia = "";
                $remitente = '';
                $codificacion = 'GSM';
                //DESCOMENTAR ESTA LINEA PARA ENVIAR MENSAJE SI ESTA COMENTADA USAR PARA PRUEBA EL TOKEN GENERADO EN LA BASE DE DATOS EN LA TABLA USARIO.
                //$resul = json_encode($s->NuevoSMS($texto, $numeros, '', $referencia, $remitente, $codificacion), JSON_PRETTY_PRINT);
                
                //if($resul['httpcode'] == 200){
                    $usr->updateCampo($user['id'],"token", $token);
                    header("location: paso1");  
                //}
            }

        } else if(isset($_POST['btn-siguiente'])){    
            $token1 = $valida->test_input($_POST['code1']);
            $token2 = $valida->test_input($_POST['code2']);
            $token3 = $valida->test_input($_POST['code3']);
            $token4 = $valida->test_input($_POST['code4']);

            $token = $token1.$token2.$token3.$token4;
            if(validarTokenSession($token)){
                //Validamos en la BD
                $usr = new usuario();
                $v = ($usr->validarToken($token));
                if($v['valido']){
                    $usr->updateCampo($v['usuario'],"token", "");  //borrar token
                    echo "Enviando Correo..";
                    //Enviar Correo Aqui
                    //redirigir a pantalla paso2 : avisar que cheke su correo.
                } else if ($v['respuesta'] == 'Se agoto el tiempo'){
                    echo "Token expirado";                    
                }
            }
            else{
                echo isset($_SESSION['token'])? (($_SESSION['token']==$token)? true: "Token incorrecto" ) :"Token expirado" ;
            }
        }
    }


    function validarTokenSession($token){
        return isset($_SESSION['token'])?(($_SESSION['token']==$token)? true: false) : false;
    }

    function validarTokenBD($token){
        
    }

    function enviarCorreo(){

    }
    function generarKey(){
        $token1 = rand(0,9);
        $token2 = rand(0,9);
        $token3 = rand(0,9);
        $token4 = rand(0,9);

        return $token1.$token2.$token3.$token4;
    }

?>