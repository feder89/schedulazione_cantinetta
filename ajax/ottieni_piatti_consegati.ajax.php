<?php
	require_once '../include/core.inc.php';
	$link=connectToDb();
	$portate=array();
	$query="SELECT portata,COUNT(portata) AS nr FROM programmazioneordini 
			WHERE stato=3 and categoria IN ('cantinetta')
			GROUP BY portata
			ORDER BY portata";			

	$result = mysqli_query($link, $query) or die("#error#".mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
    	array_push($portate, array(	'portata' => $row['portata'], 
    								'quantita' => $row['nr']));
	}

	disconnetti_mysql($link, NULL); #visto che non ho un result_set gli passo NULL.. nella funzione in core.in.php ho aggiunto il controllo

	echo json_encode($portate);
	

?>