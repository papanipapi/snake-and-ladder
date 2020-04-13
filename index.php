<?php

require "vendor/autoload.php";

use Mini\Board;

$numberOfBlock = 100;
$row = 10;

$board = new Board();
$board->setNumberOfBlock($numberOfBlock);
$board->setRow($row);
$blocks = $numberOfBlock;

$odd = true;
$reverse = false;
echo "<table>\r\n";
for ($i=ceil($numberOfBlock/$row); $i>=1; $i--):
    echo "<tr>";
    if (!$reverse) {
        for ($ii = 1; $ii <= $row; $ii++):
            if ($blocks<=0) {
                break;
            }
            $columnClass = $odd ? 'odd' : 'even';
            echo "<td class=\"{$columnClass}\">";
            echo $blocks;
            $blocks--;
            echo "</td>";
            $odd = !$odd;
        endfor;
    } else {
        // reverse
        $blocks -= $row-1;
        for ($ii = $row; $ii >= 1; $ii--):
            $columnClass = $odd ? 'even' : 'odd';
            echo "<td class=\"{$columnClass}\">";
            echo $blocks;
            $blocks++;
            echo "</td>";
            $odd = !$odd;
        endfor;
        $blocks -= $row+1;
    }
    $reverse = !$reverse;
    echo "</tr>\r\n";
endfor;
echo "</table>";

echo "<style>.even { background-color: red; color: white; } td { width: 50px; height: 50px; text-align: center; }</style>";