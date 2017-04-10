<?php
include "generador_biblioteca.php";

$ejercicio = recoge("ejercicio");
$html = recogeMatriz("html");
$css = recogeMatriz("css");

$ejercicioOk = false;
$cssOk = false;
$htmlOk = false;

// print "<pre>\n"; print_r($_REQUEST); print "</pre>\n";

unset($_SESSION["error"]);
unset($_SESSION["ejercicio"]);
unset($_SESSION["html"]);
unset($_SESSION["css"]);

// Comprobación del ejercicio elegido

if ($ejercicio == "") {
  $_SESSION["error"] = "No ha elegido ningún ejercicio. Por favor, elija un ejercicio e inténtelo de nuevo.";
} elseif (!is_dir($ejercicio)) {
  $_SESSION["error"] = "Nombre de ejercicio incorrecto. Por favor, elija un ejercicio e inténtelo de nuevo.";
} else {
  $ejercicioOk = true;
}

if ($ejercicioOk) {
  $_SESSION["ejercicio"] = $ejercicio;
}

// Comprobación de los grupos HTML elegidos
if ($ejercicioOk) {
  $htmlOk = true;
  $gruposHtmlNombre = array_column($gruposHtml, 0);
  foreach($html as $grupoHtml => $valor) {
    if (!in_array($grupoHtml, $gruposHtmlNombre)) {
      $_SESSION["error"] = "Nombre de grupo de etiquetas HTML incorrecto. Por favor, elija los grupos de etiquetas HTML e inténtelo de nuevo.";
      $htmlOk = false;
    }
  }
}

if ($htmlOk) {
  $_SESSION["html"] = $html;
}

// Comprobación de los grupos CSS elegidos
if ($ejercicioOk) {
  if (!count($css)) {
    $_SESSION["error"] = "No ha elegido ningún grupo de propiedades CSS. Por favor, elija algún grupo de propiedades CSS e inténtelo de nuevo.";
  } else {
    $cssOk = true;
    $gruposCssNombre = array_column($gruposCss, 0);
    foreach($css as $grupoCss => $valor) {
      if (!in_array($grupoCss, $gruposCssNombre)) {
        $_SESSION["error"] = "Nombre de grupo de propiedades CSS incorrecto. Por favor, elija los grupos de propiedades CSS e inténtelo de nuevo.";
        $cssOk = false;
      }
    }
  }
}

if ($cssOk) {
  $_SESSION["css"] = $css;
}

// Una vez los datos comprobados ...

if (!$ejercicioOk || !$cssOk || !$htmlOk) {
  header("Location:$paginaInicio");
  exit();
} else {
  header("Location:generador_ejercicio.php");
  exit();
}
?>
