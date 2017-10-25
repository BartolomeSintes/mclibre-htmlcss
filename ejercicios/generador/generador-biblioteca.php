<?php
session_name("generador_ejercicios");
session_start();

$metodo = "get";
$paginaInicio = "index.php";

$gruposHtml = array(
  "Títulos" => array("titulos", "Títulos (&lt;h1>, &lt;h2>, etc.)"),
  "Imágenes" => array("imagenes", "Imágenes")
);

// El modificador /s es para que el . incluya tanto caracteres como saltos de líneas, y que las marcas de inicio y final puedan estar en líneas distintas.
$gruposCss = array(
  "colores" =>                  array("colores", "Colores",
                                      array ("!/\*--colores--\*/.*?/\*--/colores--\*/!s", "!/\*--colores--\*/!", "!/\*--/colores--\*/!")),
  "fuente" =>                   array("fuente", "Fuente",
                                      array ("!/\*--fuente--\*/.*?/\*--/fuente--\*/!s", "!/\*--fuente--\*/!", "!/\*--/fuente--\*/!")),
  "fuentes-web" =>              array("fuentes-web", "Fuentes web",
                                      array ("!/\*--fuentes-web--\*/.*?/\*--/fuentes-web--\*/!s", "!/\*--fuentes-web--\*/!", "!/\*--/fuentes-web--\*/!")),
  "texto" =>                    array("texto", "Texto",
                                      array ("!/\*--texto--\*/.*?/\*--/texto--\*/!s", "!/\*--texto--\*/!", "!/\*--/texto--\*/!")),
  "bordes" =>                   array("bordes", "Bordes",
                                      array ("!/\*--bordes--\*/.*?/\*--/bordes--\*/!s", "!/\*--bordes--\*/!", "!/\*--/bordes--\*/!")),
  "margenes" =>                 array("margenes", "Márgenes",
                                      array ("!/\*--margenes--\*/.*?/\*--/margenes--\*/!s", "!/\*--margenes--\*/!", "!/\*--/margenes--\*/!")),
  "fondos" =>                   array("fondos", "Fondos",
                                      array ("!/\*--fondos--\*/.*?/\*--/fondos--\*/!s", "!/\*--fondos--\*/!", "!/\*--/fondos--\*/!")),
  "posicionamiento-flotante" => array("posicionamiento-flotante", "Posicionamiento flotante",
                                      array ("!/\*--posicionamiento-flotante--\*/.*?/\*--/posicionamiento-flotante--\*/!s", "!/\*--posicionamiento-flotante--\*/!", "!/\*--/posicionamiento-flotante--\*/!")),
  "posicionamiento-absoluto" => array("posicionamiento-absoluto", "Posicionamiento absoluto",
                                      array ("!/\*--posicionamiento-absoluto--\*/.*?/\*--/posicionamiento-absoluto--\*/!s", "!/\*--posicionamiento-absoluto--\*/!", "!/\*--/posicionamiento-absoluto--\*/!")),
  "posicionamiento-fijo" =>     array("posicionamiento-fijo","Posicionamiento fijo",
                                      array ("!/\*--posicionamiento-fijo--\*/.*?/\*--/posicionamiento-fijo--\*/!s", "!/\*--posicionamiento-fijo--\*/!", "!/\*--/posicionamiento-fijo--\*/!"))
);

$ejercicios = array(
  array("curriculum-vitae", "Currículum Vitae (corto)"),
  array("citas-virgilio-web-fonts", "Citas de Virgilio (Fuentes web locales)"),
  array("citas_dijkstra", "Citas de Edsger Dijkstra"),
  array("gatos", "Felis silvestris catus")
//  array("no_existe", "No existe")
);


function javascript_index() {
  global $gruposCss;

  print "    <script>\n";
  print "      function seleccion(ejercicio) {\n";
  print "      var gruposCss = [";
  foreach ($gruposCss as $indice => $valor) {
    print "'$indice', ";
  }
       print "];

  for (var grupoCss in gruposCss)
      document.getElementById('tr-'+gruposCss[grupoCss]).style.display = 'none';
        var ejercicios= [];
        ejercicios['citas-virgilio-web-fonts'] = ['colores', 'fuente', 'fuentes-web', 'texto', 'margenes'];
        ejercicios['curriculum-vitae'] = ['colores', 'fuente', 'texto'];
        ejercicios['citas_dijkstra'] = ['colores', 'fuente', 'texto', 'bordes', 'margenes'];
        ejercicios['gatos'] = ['colores', 'fuente', 'texto', 'bordes', 'margenes'];
        for (var grupoCss in ejercicios[ejercicio])
          document.getElementById('tr-'+ejercicios[ejercicio][grupoCss]).style.display = 'table-row';
      }
    </script>
";
}

function recoge($var)
{
  $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
  return $tmp;
}

function recogeMatriz($var)
{
  $tmpMatriz = array();
  if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
    foreach ($_REQUEST[$var] as $indice => $valor) {
      $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
      $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
      $tmpMatriz[$indiceLimpio] = $valorLimpio;
    }
  }
  return $tmpMatriz;
}

// glup tiene PHP 5.3 que no tiene la función array_column, pero he encontrado una versión para PHP < 5.5
// Sacada de https://github.com/ramsey/array_column/blob/master/src/array_column.php
if (!function_exists('array_column')) {
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
}

?>
