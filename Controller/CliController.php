<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Monitoring
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Monitoring\Controller;

use Modules\Admin\Models\SettingsEnum;
use Modules\Admin\Models\AccountMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\Mail\Email;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\NullView;

/**
 * Monitoring controller class.
 *
 * @package Modules\Monitoring
 * @license OMS License 1.0
 * @link    https://karaka.app
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
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function cliLogReport(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        //return new NullView();

        /** @var array<string, \Model\Setting> $emailSettings */
        $emailSettings = $this->app->appSettings->get(
            names: [
                SettingsEnum::MAIL_SERVER_ADDR,
                SettingsEnum::MAIL_SERVER_CERT,
                SettingsEnum::MAIL_SERVER_KEY,
                SettingsEnum::MAIL_SERVER_KEYPASS,
                SettingsEnum::MAIL_SERVER_TLS,
            ],
            module: 'Admin'
        );

        /** @var \Modules\Admin\Models\Account $account */
        $account = AccountMapper::get()->where('id', 1)->execute();

        /** @var \phpOMS\Message\Mail\MailHandler $mailHandler */
        $mailHandler = $this->app->moduleManager->get('Admin', 'Api')->setUpServerMailHandler();

        $mail = new Email();
        $mail->setFrom($emailSettings[SettingsEnum::MAIL_SERVER_ADDR . '::Admin']->content, 'Karaka');
        $mail->addTo('spl1nes.com@googlemail.com', \trim($account->name1 . ' ' . $account->name2 . ' ' . $account->name3));
        $mail->subject = 'Log report';
        $mail->body    = '';
        $mail->msgHTML('Attached please find the daily log report');
        $mail->addAttachment(__DIR__ . '/../../../humans.txt');

        if (!empty($emailSettings[SettingsEnum::MAIL_SERVER_CERT . '::Admin']->content ?? '')
            && !empty($emailSettings[SettingsEnum::MAIL_SERVER_KEY . '::Admin']->content ?? '')
        ) {
            $mail->sign(
                $emailSettings[SettingsEnum::MAIL_SERVER_CERT . '::Admin']->content,
                $emailSettings[SettingsEnum::MAIL_SERVER_KEY . '::Admin']->content,
                $emailSettings[SettingsEnum::MAIL_SERVER_KEYPASS . '::Admin']->content
            );
        }

        $mailHandler->send($mail);

        return new NullView();
    }
}
