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

use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\Rest;
use phpOMS\Uri\HttpUri;

/**
 * @var \phpOMS\Views\View $this
 */

$files = new \phpOMS\System\File\Local\Directory(__DIR__ . '/../../../../phpOMS', '^.+\.php$');

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="box col-xs-12 wf-100">
        <div class="slider">
        <table class="default sticky">
            <caption><?= $this->getHtml('Files'); ?><i class="g-icon end-xs download btn">download</i></caption>
            <thead>
            <tr>
                <td class="wf-100"><?= $this->getHtml('File'); ?>
                <td><?= $this->getHtml('Unicode'); ?>
                <td><?= $this->getHtml('Deprecated'); ?>
                <td><?= $this->getHtml('Integrity'); ?>
                    <tbody>
                    <?php foreach ($files as $key => $file) : $source = \file_get_contents($file); ?>
            <tr>
                <td><?= $file; ?>
                <td><?= \phpOMS\Security\PhpCode::hasUnicode($source); ?>
                <td><?= \phpOMS\Security\PhpCode::hasDeprecatedFunction($source); ?>
                <td><?= \phpOMS\Security\PhpCode::validateFileIntegrity(
                        $file,
                        \md5(
                            Rest::request(
                                new HttpRequest(
                                    new HttpUri('https://raw.githubusercontent.com/Karaka-Management/phpOMS/develop/Account/Account.php')
                                )
                            )->getBody()
                        )
                    ); ?>
                    <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>
