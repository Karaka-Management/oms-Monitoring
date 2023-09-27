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

use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Monitoring controller class.
 *
 * @package Modules\Monitoring
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewMonitoringGeneral(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Monitoring/Theme/Backend/monitoring-dashboard');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000706001, $request, $response);

        $view->data['logger'] = $this->app->logger;

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewStats(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $head  = $response->data['Content']->head;
        $nonce = $this->app->appSettings->getOption('script-nonce');

        $head->addAsset(AssetType::CSS, 'Resources/chartjs/Chartjs/chart.css');
        $head->addAsset(AssetType::JSLATE, 'Resources/chartjs/Chartjs/chart.js', ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Modules/ItemManagement/Controller.js', ['nonce' => $nonce, 'type' => 'module']);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Monitoring/Theme/Backend/monitoring-stats');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000706001, $request, $response);

        $view->data['stats'] = [];

        $query = new Builder($this->app->dbPool->get());
        $query->raw(
            'SELECT DATE(monitoring_request_datetime) as date, COUNT(*)
            FROM monitoring_request
            GROUP BY date(monitoring_request_datetime)
            ORDER BY date ASC;'
        );

        $view->data['stats']['impressions'] = $query->execute()?->fetchAll(\PDO::FETCH_COLUMN | \PDO::FETCH_GROUP) ?? [];

        $query = new Builder($this->app->dbPool->get());
        $query->raw(
            'SELECT DATE(monitoring_request_datetime) as date, monitoring_request_country as country, COUNT(*) as count
            FROM monitoring_request
            GROUP BY date(monitoring_request_datetime), monitoring_request_country
            ORDER BY date ASC;'
        );

        $view->data['stats']['country'] = [];

        $temp = $query->execute()?->fetchAll() ?? [];
        foreach ($temp as $t) {
            if (!isset($view->data['stats']['country'][$t['country']])) {
                $view->data['stats']['country'][$t['country']] = [];
            }

            $view->data['stats']['country'][$t['country']][$t['date']] = $t['count'];
        }

        $query = new Builder($this->app->dbPool->get());
        $query->raw(
            'SELECT monitoring_request_agent as agent, COUNT(*)
            FROM monitoring_request
            GROUP BY monitoring_request_agent;'
        );

        $view->data['stats']['browser'] = $query->execute()?->fetchAll(\PDO::FETCH_COLUMN | \PDO::FETCH_GROUP) ?? [];

        $query = new Builder($this->app->dbPool->get());
        $query->raw(
            'SELECT DATE(monitoring_request_datetime) as date, monitoring_request_host as host, COUNT(*) as count
            FROM monitoring_request
            GROUP BY date(monitoring_request_datetime), monitoring_request_host
            ORDER BY date ASC;'
        );

        $view->data['stats']['domain'] = [];

        $temp = $query->execute()?->fetchAll() ?? [];
        foreach ($temp as $t) {
            if (!isset($view->data['stats']['domain'][$t['host']])) {
                $view->data['stats']['domain'][$t['host']] = [];
            }

            $view->data['stats']['domain'][$t['host']][$t['date']] = $t['count'];
        }

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewMonitoringLogList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Monitoring/Theme/Backend/monitoring-logs');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000706001, $request, $response);

        $view->data['logger'] = $this->app->logger;

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewMonitoringLogEntry(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Monitoring/Theme/Backend/monitoring-logs-single');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000706001, $request, $response);

        $view->data['logger'] = $this->app->logger;

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewMonitoringSecurityDashboard(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Monitoring/Theme/Backend/monitoring-security');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000706001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewMonitoringSecurityFileList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Monitoring/Theme/Backend/monitoring-security');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000706001, $request, $response);

        return $view;
    }
}
