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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;
use phpOMS\Message\Statistic\ImpressionStat;

/**
 * Item mapper class.
 *
 * @package Modules\Monitoring\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of ImpressionStat
 * @extends DataMapperFactory<T>
 */
final class ImpressionStatMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'monitoring_request_id'          => ['name' => 'monitoring_request_id',          'type' => 'int',    'internal' => 'id'],
        'monitoring_request_host' => ['name' => 'monitoring_request_host', 'type' => 'string', 'internal' => 'host',],
        'monitoring_request_language' => ['name' => 'monitoring_request_language', 'type' => 'string', 'internal' => 'language',],
        'monitoring_request_country' => ['name' => 'monitoring_request_country', 'type' => 'string', 'internal' => 'country',],
        'monitoring_request_browser' => ['name' => 'monitoring_request_browser', 'type' => 'string', 'internal' => 'browser',],
        'monitoring_request_path' => ['name' => 'monitoring_request_path', 'type' => 'string', 'internal' => 'path',],
        'monitoring_request_uri' => ['name' => 'monitoring_request_uri', 'type' => 'string', 'internal' => 'uri',],
        'monitoring_request_referer' => ['name' => 'monitoring_request_referer', 'type' => 'string', 'internal' => 'referer',],
        'monitoring_request_agent' => ['name' => 'monitoring_request_agent', 'type' => 'string', 'internal' => 'agent',],
        'monitoring_request_datetime' => ['name' => 'monitoring_request_datetime', 'type' => 'int', 'internal' => 'datetime',],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'monitoring_request';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'monitoring_request_id';

    /**
     * Model to use by the mapper.
     *
     * @var class-string<T>
     * @since 1.0.0
     */
    public const MODEL = ImpressionStat::class;
}
