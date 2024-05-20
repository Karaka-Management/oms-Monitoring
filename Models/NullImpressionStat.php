<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Monitoring\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Monitoring\Models;

/**
 * Impression stat class.
 *
 * @package Modules\Monitoring\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class NullImpressionStat extends ImpressionStat
{
    /**
     * Constructor
     *
     * @param int $id Model id
     *
     * @since 1.0.0
     */
    public function __construct(int $id = 0)
    {
        $this->id = $id;
    }
}