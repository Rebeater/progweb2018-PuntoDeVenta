<?php
session_start();
if(isset($_SESSION['logged'])){

        
}
else {
    header("location: login");        
}

?>