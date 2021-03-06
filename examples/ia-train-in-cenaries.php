<?php
	
	/**
	 *	Treina possibilidades com diferentes para chegar no melhor resultado
	 *
	 *	File: ia-train-in-cenaries.php
	 *
	 *	@var \WDOAPI\WDOAPI		$wdo 					Carrega a classe da API
	 *	@var date<yyyy-mm-dd>	$startDate 				Data que comeca de contar os candles
	 *	@var date<yyyy-mm-dd>	$endDate 				Data que termina de contar os candles
	 *	@var array				$sgdbArrCandles 		Recupero os candles ja processados entre um intervalo de data
	 *	@var array 				$retorno				Retorno das opcoes de config. de neurorios que mais deram resultados
	 *	@var array 				$configNeurons			Configuracao de neuronios ativos e desativados para testar as possibilidates
	 *	@var array 				$officeHour 			Horario que comeca e termina as opecoes no dia, ex: vou operar das 9 as 12:30
	 *	@var int 				$registersnumberInRank	Numero de TOP configuracoes, exemplo, quero os top 3,5,10 de configuracoes
	 *	@var bool 				$longRequest			Carrega dependencias para permitir que requisicoes longas sem time limit
	 *
	 *	@todo E UMA IA, pode chegar a verificar algumas MILHOES DE POSSIBILIDADES, ENTAO O RESULTADO NAO VAI FICAR PRONTO DO DIA PRA NOITE
	 *		  DEPENDENDO DA CONFIGURACAO, recomendo rodar em um PC|Server bom
	 *	@todo Aprimoramento constante, talvez haja mais neuronios prontos, sendo assim, mais configuracoes de neuronios
	 */

	// Autoload dos arquivos de dependencia
	include('../src/WDOAPI/autoload.php');

	$wdo 					= new \WDOAPI\WDOAPI( $longRequest = true );

	$startDate				= '2017-08-01';
	$endDate				= '2017-08-10';

	$configNeurons			= [
		'candle_osc'			=> [
			'active'	=> true,
		],
	 	'nivel_osc'				=> [
			'active'	=> false,
		],
		'candles_repetidos'		=> [
			'active'	=> false,
		],
		'tendencias_repetidas'	=> [
			'active'	=> false,
		],
		'gap_abertura'			=> [
			'active'	=> false,
		],
	];

	$officeHour = [
			'startAt'	=> '09:00:00',
			'finishAt'	=> '12:30:00'
	];

	$registersnumberInRank = 20;

	$sgdbArrCandles = $wdo->listIntradayData( $startDate, $endDate );

	$retorno = $wdo->train( $sgdbArrCandles, $configNeurons, $officeHour, $registersnumberInRank );

	echo '<pre>';
		print_r( $retorno );
	echo '</pre>';

?>