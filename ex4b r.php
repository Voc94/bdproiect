<html>
 <head>
  <title>Rezultat ex4b</title>
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
$query = "SELECT l.denumire AS denumire, df1.id_f AS idf1 ,df2.id_f AS idf2, df1.datai AS datai1,df2.datas AS datas2
FROM Difuzare df1 JOIN Difuzare df2 ON df1.id_f = df2.id_f AND df1.id_l != df2.id_l 
AND df2.datai < df1.datas JOIN Localitate l ON df1.id_l = l.id_l AND df2.id_l != l.id_l;
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
    echo 'Nu au fost gasite perechi cu conditia ceruta.  '.$litera.'!';
	exit;
}
// se afişează fiecare tuplă returnată
echo '<table style="width:40%">
  <tr>
    <th>denumire</th>
	<th>idf1</th>
	<th>datai1</th>
	<th>datas2</th>
  </tr>';
for ($i = 0; $i < $num_results; $i++)
{
  $row = mysqli_fetch_assoc($result);
  
  echo '<tr><td>'.stripslashes($row['denumire']).'</td>';
  echo '<td>'.stripslashes($row['idf1']).'</td>';
  echo '<td>'.stripslashes($row['datai1']).'</td>';
   echo '<td>'.stripslashes($row['datas2']).'</td>';
}
echo '</table>';
// deconectarea de la BD
mysqli_close($connect);
?>
</body>
</html>
