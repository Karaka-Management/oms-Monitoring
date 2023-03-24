<?php
/**
 * Karaka
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

/**
 * @var \phpOMS\Views\View $this
 */

$logger = $this->getData('logger');

$log = $logger->getByLine((int) $this->request->getData('id') ?? 1);

$details = '* Uri: `' . \trim($log[8] ?? '') . "`\n"
    . '* Level: `' . \trim($log[1] ?? '') . "`\n"
    . '* File: `' . \trim($log[8] ?? '') . "`\n"
    . '* Line: `' . \trim($log[3] ?? '') . "`\n"
    . '* Version: `' . \trim($log[4] ?? '') . "`\n"
    . '* OS: `' . \trim($log[5] ?? '') . "`\n\n"
    . "**Message:**\n\n```\n" . \trim($log[7] ?? '') . "\n```\n\n"
    . "**Backtrace:**\n\n```\n" . \json_encode(\json_decode($log[9] ?? '{}'), \JSON_PRETTY_PRINT) . "\n";

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Logs'); ?></div>
            <div class="portlet-body">
                <div class="form-group">
                    <label><i class="fa fa-anchor"></i> <?= $this->getHtml('ID', '0', '0'); ?></label>
                    <label><?= $this->printHtml((string) ($this->request->getData('id') ?? 0)); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-clock-o"></i <?= $this->getHtml('Time'); ?>></label>
                    <label><?= $this->printHtml($log[0] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-globe"></i> <?= $this->getHtml('Uri'); ?></label>
                    <label><?= $this->printHtml($log[8] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-wifi"></i> <?= $this->getHtml('Source'); ?></label>
                    <label><?= $this->printHtml($log[2] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-<?= $this->printHtml(\in_array($log[1] ?? '', ['notice', 'info', 'debug']) ? 'info-circle' : 'warning'); ?>"></i> <?= $this->getHtml('Level'); ?></label>
                    <label><?= $this->printHtml($log[1] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-commenting"></i> <?= $this->getHtml('Message'); ?></label>
                    <label><?= $this->printHtml($log[7] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-file-o"></i> <?= $this->getHtml('File'); ?></label>
                    <label><?= $this->printHtml($log[8] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-commenting"></i> <?= $this->getHtml('Line'); ?></label>
                    <label><?= $this->printHtml($log[3] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-laptop"></i> <?= $this->getHtml('OS'); ?></label>
                    <label><?= $this->printHtml($log[5] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><i class="fa fa-pencil"></i> <?= $this->getHtml('Version'); ?></label>
                    <label><?= $this->printHtml($log[4] ?? ''); ?></label>
                </div>

                <div class="form-group">
                    <label><?= $this->getHtml('Backtrace'); ?></label>
                    <pre><?= $this->printHtml(\json_encode(\json_decode($log[9] ?? '{}'), \JSON_PRETTY_PRINT)); ?></pre>
                </div>
            </div>
            <div class="portlet-foot">
                <a tabindex="0" class="button" target="_blank"
                    href="https://github.com/Karaka-Management/Karaka/issues/new?body=<?= $this->printHtml(\rawurlencode($details)); ?>"><?= $this->getHtml('Report'); ?></a>
            </div>
        </section>
    </div>
</div>
