<?php
/**
 * Created by IntelliJ IDEA.
 * User: bakyt
 * Date: 7/20/18
 * Time: 3:29 PM
 */

namespace App\Console\Commands;


use App\Classes\Socket\NoticeSocket;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class NoticeServer extends Command
{
    protected $signature='notice_server:serve';
    protected $description='Command description';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle(){
        $this->info('start server');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new NoticeSocket()
                )
            ),
            8080
        );
        $server->run();
    }
}