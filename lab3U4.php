<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form action="lab3U4.php" method="post">
        <input type="text" name="nit" placeholder="NIT del cliente" required><br>
        <input type="text" name="nombre" placeholder="Nombre completo del cliente" required><br>
        <input type="number" name="precio" placeholder="Precio unitario del producto" required step="0.01"><br>
        <input type="number" name="cantidad" placeholder="Cantidad de docenas a comprar" required min="1"><br>
        <select name="producto" size="3">
            <option value="crayones">Crayones</option>
            <option value="portaminas">Portaminas</option>
            <option value="cuaderno">Cuaderno</option>
        </select><br>
        <select name="pago" size="3">
            <option value="efectivo">Efectivo</option>
            <option value="banca">Banca en Línea</option>
            <option value="tarjeta">Tarjeta de Crédito</option>
        </select><br>
        <select name="color" size="3">
            <option value="roja">Roja</option>
            <option value="azul">Azul</option>
            <option value="negra">Negra</option>
        </select><br>
        <input type="radio" name="club" value="si" required> Sí Pertenencia al Club Tucan<br>
        <input type="radio" name="club" value="no"> No Pertenencia al Club Tucan<br>
		<br><input type="submit"  name="btn" value="Calcular"><br> 
    </form>
</body>
</html>
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