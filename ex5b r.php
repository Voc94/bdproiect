<html>
 <head>
  <title>Rezultat ex4a</title>
  <style>
   table, th, td
   {
    margin-left : 30%;
	position: auto;
    margin-top : 10%;
    top: 35%;
     border: 1px solid black;
	 background-color : FFFFFF;
   }
   div{
  margin-left : 20%;
  position: absolute;
  text-align: center;
  top: 35%;
}
body{
	background-color : 7777FF;
}
  </style>
 </head>
<body>
 <h3></h3>
<?php
$user = 'root';
$pass = '';
$host = 'localhost';
$db_name = 'facturidatevanzari';

$connect = mysqli_connect($host, $user, $pass, $db_name);
// se verifică dacă a funcţionat conectarea
if ($connect->connect_error)
{
  die('Eroare la conectare: ' . $connect->connect_error);
}
// se emite interogarea
$query = "SELECT nume,adresa
FROM Client
WHERE id_c = ANY
(
SELECT id_c
FROM Factura
WHERE nr_zile = ANY
(
SELECT MIN(nr_zile)
FROM Factura
)
);
";

$result = mysqli_query($connect, $query);
// verifică dacă rezultatul este în regulă
if (!$result)
{
  die('Interogare gresita: ' . mysqli_error());
}
// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);
if($num_results==0)
{
    echo 'Nu au fost gasite facturi difuzate in localitatile oradea si asled.  '.$litera.'!';
    exit;
}
// se afişează fiecare tuplă returnată
echo '<table style="width:40%">
  <tr>
    <th>nume</th>
	<th>adresa</th>
	
  </tr>';
for ($i = 0; $i < $num_results; $i++)
{
  $row = mysqli_fetch_assoc($result);
  
  echo '<tr><td>'.stripslashes($row['nume']).'</td>';
  echo '<td>'.stripslashes($row['adresa']).'</td></tr>';
}
echo '</table>';
// deconectarea de la BD
mysqli_close($connect);
?>
</body>
</html>
