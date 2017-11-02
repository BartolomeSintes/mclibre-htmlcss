<?php
include "generador_biblioteca.php";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Generador de ejercicios. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../varios/htmlcss.css" rel="stylesheet" type="text/css" title="Color" />
    <link rel="icon" href="../../varios/favicon.ico" />
  </head>

  <body<?php if (isset($_SESSION["ejercicio"])) print " onload=\"seleccion('$_SESSION[ejercicio]')\""?>>
    <h1>Generador de ejercicios</h1>

    <nav>
      <p>
        <a href="../../index.html"><img src="../../varios/iconos/icono-html5.svg" alt="Índice de HTML/CSS" title="Índice de HTML/CSS" height="48" width="42" /></a>
        <a href="#"><img src="../../varios/iconos/icono-arrow-circle-up.svg" alt="Principio de la página" title="Principio de la página" height="36" width="36" /></a>
        <a href="../index.html"><img src="../../varios/iconos/icono-ejercicios.svg" alt="Índice de ejercicios" title="Índice de ejercicios" width="36" height="36" /></a>
      </p>

      <div class="toc">
        <h2>Generador ejercicios</h2>
      </div>
    </nav>

    <p><img src="../../varios/iconos/icono-en-construccion.svg" alt="En construcción" title="En construcción" width="55" height="48" />Este generador de ejercicios está en elaboración. El objetivo es poder elegir las etiquetas HTML y propiedades CSS que aparecen en los ejercicios.</p>

    <hr />

    <form action="generador_html.php" method="<?= $metodo?>">
      <?php
  if (isset($_SESSION["error"])) {
    print "    <p><img src=\"../../varios/iconos/icono-warning.svg\" alt=\"¡Aviso!\" title=\"¡Aviso!\" width=\"55\" height=\"48\" />$_SESSION[error]</p>\n\n";
  }
      ?>

      <p>Elija el ejercicio:</p>

      <?php
      print "<table>\n";
      foreach ($ejercicios as $ejercicio) {
        print "        <tr>\n";
        print "          <td><input type=\"radio\" name=\"ejercicio\" value=\"$ejercicio[0]\" id=\"$ejercicio[0]\" ";
        if (isset($_SESSION["ejercicio"]) && $_SESSION["ejercicio"] == $ejercicio[0]) {
          print "checked=\"checked\" ";
        }
        print "onclick=\"if(this.checked){ seleccion('$ejercicio[0]');}\" ";
        print "/></td>\n";
        print "          <td><label for=\"$ejercicio[0]\">$ejercicio[1]</label></td>\n";
        print "        </tr>\n";
      }
      print "      </table>\n"
      ?>

      <p>Elija los grupos de etiquetas HTML que aparecen en el ejercicio:</p>

      <?php
        print "<table>\n";
      foreach ($gruposHtml as $grupo) {
        print "        <tr id=\"tr-$grupo[0]\">\n";
        print "          <td><input type=\"checkbox\" name=\"html[$grupo[0]]\" id=\"$grupo[0]\" ";
        if (isset($_SESSION["html"])) {
          if (isset($_SESSION["html"][$grupo[0]])) {
            print "checked=\"checked\" ";
          }
        } else {
          print "checked=\"checked\" ";
        }
        print "/></td>\n";
        print "          <td><label for=\"$grupo[0]\">$grupo[1]</label></td>\n";
        print "        </tr>\n";
      }
      print "      </table>\n"
      ?>

      <p>Elija los grupos de propiedades CSS que aparecen en el ejercicio:</p>

      <?php
        print "<table>\n";
      foreach ($gruposCss as $grupo) {
        print "        <tr id=\"tr-$grupo[0]\">\n";
        print "          <td><input type=\"checkbox\" name=\"css[$grupo[0]]\" id=\"$grupo[0]\" ";
        if (isset($_SESSION["css"])) {
          if (isset($_SESSION["css"][$grupo[0]])) {
            print "checked=\"checked\" ";
          }
        } else {
          print "checked=\"checked\" ";
        }
        print "/></td>\n";
        print "          <td><label for=\"$grupo[0]\">$grupo[1]</label></td>\n";
        print "        </tr>\n";
      }
      print "      </table>\n"
      ?>

      <p>
        <input type="submit" value="Formateado" formaction="generador_comprueba.php" /> <!-- -
<input type="submit" value="Descargar sin formatear" formaction="generador_zip.php" /> -
<input type="submit" value="Comentarios" formaction="generador_comentarios.php" />-->
      </p>

    </form>

    <?php
        javascript_index();
    ?>
    <footer>
      <p class="ultmod">Última modificación de esta página: 17 de junio de 2016</p>

      <p class="licencia"><a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES"><img src="../../varios/iconos/icono-cc-by-sa.svg" alt="Licencia Creative Commons" title="Licencia Creative Commons BY-SA" width="120" height="42" /></a><br />
        Esta página forma parte del curso <strong>Páginas web HTML y hojas de estilo CSS</strong> por <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a><br />
        que se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
    </footer>
  </body>
</html>
