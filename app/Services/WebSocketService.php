<?php
    namespace App\Services;
    use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
    use Illuminate\Support\Facades\Log;
    use Swoole\Http\Request;
    use Swoole\WebSocket\Frame;
    use Swoole\WebSocket\Server;

    class WebSocketService implements WebSocketHandlerInterface{

        public function __construct()
        {
        }

        public function onOpen(Server $server, Request $request)
        {
            Log::info('WebSocket 连接');
           // echo "server: handshake success with fd{$request->fd}\n";
            //$server->push($request->fd, 'Welcome to WebSocket Server built on LaravelS');
            // TODO: Implement onOpen() method.
        }

        public function onMessage(Server $server, Frame $frame)
        {
           // echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            Log::info("从 {$frame->fd} 接收到的数据: {$frame->data}");
            foreach ($server->connections as $fd) {
                if (!$server->isEstablished($fd)) {
                    // 如果连接不可用则忽略
                    continue;
                }
                $server->push($fd, $frame->data); // 服务端通过 push 方法向所有客户端广播消息
            }
            // TODO: Implement onMessage() method.
        }

        public function onClose(Server $server, $fd, $reactorId)
        {
            Log::info('WebSocket 连接关闭');
            // TODO: Implement onClose() method.
        }
    }