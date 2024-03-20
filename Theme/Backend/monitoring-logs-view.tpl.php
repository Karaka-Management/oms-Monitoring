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

/**
 * @var \phpOMS\Views\View $this
 */

$logger = $this->data['logger'];

$log = $logger->getByLine((int) $this->request->getData('id') ?? 1);

$details = '* Uri: `' . \trim($log[6] ?? '') . "`\n"
    . '* Level: `' . \trim($log[1] ?? '') . "`\n"
    . '* File: `' . \trim($log[8] ?? '') . "`\n"
    . '* Line: `' . \trim($log[3] ?? '') . "`\n"
    . '* Version: `' . \trim($log[4] ?? '') . "`\n"
    . '* OS: `' . \trim($log[5] ?? '') . "`\n\n"
    . "**Message:**\n\n```\n" . \trim($log[7] ?? '') . "\n```\n\n"
    . "**Backtrace:**\n\n```\n" . \json_encode(\json_decode($log[9] ?? '{}'), \JSON_PRETTY_PRINT) . "\n";

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Logs'); ?></div>
            <div class="portlet-body">
                <div class="form-group">
                    <strong><label><i class="g-icon">anchor</i> <?= $this->getHtml('ID', '0', '0'); ?></label></strong>
                    <label><?= $this->printHtml((string) ($this->request->getData('id') ?? 0)); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">schedule</i> <?= $this->getHtml('Time'); ?></label></strong>
                    <label><?= $this->printHtml($log[0] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">public</i> <?= $this->getHtml('Uri'); ?></label></strong>
                    <label><?= $this->printHtml($log[6] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">wifi</i> <?= $this->getHtml('Source'); ?></label></strong>
                    <label><?= $this->printHtml($log[2] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon"><?= $this->printHtml(\in_array($log[1] ?? '', ['notice', 'info', 'debug']) ? 'info' : 'warning'); ?></i> <?= $this->getHtml('Level'); ?></label></strong>
                    <label><?= $this->printHtml($log[1] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">chat</i> <?= $this->getHtml('Message'); ?></label></strong>
                    <label><?= $this->printHtml($log[7] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">article</i> <?= $this->getHtml('File'); ?></label></strong>
                    <label><?= $this->printHtml($log[8] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">chat</i> <?= $this->getHtml('Line'); ?></label></strong>
                    <label><?= $this->printHtml($log[3] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">laptop_mac</i> <?= $this->getHtml('OS'); ?></label></strong>
                    <label><?= $this->printHtml($log[5] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><i class="g-icon">stylus</i> <?= $this->getHtml('Version'); ?></label></strong>
                    <label><?= $this->printHtml($log[4] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <strong><label><?= $this->getHtml('Backtrace'); ?></label></strong>
                    <pre><code><?= $this->printHtml(\json_encode(\json_decode($log[9] ?? '{}'), \JSON_PRETTY_PRINT)); ?></code></pre>
                </div>
            </div>
            <div class="portlet-foot">
                <a tabindex="0" class="button" target="_blank"
                    href="https://github.com/Karaka-Management/Karaka/issues/new?title=<?= \rawurlencode('[Log] '); ?>&body=<?= $this->printHtml(\rawurlencode($details)); ?>"><?= $this->getHtml('Report'); ?></a>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <blockquote class="hl-1">
            <?= $this->getHtml('WarningLogReport'); ?>
        </blockquote>
    </div>
</div>