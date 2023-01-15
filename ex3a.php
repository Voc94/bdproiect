<html>
 <head>
  <title>Rezultat ex3a</title>
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
$query = "SELECT *
FROM FACTURA
WHERE valoare BETWEEN 500 AND 1000
ORDER BY data DESC,valoare ASC;
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
    echo 'Nu au fost gasite facturi intre 500 si 1000 lei  '.$litera.'!';
    exit;
}
// se afişează fiecare tuplă returnată
echo '<table style="width:40%">
  <tr>
    <th>data</th>
	<th>valoare</th>
	<th>nr_pagini</th>
	<th>cost_pagina</th>
	<th>nr_zile</th>
	<th>tva</th>
  </tr>';
for ($i = 0; $i < $num_results; $i++)
{
  $row = mysqli_fetch_assoc($result);
  
  echo '<tr><td>'.stripslashes($row['data']).'</td>';
  echo '<td>'.stripslashes($row['valoare']).'</td>';
   echo '<td>'.stripslashes($row['nr_pagini']).'</td>';
  echo '<td>'.stripslashes($row['cost_pagina']).'</td>';
   echo '<td>'.stripslashes($row['nr_zile']).'</td>';
  echo '<td>'.stripslashes($row['tva']).'</td></tr>';
}
echo '</table>';
// deconectarea de la BD
mysqli_close($connect);
?>
</body>
</html>
