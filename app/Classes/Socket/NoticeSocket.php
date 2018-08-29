<?php
/**
 * Created by IntelliJ IDEA.
 * User: bakyt
 * Date: 7/20/18
 * Time: 3:21 PM
 */

namespace App\Classes\Socket;


use App\Classes\Socket\Base\BaseSocket;
use Ratchet\ConnectionInterface;

class NoticeSocket extends BaseSocket
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}