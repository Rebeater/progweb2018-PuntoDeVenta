<?php
session_start();
if(isset($_SESSION['logged'])){
    switch ($_SESSION['puesto']) {
        case 'Supervisor':
        header("location: Supervisor");    
            break;
        case 'Administrador':
        header("location: mantenimiento_Usuarios");
            break;
        case 'Caja':
            header("location: Cajero");
            break;
        case 'Ventas':
            header("location: Vendedor");
            break;
        default:
            break;
    }
}
else {
    header("location: login");        
}

foreach ($_SESSION as $value) {
    echo $value;
}
?>
<h1>Index</h1>
