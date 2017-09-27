<?php
header("Content-type: image/svg+xml");
function recoge($var)
{
  $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
  return $tmp;
}

$radio = recoge("radio");
$cx = recoge("cx");
$cy = recoge("cy");


print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
    . "    width=\"100\" height=\"100\" viewBox=\"0 0 100 100\">\n";
print "  <rect fill=\"none\" stroke=\"black\" stroke-width=\"1\" "
        . "x=\"1\" y=\"1\" width=\"98\" height=\"98\" />\n";
print "   <circle cx=\"$cx\" cy=\"$cy\" r=\"$radio\" fill=\"black\" />\n";
print "</svg>";
?>
