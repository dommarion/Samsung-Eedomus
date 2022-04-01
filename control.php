<?php

include __DIR__ . '/settings.php';

$tvkey = 'KEY_MUTE';

require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$reactConnector = new \React\Socket\Connector($loop, array(
    'tls' => array(
        'verify_peer' => false,
        'verify_peer_name' => false
    ),
));
echo $tvtoken."\n";
echo $tvname."\n";
$connector = new \Ratchet\Client\Connector($loop, $reactConnector);

//$connector('wss://' . $tvip .':8002/api/v2/channels/samsung.remote.control?name=' . $tvname . '&token=' . $tvtoken)
$connector('wss://192.168.1.6:8002/api/v2/channels/samsung.remote.control?name=ZWVkb211cw==&token=59265565')
    ->then(function(Ratchet\Client\WebSocket $conn) {
        $conn->on('message', function(\Ratchet\RFC6455\Messaging\MessageInterface $msg) use ($conn) {
            echo "Received: {$msg}\n";
        $conn->send('{"method": "ms.remote.control", "params": {"Cmd": "Click", "DataOfCmd": "KEY_MUTE", "Option": "true", "TypeOfRemote": "SendRemoteKey"}}');
            $conn->close();
        });

        $conn->on('close', function($code = null, $reason = null) {
            echo "Connection closed ({$code} - {$reason})\n";
        });

        //$conn->send('Hello World!');
    }, function(\Exception $e) use ($loop) {
        echo "Could not connect: {$e->getMessage()}\n";
        $loop->stop();
    });

$loop->run();

echo "control.php";
var_dump(get_included_files());
?>
