<?php
function pozitieVacanta($vecin,$x,$y,$index)
{
	global $harta, $preferinteVecini, $antipatiiVecini, $vizitat, $dx, $dy;
	
	for($i = $index; $i < 8; $i++)
	{
		$xx = $x + $dx[$i];
		$yy = $y + $dy[$i];
		
		//echo $vecin." ".$xx." ".$yy."<br>";
			
		//daca are pozitie goala
		if($harta[$x + $dx[$i]][$y + $dy[$i]] == 0)
		{
			//caut daca are antipatii
			$ok = 1;
			for($j = 0; $j < 8 && $ok; $j++)
			{	
				$vecinNou = $harta[$xx + $dx[$j]][$yy + $dy[$j]];
				
				for($k = 1; $vecinNou != 0 && $k <= count($antipatiiVecini[$vecin]); $k++)
				{
					if($antipatiiVecini[$vecin][$k] == $vecinNou)
					{
						$ok = 0;
						break;
					}
				}
			}
			
			//Vad daca e cu toti prietenii plasati
			if($ok)
			{
				for($j = 1; $j <= count($preferinteVecini[$vecin]); $j++)
				{
					//Iau toti vecinii plasati
					if($vizitat[$preferinteVecini[$vecin][$j]])
					{
						$aux = $preferinteVecini[$vecin][$j];
						$okk = 0;
						//vad daca sunt in imprejurimi
						for($k = 0; $k < 8 && $okk == 0; $k++)
						{
							if($harta[$xx + $dx[$k]][$yy + $dy[$k]] == $aux)
							{
								$okk = 1;
							}
						}
						if($okk == 0)
						{
							$ok = 0;
							break;
						}
					}
				}
			}
			
			if($ok)
				return array('x' => $xx, 'y' => $yy, 'index' => $i+1);
		}
	}
	return null;
}

function afis()
{
	global $harta, $preferinteVecini, $antipatiiVecini, $vizitat, $dx, $dy;
for($i = 15; $i <= 25; $i++)
{
	for($j = 15; $j <= 25; $j++)
		echo $harta[$i][$j]." ";
	echo "<br>";
}
echo "<br><br>";
}

function functieRecursiva($x,$y)
{
	global $harta, $preferinteVecini, $antipatiiVecini, $vizitat, $dx, $dy;
	
	//afis();
	$locatar = $harta[$x][$y];
	
	for($i = 1; $i <= 8 && $i <= count($preferinteVecini[$locatar]); $i++)
	{
		$vecin = $preferinteVecini[$locatar][$i];
		if($vizitat[$vecin] == 0)
		{
			$pozitie = pozitieVacanta($vecin,$x,$y,0);
			while(1)
			{
				if($pozitie != null)
				{
					$harta[$pozitie['x']][$pozitie['y']] = $vecin;				
					$vizitat[$vecin] = 1;
					$flag = functieRecursiva($pozitie['x'], $pozitie['y']);
					if($flag == -1)
					{
						$harta[$pozitie['x']][$pozitie['y']] = 0;
						$vizitat[$vecin] = -1;	
						$pozitie = pozitieVacanta($vecin,$x,$y,$pozitie['index']);
					}
					else 
					{
						break;
					}
				}
				else
					return -1;
			}
		}
	}
	return 1;
	
}
?>