<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Monitoring
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Monitoring\Controller;

use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\Mail\Email;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\NullView;

/**
 * Monitoring controller class.
 *
 * @package Modules\Monitoring
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class CliController extends Controller
{
    /**
     * Method which creates a workflow instance
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function cliLogReport(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $handler = $this->app->moduleManager->get('Admin', 'Api')->setUpServerMailHandler();

        $today = new \DateTime('now');

        $hasErrorReport = \is_file($file = __DIR__ . '/../../../Logs/' . $today->format('Y-m-d') . '.log');

        // @todo define report email template
        $mail   = new Email();
        $status = $this->app->moduleManager->get('Admin', 'Api')->setupEmailDefaults($mail);

        $mail->addTo($mail->from[0]);
        $mail->subject = 'Error report';

        if ($hasErrorReport) {
            $mail->body    = 'Your daily Error report.';
            $mail->bodyAlt = 'Your daily Error report.';

            $mail->addAttachment($file);
        } else {
            $mail->body    = 'No errors today.';
            $mail->bodyAlt = 'No errors today.';
        }

        if ($status) {
            $status = $handler->send($mail);
        }

        if (!$status) {
            \phpOMS\Log\FileLogger::getInstance()->error(
                \phpOMS\Log\FileLogger::MSG_FULL, [
                    'message' => 'Couldn\'t send error report mail',
                    'line'    => __LINE__,
                    'file'    => self::class,
                ]
            );
        }

        return new NullView();
    }
}
