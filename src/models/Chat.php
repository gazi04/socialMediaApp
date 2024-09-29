<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;


    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}



/* class Chat implements MessageComponentInterface { */
/*   protected $clients; */
/*   protected $userConnections; */
/**/
/*   public function __construct(){ */
/*     $this->userConnections = []; */
/*     $this->clients = new \SplObjectStorage; */
/*   } */
/**/
/*   public function onOpen(ConnectionInterface $conn) { */
    /* $this->clients->attach($conn); */
    /* echo "New connection! ({$conn->resourceId})\n"; */
/**/
/*     // Assume user ID is passed as a query parameter */
/*     $query = $conn->httpRequest->getUri()->getQuery(); */
/*     parse_str($query, $params); */
/*     if (isset($params['user_id'])) { */
/*       $this->userConnections[$params['user_id']] = $conn; */
/*       echo $params['user_id']; */
/*     } */
/*   } */
/**/
/*   public function onMessage(ConnectionInterface $from, $msg){ */
/*     $data = json_decode($msg, true); */
/*     $recipientId = $data['recipient_id']; */
/*     $message = $data['message']; */
/**/
/*     if (isset($this->userConnections[$recipientId])) { */
/*       $recipientConnection = $this->userConnections[$recipientId]; */
/*       $recipientConnection->send(json_encode([ */
/*         'sender_id' => $from->resourceId, */
/*         'message' => $message */
/*       ])); */
/*     } */
/*   } */
/**/
/*   public function onClose(ConnectionInterface $conn) { */
/*     $this->clients->detach($conn); */
/*     foreach ($this->userConnections as $userId => $connection) { */
/*       if ($connection === $conn) { */
/*         unset($this->userConnections[$userId]); */
/*         break; */
/*       } */
/*     } */
/*     echo "Connection {$conn->resourceId} has disconnected\n"; */
/*   } */
/**/
/*   public function onError(ConnectionInterface $conn, \Exception $e) { */
/*     echo "An error has occurred: {$e->getMessage()}\n"; */
/*     $conn->close(); */
/*   } */
/* } */
?>
