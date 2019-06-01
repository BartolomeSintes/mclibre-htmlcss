<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Genera tabla Entidades de caracter. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../varios/htmlcss.css" title="mclibre">
  <link rel="icon" href="../varios/favicon.ico">
  <style>
    div.e-l { /* entidad-lista */
      display: flex;
      flex-flow: row wrap;
      justify-content: space-between;
    }

    div.e { /* entidad */
      display: flex;
      flex-direction: column;
      flex: 0 1 150px;
      margin: 0 10px 10px 0;
      border: 2px black outset;
      text-align: center;
    }

    div.e p:nth-child(even) {
      background-color: #eee;
      color: black;
    }

    div.e p {
      margin: 0;
      padding: 0 2px;
    }

    div.e p.e-c { /* entidad-caracter */
      font-size: 4rem;
      line-height: 5rem;
    }

    div.e p.e-d { /* entidad-descripcion */
      flex: 1 0 auto;
    }

  </style>
</head>

<body>
<?php
    include("entidades-caracter-array-2.php");

    print "<p>Esta lista contiene " . count($entidadesCaracter) . "entidades de carácter.</p>";

    print "    <div class=\"e-l\">\n";

    foreach ($entidadesCaracter as $c) {
      print "      <div class=\"e\">\n";
      print "        <p class=\"e-c\">$c[0]</p>\n";
      print "        <p>&amp;" . substr($c[0], 1) . "</p>\n";
      if (count($c[1]) == 1) {
        print "        <p>&amp;#{$c[1][0]};</p>\n";
      } elseif (count($c[1]) == 2) {
        print "        <p>&amp;#{$c[1][0]};&amp;#{$c[1][1]};</p>\n";
      }
      if (count($c[1]) == 1) {
        print "        <p>&amp;#x" . dechex($c[1][0]) . ";</p>\n";
      } elseif (count($c[1]) == 2) {
        print "        <p>&amp;#x" . dechex($c[1][0]) . ";&amp;#x" . dechex($c[1][1]) . ";</p>\n";
      }
      print "        <p>$c[2]</p>\n";
      print "        <p class=\"e-d\">$c[3]</p>\n";
      print "      </div>\n";
      print "\n";
    }
    print "    </div>";

/*
    print "    <table class=\"mcl-listado mcl-franjas\">\n";
    print "      <thead>\n";
    print "        <tr>\n";
    print "          <th>Carácter&nbsp;&nbsp;</th>\n";
    print "          <th>Nombre&nbsp;&nbsp;</th>\n";
    print "          <th>Entidad de carácter&nbsp;&nbsp;</th>\n";
    print "          <th>Entidad numérica&nbsp;&nbsp;</th>\n";
    print "          <th>Recomendación&nbsp;&nbsp;</th>\n";
    print "          <th>Descripción</th>\n";
    print "        </tr>\n";
    print "      </thead>\n";

    print "      <tbody>\n";
    foreach ($entidades_caracter as $c) {
      print "        <tr>\n";
      print "          <td style=\"text-align: center; font-size: 150%\">$c[0]</td>\n";
      print "          <td>$c[1]</td>\n";
      print "          <td>$c[2]</td>\n";
      print "          <td>$c[3]</td>\n";
      print "          <td>$c[4]</td>\n";
      print "          <td>$c[5]</td>\n";
      print "        </tr>\n";
    }
    print "      </tbody>\n";
    print "    </table>\n";
*/
    ?>
</body>
</html>
