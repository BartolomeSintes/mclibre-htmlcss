<?php
session_name("generador_ejercicios");
session_start();
header("Content-type: text/css");
print $_SESSION["pagina_css"];
?>
