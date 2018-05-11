<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn_prevUsr_logout'])){
            header("Location: logout.php"); 
        }
    }
?>