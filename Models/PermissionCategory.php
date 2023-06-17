<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Monitoring\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Monitoring\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\Monitoring\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class PermissionCategory extends Enum
{
    public const DASHBOARD = 1;

    public const LOG = 2;

    public const SECURITY = 3;
}
