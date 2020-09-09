<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//GET Evidencias
$app->get('/api/evidences', function(Request $request, Response $response){
    $sql = "SELECT * FROM evidencias";
    try{
      $db = new DataBase();
      $db = $db->DBconnection();
      $resultado = $db->query($sql);
  
      if ($resultado->rowCount() > 0){
        $evidences = $resultado->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($evidences);
      }else {
        echo json_encode("{'code': 400}");
      }
      $resultado = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
}); 

$app->post('/api/evidences/new', function(Request $request, Response $response){
    $ruta_id = $request->getParam('ruta_id');
    $tipo_evidencia = $request->getParam('tipo_evidencia');
    $comentarios = $request->getParam('comentarios');
    $latitud = $request->getParam('latitud');
    $longitud = $request->getParam('longitud');
    $conductor_id = $request->getParam('conductor_id');
    $usuario_id = $request->getParam('usuario_id');
    // $fecha_hora = $request->getParam('fecha_hora');
    $ruta_evidencia = $request->getParam('ruta_evidencia');
    $qr = $request->getParam('qr');

    $sql = "INSERT INTO evidencias
        (ruta_id, tipo_evidencia, comentarios, latitud, longitud, conductor_id, usuario_id, ruta_evidencia, qr)
        VALUES (:ruta_id, :tipo_evidencia, :comentarios, :latitud, :longitud, :conductor_id, :usuario_id,  :ruta_evidencia, :qr)
        ";
    try{
      $db = new DataBase();
      $db = $db->DBconnection();
      $resultado = $db->prepare($sql);

      $resultado->bindParam(':ruta_id', $ruta_id);
      $resultado->bindParam(':tipo_evidencia', $tipo_evidencia);
      $resultado->bindParam(':comentarios', $comentarios);
      $resultado->bindParam(':latitud', $latitud);
      $resultado->bindParam(':longitud', $longitud);
      $resultado->bindParam(':conductor_id', $conductor_id);
      $resultado->bindParam(':usuario_id', $usuario_id);
      $resultado->bindParam(':qr', $qr);
    //   $resultado->bindParam(':fecha_hora', $fecha_hora);
      $resultado->bindParam(':ruta_evidencia', $ruta_evidencia);

      $resultado->execute();
      echo json_encode("{'code': 200}");

      $resultado = null;
      $db = null;
    }catch(PDOException $e){
      echo '{"error" : {"text":'.$e->getMessage().'}';
    }
}); 