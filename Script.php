<?php
session_start();
if(empty($_SESSION['text']))
    $_SESSION['text'] = "";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Точка</title>
    <style>
        table,th,td{
            border: 1px solid black;
            margin: auto;
            text-align: center;
            table-layout: fixed;
        }
        td,th{
            width: 170px;
            text-wrap: normal;
            word-wrap: break-word;
        }
    </style>
</head>
<body>

<?php
$correct = true;
$x=$y=$r="";
$xValues = array(-2.0,-1.5,-1.0,-0.5,0.0,0.5,1.0,1.5,2.0);
if(!isset($_GET['x'])) {
    $correct = false;
    echo "Не задан x: $x\n";
}
else {
    $x = test_input($_GET['x']);
    if(!is_numeric($x)||!in_array($x,$xValues)) {
        $correct = false;
        echo "Неверный x: $x\n";
    }
}
if(!isset($_GET['y'])) {
    $correct = false;
    echo "Не задан y: $y\n";
}
else {
    $y = test_input($_GET['y']);
    if(!is_numeric($y)||strlen($y)>15||$y<-3||$y>5|| equals($y,5) || equals($y,-3)) {
        $correct = false;
        echo "Неверный y: $y\n";
    }
}
if(!isset($_GET['r'])) {
    $correct = false;
    echo "Не задан r: $r\n";
}
else {
    $r = test_input($_GET['r']);
    if(!is_numeric($r)||strlen($r)>15||$r<1||$r>4|| equals($r,1) || equals($r,4)) {
        $correct = false;
        echo "Неверный r: $r\n";
    }
}
if($correct) {
    $tableStart = "<table>
    <thead>
    <tr>
        <th>
            x
        </th>
        <th>
            y
        </th>
        <th>
            R
        </th>
        <th>
            Результат
        </th>
        <th>
            Время вызова
        </th>
        <th>
            Время работы скрипта
        </th>
    </tr>
    </thead>";
    $tableEnd = "</table>";
    date_default_timezone_set("Europe/Moscow");
    $i = 0;
    $start = microtime(true);
    $_SESSION['text'] = $_SESSION['text'] . "<tr><td>$x</td><td>$y</td><td>$r</td>";
    if (checkQuarter1($x, $y, $r) || checkQuarter2($x, $y, $r) || checkQuarter3($x, $y, $r) || checkQuarter4($x, $y, $r))
        $_SESSION['text'] = $_SESSION['text'] . "<td>Точка входит в область</td>";
    else
        $_SESSION['text'] = $_SESSION['text'] . "<td>Точка в область не входит</td>";
    $stop = microtime(true);
    $exec = $stop - $start;
    $_SESSION['text'] = $_SESSION['text'] . "<td>" . date("H:i:s") . "</td><td >$exec с</td></tr>";
    echo $tableStart;
    echo $_SESSION['text'];
    echo $tableEnd;
}
else
    echo "Неверные данные";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function checkQuarter1($x,$y,$r){
    if(($x>0||equals($x,0))&&($y>0||equals($y,0))) {
        if (equals($x, 0) && equals($y, 0)){
            return true;
        }
    }
    return false;
}
function checkQuarter2($x,$y,$r){
    if(($x<0||equals($x,0))&&($y>0||equals($y,0))){
        $a=$x**2+$y**2;
        $r=($r/2)**2;
        if($a<$r||equals($a,$r)) {
            return true;
        }
    }
    return false;
}
function checkQuarter3($x,$y,$r){
    if($x<0||equals($x,0)&&($y<0)||equals($y,0)) {
        $x = abs($x);
        $y = abs($y);
        if (($x < $r || equals($x, $r)) && ($y < $r / 2 || equals($y, $r / 2))) {
            return true;
        }
    }
    return false;
}
function checkQuarter4($x,$y,$r){
    if(($x>0||equals($x,0))&&($y<0||equals($y,0))){
        $a=$x-$r/2;
        if($y>$a||equals($y,$a)) {
            return true;
        }
    }
    return false;
}
function equals($a, $b){
    $epsilon=2**-50;
    return abs($a-$b)<$epsilon;
}
?>
<p>
<form action="FrontPage.html">
    <input type="submit" value="Вернуться">
</form>
</p>
</body>
</html>
