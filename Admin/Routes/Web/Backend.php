<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Monitoring\Controller\BackendController;
use Modules\Monitoring\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/admin/monitoring/general(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Monitoring\Controller\BackendController:viewMonitoringGeneral',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::DASHBOARD,
            ],
        ],
    ],
    '^/admin/monitoring/stats(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Monitoring\Controller\BackendController:viewStats',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::STATS,
            ],
        ],
    ],
    '^/admin/monitoring/log/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Monitoring\Controller\BackendController:viewMonitoringLogList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::LOG,
            ],
        ],
    ],
    '^/admin/monitoring/log/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Monitoring\Controller\BackendController:viewMonitoringLogEntry',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::LOG,
            ],
        ],
    ],
    '^/admin/monitoring/security/dashboard(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Monitoring\Controller\BackendController:viewMonitoringSecurityDashboard',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SECURITY,
            ],
        ],
    ],
    '^/admin/monitoring/security/file/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Monitoring\Controller\BackendController:viewMonitoringSecurityFileList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SECURITY,
            ],
        ],
    ],
];
