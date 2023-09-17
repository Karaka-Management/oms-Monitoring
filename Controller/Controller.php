<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Monitoring
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Monitoring\Controller;

use Modules\Monitoring\Models\ImpressionStat;
use Modules\Monitoring\Models\ImpressionStatMapper;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Module\ModuleAbstract;

/**
 * Monitoring controller class.
 *
 * @package Modules\Monitoring
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Controller extends ModuleAbstract
{
    /**
     * Module path.
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__ . '/../';

    /**
     * Module version.
     *
     * @var string
     * @since 1.0.0
     */
    public const VERSION = '1.0.0';

    /**
     * Module name.
     *
     * @var string
     * @since 1.0.0
     */
    public const NAME = 'Monitoring';

    /**
     * Module id.
     *
     * @var int
     * @since 1.0.0
     */
    public const ID = 1000700000;

    /**
     * Providing.
     *
     * @var string[]
     * @since 1.0.0
     */
    public static array $providing = [];

    /**
     * Dependencies.
     *
     * @var string[]
     * @since 1.0.0
     */
    public static array $dependencies = [];

    public function helperLogRequestStat(HttpRequest $request) : void
    {
        if (!$this->active) {
            return;
        }

        $stat = new ImpressionStat($request);

        // This is not run through the createModel() function on purpose
        ImpressionStatMapper::create()->execute($stat);
    }
}
