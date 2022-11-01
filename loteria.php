<?php

$numeroSorteio = "";
if (isset($argv[1])) {
	$numeroSorteio = $argv[1];
}

$url = sprintf("https://servicebus2.caixa.gov.br/portaldeloterias/api/lotofacil/%s", $numeroSorteio);

$arrDezenasJogadas = ['01', '02', '03', '04', '05', '07', '08', '11', '12', '13', '14', '15', '16', '19', '24'];

$numDezenasAcertos = 0;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$resultado = curl_exec($ch);


curl_close($ch);

$arrResultado = json_decode($resultado, true);

if (!$arrResultado) {
	die('Erro ao retornar o resultado');
}

// print_r($arrResultado);

echo sprintf("Numero do sorteio: %s \n", $arrResultado['numero']);
echo sprintf("Dia do sorteio: %s \n", $arrResultado['dataApuracao']);
foreach ($arrResultado['dezenasSorteadasOrdemSorteio'] as $dezena) {
	if (in_array($dezena, $arrDezenasJogadas)) {
		$numDezenasAcertos++;
	}
}
echo sprintf("Quantidade de acertos: %s \n", $numDezenasAcertos);
?>
