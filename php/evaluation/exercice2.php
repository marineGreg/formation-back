<?php

// Créer une fonction permettant de convertir un montant en euros vers un montant en dollars américains

function calculUSD($montantEuro, $USD = 1.085965) 
{
		$montantUSD = $montantEuro * $USD;
		return $montantEuro . ' euros font $' . $montantUSD;
}

// quelques conversions
$test = calculUSD(100);
echo '<br>' . $test;

$test = calculUSD(150);
echo '<br>' . $test;

$test = calculUSD(650);
echo '<br>' . $test;