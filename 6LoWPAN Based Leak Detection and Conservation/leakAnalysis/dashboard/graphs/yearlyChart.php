<?php
include("phpgraphlib.php");
include('phpgraphlib_pie.php');
include("../../connect.php");
session_start();
$email = $_SESSION['email'];

$months = array("Jan", "Feb", "Mar", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
$dataArray = array();
//get data from database
//$sql="SELECT YEAR(s_date), COUNT(*) AS 'count' FROM BENEFITED_THROUGH GROUP BY YEAR(s_date)";
$sql = "SELECT YEAR(leaktime) AS YEAR, COUNT(YEAR(leaktime)) AS COUNT FROM LEAKAGE WHERE email='$email' GROUP BY YEAR(leaktime)";
$result = mysqli_query($con, $sql);// or die('Query failed: ' . mysql_error());
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
  	  //$m = (int)$row['MONTH'];
      $salesgroup=$row['YEAR'];
      $count=$row["COUNT"];
      //add to data areray
      $dataArray[$salesgroup]=$count;
  }
}

//configure graph
$title = "X-AXIS : YEAR             Y-AXIS : NUMBER OF LEAKS DETECTED";

$graph=new PHPGraphLib(550,350); 
$graphpie = new PHPGraphLibPie(400, 200);

$graph->addData($dataArray);
$graph->setBarColor('navy');
$graph->setupXAxis(20, 'blue');
$graph->setTitleColor('blue');
$graph->setGridColor('153,204,255');
$graph->setDataValues(true);
$graph->setDataValueColor('navy');
$graph->setGoalLine('10', 'fuscia', 'dashed');
$graph->setTitle($title);
$graph->setGradient("black", "blue");
$graph->setBarOutlineColor("black");
$graph->createGraph();

?>
