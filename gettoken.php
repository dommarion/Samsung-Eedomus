<?php

include __DIR__ . '/settings.php';

require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$reactConnector = new \React\Socket\Connector($loop, array(
  'tls' => array(
      'verify_peer' => false,
      'verify_peer_name' => false
  ),
));

$connector = new \Ratchet\Client\Connector($loop, $reactConnector);

$connector('wss://'. $tvip.':8002/api/v2/channels/samsung.remote.control?name=' . $tvname)
    ->then(function(Ratchet\Client\WebSocket $conn) {
        $conn->on('message', function(\Ratchet\RFC6455\Messaging\MessageInterface $msg) use ($conn) {
            echo "Received: {$msg}\n";
            $conn->close();
        });

        $conn->on('close', function($code = null, $reason = null) {
            echo "Connection closed ({$code} - {$reason})\n";
        });

    }, function(\Exception $e) use ($loop) {
        echo "Could not connect: {$e->getMessage()}\n";
        $loop->stop();
    });

$loop->run();
echo "gettoken.php";
var_dump(get_included_files());
?>
