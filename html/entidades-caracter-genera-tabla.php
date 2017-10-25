<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Genera tabla Entidades de caracter. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../varios/htmlcss.css" rel="stylesheet" type="text/css" title="Color" />
    <link href="../varios/ejemplos.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../varios/favicon.ico" />
  </head>

  <body>
<?php
    include("entidades-caracter-array.php");

    print "      <table class=\"mcl-listado franjas\">\n";
    print "        <thead>\n";
    print "          <tr>\n";
    print "            <th>Carácter&nbsp;&nbsp;</th>\n";
    print "            <th>Nombre&nbsp;&nbsp;</th>\n";
    print "            <th>Entidad de carácter&nbsp;&nbsp;</th>\n";
    print "            <th>Entidad numérica&nbsp;&nbsp;</th>\n";
    print "            <th>Recomendación&nbsp;&nbsp;</th>\n";
    print "            <th>Descripción</th>\n";
    print "          </tr>\n";
    print "        </thead>\n";

    print "        <tbody>\n";
    foreach ($entidades_caracter as $c) {
      print "          <tr>\n";
      print "            <td style=\"text-align: center; font-size: 150%\">$c[0]</td>\n";
      print "            <td>$c[1]</td>\n";
      print "            <td>$c[2]</td>\n";
      print "            <td>$c[3]</td>\n";
      print "            <td>$c[4]</td>\n";
      print "            <td>$c[5]</td>\n";
      print "          </tr>\n";
    }
    print "        </tbody>\n";
    print "      </table>\n";

    ?>
  </body>
</html>
