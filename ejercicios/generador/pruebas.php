<?php
/*
// Bordes
print "<h2>border</h2>\n";

$texto = "border: red 5px solid;\nborder: #ff0000 5px solid;\nborder-color: red;\nborder-color: #ff0000;\nborder-top: red 5px solid;\nborder-top: #ff0000 5px solid;\nborder-top-color: red;\nborder-top-color: #ff0000;";

print "<pre>$texto</pre>\n";

$texto = preg_replace("/border: (#?\w+) /", "border: black ", $texto);
$texto = preg_replace("/border-color: (#?\w+);/", "border-color: black;", $texto);
$texto = preg_replace("/border-(top|bottom|left|right): (#?\w+) /", "border-$1: black ", $texto);
$texto = preg_replace("/border-(top|bottom|left|right)-color: (#?\w+);/", "border-$1-color: black;", $texto);

print "<pre>$texto</pre>\n";

// Outline
print "<h2>outline</h2>\n";

$texto = "outline: red 5px solid;\noutline: #ff0000 5px solid;\noutline-color: red;\noutline-color: #ff0000;";

print "<pre>$texto</pre>\n";

$texto = preg_replace("/outline: (#?\w+) /", "outline: black ", $texto);
$texto = preg_replace("/outline-color: (#?\w+);/", "outline-color: black;", $texto);

print "<pre>$texto</pre>\n";

// text-shadow
print "<h2>text-shadow</h2>\n";

$texto = "text-shadow: red 5px -5px 2px;\ntext-shadow: #ff0000 5px -5px 2px;";

print "<pre>$texto</pre>\n";

$texto = preg_replace("/text-shadow: (#?\w+) /", "text-shadow: black ", $texto);

print "<pre>$texto</pre>\n";


// eliminar las reglas que no tienen propiedades
print "<h2>Reglas vacías</h2>\n";

$texto = "body {\n  color: black;\n}\n\nh1 {\n  \n\n}\n\nh1 {}\n\np:first-letter {\n  \n\n}\n\np.clase {\n  \n\n}\n\np.clase-numero-2 {\n  \n\n}\n\np#id {\n  \n\n}\n\np#id_numero_2 {\n  \n\n}\n\nstrong {\n  color: black;\n}\n\n";

print "<h3>Antes</h3>\n";
print "<pre>$texto</pre>\n";

$texto = preg_replace("/\w+\.(-?_?\w+)+ {[[:space:]]*}/s", "", $texto);
$texto = preg_replace("/\w+#(-?_?\w+)+ {[[:space:]]*}/s", "", $texto);
$texto = preg_replace("/\w+:(-?_?\w+)+ {[[:space:]]*}/s", "", $texto);
$texto = preg_replace("/\w+ {[[:space:]]*}/s", "", $texto);

$texto = preg_replace("/\n[[:space:]]*\n/s", "", $texto);
$texto = preg_replace("/}/", "}\n\n", $texto);

print "<h3>Después</h3>\n";
print "<pre>$texto</pre>\n";

*/

// eliminar las reglas que no tienen propiedades
print "<h2>Reglas vacías</h2>\n";

$texto = "@charset \"utf-8\";
@import url(\"mclibre-pie.css\");
/* Paginas web HTML / XHTML y hojas de estilo CSS
   Bartolome Sintes Marco
   http://www.mclibre.org

   CSS ejercicio:  Gatos
   27 de noviembre de 2014
*/

@font-face {
  font-family: \"Poiret One\";
  src: url(\"poiret_one.woff\")
}\nh1 { }\n\nbody {\n  color: black;\n}\n\nh1 { }\n\np {\n\n }\n\nsection section { }\n\nsection#a-1.c-2 section.b-2 { }\n\nh1 { }\n\np:first-letter { }\n\np.clase { }\n\np.clase-numero-2 { }\n\np#id { }\n\np#id_numero_2 { }\n\nstrong {\n  background-color: black;\n}\n\n";

print "<h3>Antes</h3>\n";
print "<pre>$texto</pre>\n";

$texto = preg_replace("/^(\w+([\.#:]?[-\w]+)* )+{[[:space:]]*}/m", "", $texto, -1, $contador);
print "<p>Sustituciones: $contador";
print "<h3>Después</h3>\n";
print "<pre>$texto</pre>\n";
