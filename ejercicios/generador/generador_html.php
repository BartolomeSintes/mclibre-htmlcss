<?php
session_name("generador_ejercicios");
session_start();

// print"<pre>"; print_r($_SESSION); print"</pre>";
print $_SESSION["pagina_html"];
?>
