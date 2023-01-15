<html>
 <head>
  <title>Rezultat ex6b</title>
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
<?php
 $valsel=$_POST['valsel'];
 $valsel= trim($valsel);
 
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
$query = "CALL min_avg_max('$valsel');
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
    echo 'Nu au fost gasite date!';
    exit;
}
// se afişează fiecare tuplă returnată
$col_title = "";
if ($valsel == 'min')
{
   $col_title = "minim";
}
elseif($valsel == 'avg')
{
    $col_title = "mediu";
}
elseif ($valsel == 'max')
{
    $col_title = "maxim";
}
else
{
    $col_title = "!!!Invalid operation!!!";
}
echo '<table style="width:40%">
  <tr>
    <th>'.$col_title.'</th>
  </tr>';
for ($i = 0; $i < $num_results; $i++)
{
  $row = mysqli_fetch_assoc($result);
  echo '<tr>';
  echo '<td>'.stripslashes($row['result']).'</td>';
  echo '</tr>';
}
echo '</table>';
// deconectarea de la BD
mysqli_close($connect);
?>
</body>
</html>
