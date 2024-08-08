<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\App;

class Chat implements MessageComponentInterface {
  protected $users;
  protected $connections;

  public function __construct(){
    $this->connections = [];
  }

  public function onOpen(ConnectionInterface $conn) {
    $this->connections[$conn->resourceId] = $conn;
    echo "user ($conn->remoteAddress) connected to server. \n";
  }

  /* public function onMessage(ConnectionInterface $from, $msg) { */
  /*   $data = json_decode($msg, true); */
  /**/
  /*   if(!isset($data["receiverId"]) && !isset($data["message"])){ */
      /* return an error */
  /*     return; */
  /*   } */
  /**/
  /*   $receiverId = $data["receiverId"]; */
  /*   $message = $data["message"]; */
  /*   $messageSent = false; */
  /**/
  /* foreach ($this->connections as $connection){ */
  /*   if($connection->resourceId){ */
  /*     echo ""; */
  /*   } */
  /* } */
  public function onMessage(ConnectionInterface $from, $msg){
    echo var_dump($this->connections);   
  }

  public function onClose(ConnectionInterface $conn) {
    $this->users->detach($conn);
    echo "user ($conn->remoteAddress) disconnected to server. \n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e) {
    echo "error \n";
  }
}

$app = new App('localhost', 8080);
$app->route('/chat', new Chat, array('*'));
$app->run();
?>
