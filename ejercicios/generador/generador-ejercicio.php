<?php
include "generador_biblioteca.php";

// Genera HTML
$ejercicio = $_SESSION["ejercicio"];

$texto = file_get_contents("$ejercicio/{$ejercicio}_formateado.html");

// sustituye enlace a css por enlace a generador_css.php
$texto = preg_replace("/$_SESSION[ejercicio].css/", "../generador_css.php", $texto);

if (!isset($_SESSION["html"]["titulos"])) {
  for ($i = 0; $i<=6; $i++) {
    $texto = preg_replace("/<h$i/", "<p", $texto);
    $texto = preg_replace("/<\/h$i/", "</p", $texto);
  }
}

$_SESSION["pagina_html"] = $texto;

// Genera CSS

$css = $_SESSION["css"];

$texto = file_get_contents("$ejercicio/{$ejercicio}.css");

// sustituye referencias a archivos añadiendo el nombre del directorio del ejercicio
$texto = preg_replace("/url\(\"/", "url(\"$ejercicio/", $texto);

// Elimina las propiedades de los grupos no elegidos por el usuario o elimina las marcas de grupos de propiedades elegidos por el usuario
foreach ($gruposCss as $indice => $valor) {
  if (!isset($css[$indice])) {
    $texto = preg_replace($gruposCss[$indice][2][0], "", $texto);
  } else {
    $texto = preg_replace($gruposCss[$indice][2][1], "", $texto);
    $texto = preg_replace($gruposCss[$indice][2][2], "", $texto);
  }
}

// CSS 2: Colores

if (!isset($_SESSION["css"]["colores"])) {
    $texto = preg_replace("/  background-color.+;/", "", $texto);
    $texto = preg_replace("/  color.+;/", "", $texto);
}

  // sustituye el nombre de color en las propiedades border, outline y text-shadow y los deja en negro

if (!isset($_SESSION["css"]["colores"])) {
  $texto = preg_replace("/border: (#?\w+) /", "border: black ", $texto);
  $texto = preg_replace("/border-color: (#?\w+);/", "border-color: black;", $texto);
  $texto = preg_replace("/border-(top|bottom|left|right): (#?\w+) /", "border-$1: black ", $texto);
  $texto = preg_replace("/border-(top|bottom|left|right)-color: (#?\w+);/", "border-$1-color: black;", $texto);

  $texto = preg_replace("/outline: (#?\w+) /", "outline: black ", $texto);
  $texto = preg_replace("/outline-color: (#?\w+);/", "outline-color: black;", $texto);

  $texto = preg_replace("/text-shadow: (#?\w+) /", "text-shadow: gray ", $texto);
}

// CSS 2: Fuente

if (!isset($_SESSION["css"]["fuente"])) {
    $texto = preg_replace("/  font-family.+;/", "", $texto);
    $texto = preg_replace("/  font-size.+;/", "", $texto);
    $texto = preg_replace("/  font-style.+;/", "", $texto);
    $texto = preg_replace("/  font-variant.+;/", "", $texto);
    $texto = preg_replace("/  font-weight.+;/", "", $texto);
    $texto = preg_replace("/  font:.+;/", "", $texto);
}

// CSS 2: Texto

if (!isset($_SESSION["css"]["texto"])) {
    $texto = preg_replace("/  direction.+;/", "", $texto);
    $texto = preg_replace("/  letter-spacing.+;/", "", $texto);
    $texto = preg_replace("/  line-height.+;/", "", $texto);
    $texto = preg_replace("/  text-align.+;/", "", $texto);
    $texto = preg_replace("/  text-decoration.+;/", "", $texto);
    $texto = preg_replace("/  text-indent.+;/", "", $texto);
    $texto = preg_replace("/  text-transform.+;/", "", $texto);
    $texto = preg_replace("/  text-shadow.+;/", "", $texto);
    $texto = preg_replace("/  unicode-bidi.+;/", "", $texto);
    $texto = preg_replace("/  vertical-align.+;/", "", $texto);
    $texto = preg_replace("/  white-space.+;/", "", $texto);
    $texto = preg_replace("/  word-spacing.+;/", "", $texto);
}

// CSS 2: Bordes

if (!isset($_SESSION["css"]["bordes"])) {
    $texto = preg_replace("/  border.+;/", "", $texto);
}

// CSS 2: Márgenes

if (!isset($_SESSION["css"]["margenes"])) {
    $texto = preg_replace("/  margin.+;/", "", $texto);
    $texto = preg_replace("/  padding.+;/", "", $texto);
}

// CSS 2: Fondos
// Nota: No incluye background-color, que lo quito en colores

if (!isset($_SESSION["css"]["bordes"])) {
    $texto = preg_replace("/  background:.+;/", "", $texto);
    $texto = preg_replace("/  background-attachment.+;/", "", $texto);
    $texto = preg_replace("/  background-image.+;/", "", $texto);
    $texto = preg_replace("/  background-position.+;/", "", $texto);
    $texto = preg_replace("/  background-repeat.+;/", "", $texto);
}

// Elimina las reglas vacías
$texto = preg_replace("/^(\w+([\.#:]?[-\w]+)* )+{[[:space:]]*}/m", "", $texto);
// $texto = preg_replace("/\w+\.(-?_?\w+)+ {[[:space:]]*}/s", "", $texto);
// $texto = preg_replace("/\w+#(-?_?\w+)+ {[[:space:]]*}/s", "", $texto);
// $texto = preg_replace("/\w+:(-?_?\w+)+ {[[:space:]]*}/s", "", $texto);
// $texto = preg_replace("/\w+ {[[:space:]]*}/s", "", $texto);

// Elimina líneas en blanco y añade una línea en blanco después de cada regla
$texto = preg_replace("/\n[[:space:]]*\n/s", "", $texto);
$texto = preg_replace("/}/", "}\n\n", $texto);

$_SESSION["pagina_css"] = $texto;

// Se mete en el directorio y muestra la página

//print"<pre>"; print_r($_SESSION["pagina_css"]); print"</pre>";
header("Location:$_SESSION[ejercicio]/index.php");
  exit();

?>
