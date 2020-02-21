<?php
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");
 header("Access-Control-Allow-Headers: Content-Type, Authorization");
 
require_once("php7_mysql_shim.php");

require '../../vendor/autoload.php';
$app = new \Slim\App;

$app->get('/hello', function(){
	return 'Hello World!';
});

$app->get('/dataServidor', function(){
	$result = array( 'data' => date("Y-m-d"), 'hora' => date("H:i:s")); 
	echo json_encode($result);
});


$app->post('/consultarParceiros', 'consultarParceiros');

function consultarParceiros($request, $response){
	$param = json_decode($request->getBody());
	$cidade = trim(json_encode($param->cidade, JSON_UNESCAPED_UNICODE), '"');
	
	$conexao = mysql_connect("mysql.segurosja.com.br", "segurosja", "m1181s2081_") or die ("problema na conexão");
	mysql_set_charset('utf8',$conexao);

	$rows = array();

	if($cidade == 'todas'){
		$sql = "SELECT codigo, fantasia, razao, cidade, uf, fone FROM imobs WHERE site='1' order by fantasia asc";
	}else{
		$sql = "SELECT codigo, fantasia, razao, cidade, uf, fone FROM imobs WHERE site='1' and cidade='$cidade' order by fantasia asc";
	}
 	
	
	$consulta = mysql_db_query("segurosja", $sql) or die (mysql_error());

	while($campo = mysql_fetch_assoc($consulta)){
      $rows[] = $campo;
    }

	echo json_encode($rows);
}


$app->run();

?>
