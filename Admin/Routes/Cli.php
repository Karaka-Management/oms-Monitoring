<?php
declare(strict_types=1);

use phpOMS\Router\RouteVerb;

return [
    '^.*/admin/monitoring/log.*$' => [
        [
            'dest' => '\Modules\Monitoring\Controller\CliController:cliLogReport',
            'verb' => RouteVerb::PUT,
        ],
    ],
];
