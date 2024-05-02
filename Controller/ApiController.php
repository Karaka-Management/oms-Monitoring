<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Monitoring
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Monitoring\Controller;

/**
 * Monitoring api controller class.
 *
 * @package Modules\Monitoring
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @feature Implement integrity check based on installed version and remote hash list (see monitoring-security.tpl.php)
 *      https://github.com/Karaka-Management/oms-Monitoring/issues/3
 *
 * @feature If a user has all sub permissions instead of the parent permission with a wildcard for the child permissions.
 *      https://github.com/Karaka-Management/oms-Monitoring/issues/6
 */
final class ApiController extends Controller
{
}
