<?php
$precio = $cantidad = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nit = $_POST['nit'] ?? "";
    $nombre = $_POST['nombre'] ?? "";
    $producto = $_POST['producto'] ?? "";
    $precio = floatval($_POST['precio'] ?? 0);
    $cantidad = intval($_POST['cantidad'] ?? 0);
    $pago = $_POST['pago'] ?? "";
    $color = $_POST['color'] ?? "";
    $club = $_POST['club'] ?? "";

    $parcial = $precio * $cantidad;

    $d1 = 0;
    $porcentajed1 = 0;
    if ($producto == 'crayones') {
        $d1 = $parcial * 0.04;
        $porcentajed1 = 4;
    } elseif ($producto == 'portaminas') {
        $d1 = $parcial * 0.06;
        $porcentajed1 = 6;
    } elseif ($producto == 'cuaderno') {
        $d1 = $parcial * 0.08;
        $porcentajed1 = 8;
    }

    $d2 = 0;
    $porcentajed2 = 0;
    if ($club == 'si') {
        $d2 = $parcial * 0.06;
        $porcentajed2 = 6;
    }

    $d3 = 0;
    $porcentajed3 = 0;
    $r1 = 0;
    $porcentajer1 = 0;
    if ($pago == 'efectivo') {
        $d3 = $parcial * 0.10;
        $porcentajed3 = 10;
    } elseif ($pago == 'banca') {
        $d3 = $parcial * 0.15;
        $porcentajed3 = 15;
    } elseif ($pago == 'tarjeta') {
        $r1 = $parcial * 0.05;
        $porcentajer1 = 5;
    }

    $d4 = 0;
    $porcentajed4 = 0;
    if ($color == 'roja') {
        $d4 = $parcial * 0.04;
        $porcentajed4 = 4;
    } elseif ($color == 'azul') {
        $d4 = $parcial * 0.06;
        $porcentajed4 = 6;
    } elseif ($color == 'negra') {
        $d4 = $parcial * 0.08;
        $porcentajed4 = 8;
    }

    $dtotal = $d1 + $d2 + $d3 + $d4;
    $total = $parcial - $dtotal + $r1;

$cn=mysqli_connect("localhost","root","","tucan"); 
$sql="insert into proceso(nit,nombre,cantidad,parcial,d1,d2,d3,d4,r1,dtotal,total)values('$nit','$nombre','$cantidad','$parcial','$d1','$d2','$d3','$d4','$r1','$dtotal','$total')";
mysqli_query($cn,$sql); 
echo "Datos Insertado Correctos"; 

}