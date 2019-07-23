<?php

namespace common\modules\ws\controllers;

use common\modules\ws\component\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

/**
 * Default controller for the `ws` module
 */
class DefaultController extends \yii\console\Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            9090
        );

        echo 'starting server'.PHP_EOL;

        $server->run();

        echo 'stop server'.PHP_EOL;
    }
}
