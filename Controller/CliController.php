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

use Modules\Admin\Models\SettingsEnum;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\Mail\Email;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\NullView;

/**
 * Monitoring controller class.
 *
 * @package Modules\Monitoring
 * @license OMS License 2.0
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

        /** @var \Model\Setting $emailSettings */
        $emailSettings = $this->app->appSettings->get(
            names: SettingsEnum::MAIL_SERVER_ADDR,
            module: 'Admin'
        );

        if (empty($emailSettings->content)) {
            return new NullView();
        }

        $today = new \DateTime('now');

        $hasErrorReport = \is_file($file = __DIR__ . '/../../../Logs/' . $today->format('Y-m-d') . '.log');

        // @todo define report email template
        $mail = new Email();
        $mail->setFrom($emailSettings->content);
        $mail->addTo($emailSettings->content);
        $mail->subject = 'Error report';

        if ($hasErrorReport) {
            $mail->body    = 'Your daily Error report.';
            $mail->bodyAlt = 'Your daily Error report.';

            $mail->addAttachment($file);
        } else {
            $mail->body    = 'No errors today.';
            $mail->bodyAlt = 'No errors today.';
        }

        $handler->send($mail);

        return new NullView();
    }
}
