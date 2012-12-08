<?php

$preferinteVecini = array();
$antipatiiVecini = array();
$vizitat = array_fill(1,100,0);
$harta = array();

for($i = 1; $i <= 100; $i++)
{
	$preferinteVecini[$i] = array();
	$antipatiiVecini[$i] = array();
	$harta[$i] = array_fill(1,100,0);
}

function addVecini($a,$b)
{
	global $preferinteVecini;
	if($a == null || $b == null)
		return;
	$preferinteVecini[$a][count($preferinteVecini[$a])+1] = $b;
	$preferinteVecini[$b][count($preferinteVecini[$b])+1] = $a;
}

function addAntipatii($a,$b)
{
	global $antipatiiVecini;
	if($a == null || $b == null)
		return;
	$antipatiiVecini[$a][count($antipatiiVecini[$a])+1] = $b;
	$antipatiiVecini[$b][count($antipatiiVecini[$b])+1] = $a;
	
}

$string = "";
//$_REQUEST['data'] = '{"data":[{"id":1,"nume":"Andrei","nr_membri":5,"vecini":[],"nonVecini":[]},{"id":2,"nume":"Andrei","nr_membri":5,"vecini":[],"nonVecini":[]}]}';

if(!isset($_REQUEST['data']))
{
	exit();
}

$string = json_decode($_REQUEST['data']);

$count = 0;

for($i = 0; $i < count($string->{"data"}); $i++)
{
	$id = $string ->{"data"}[$i]->id;
	for($j = 0; $j < count($string->{"data"}[$i]->vecini); $j++)
	{
		addVecini($id,$string->{"data"}[$i]->vecini[$j]);
	}
	for($j = 0; $j < count($string->{"data"}[$i]->nonVecini); $j++)
	{
		addAntipatii($id,$string->{"data"}[$i]->nonVecini[$j]);
	}
	//echo ($id);
	//$vizitat[$id] = 0;
	$count++;
}

include("functii.php");

$aa["markers"] = array();
$N = 0;
$nHarta = 0;

//Luam toate componentele conexe
for($ceSaMaiPun = 1; $ceSaMaiPun<=$count; $ceSaMaiPun++)
{

if($vizitat[$ceSaMaiPun] == 0)
{

for($i = 1; $i <= 10; $i++)
{
	$harta[$i] = array_fill(1,100,0);
}

$x = 21;
$y = 21;

$harta[$x][$y] = $ceSaMaiPun;
$vizitat[$ceSaMaiPun] = 1;

$dy = array(0,1,1,1,0,-1,-1,-1);
$dx = array(-1,-1,0,1,1,1,0,-1);


functieRecursiva(21,21);
//afis();

	for($ii = 1; $ii <= 41; $ii++)
	{
		for($jj = 1; $jj <= 41; $jj++)
			if($harta[$ii][$jj])
			{
				//echo $jj." ".$ii."<br>";
				//echo (26.054236 + ($jj + 41 * (int)($nHarta/10))/100)." ";
				$aa["markers"][$N++] = array("id" => $harta[$ii][$jj], "lat" => 44.467724 + $ii * 0.001 + (41 * 0.001 * ($nHarta%10)), "lng" => 26.054236 + $jj * 0.001 * (41 * 0.001 * ($nHarta/10)), "satisfacut" => 1);
			}
	}
$nHarta++;
}
}

$N = 0;
$aa['nesatisfacuti'] = array();
for($ii = 1; $ii <= 100; $ii++)
	if($vizitat[$ii] == -1)
		$aa["nesatisfacuti"][$N++] = array("id" => $ii, "lat" => 0, "lng" => 0, "satisfacut" => 0);

echo json_encode($aa);
?>