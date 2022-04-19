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

use phpOMS\System\SystemUtils;

$logger      = $this->getData('logger');
$logs        = $logger->countLogs();
$penetrators = $logger->getHighestPerpetrator();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('System'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->getHtml('OS'); ?><td><?= $this->printHtml(\php_uname('s')); ?>
                        <tr><td><?= $this->getHtml('Version'); ?><td><?= $this->printHtml(\php_uname('v')); ?>
                        <tr><td><?= $this->getHtml('Release'); ?><td><?= $this->printHtml(\php_uname('r')); ?>
                        <tr><td><?= $this->getHtml('RAMUsage'); ?><td><?= $this->printHtml((string) (\memory_get_usage(true) / (1024 * 1024))); ?> MB
                        <tr><td><?= $this->getHtml('MemoryLimit'); ?><td><?= $this->printHtml(\ini_get('memory_limit')); ?>
                        <tr><td><?= $this->getHtml('SystemRAM'); ?><td><?= $this->printHtml((string) (SystemUtils::getRAM() / (1024))); ?> MB
                        <tr><td><?= $this->getHtml('CPUUsage'); ?><td><?= $this->printHtml((string) SystemUtils::getCpuUsage()); ?>%
                        <tr><td><?= $this->printHtml('User'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('whoami', '')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('Directory'); ?><td><?= $this->printHtml(\realpath(__DIR__ . '/../../../../')); ?>
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('PHP'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->printHtml('PHP'); ?><td><?= $this->printHtml(\PHP_VERSION); ?>
                        <tr><td><?= $this->printHtml('mbstring'); ?><td><?= $this->printHtml((string) \phpversion('mbstring')); ?>
                        <tr><td><?= $this->printHtml('imap'); ?><td><?= $this->printHtml((string) \phpversion('imap')); ?>
                        <tr><td><?= $this->printHtml('bcmath'); ?><td><?= $this->printHtml((string) \phpversion('bcmath')); ?>
                        <tr><td><?= $this->printHtml('xdebug'); ?><td><?= $this->printHtml((string) \phpversion('xdebug')); ?>
                        <tr><td><?= $this->printHtml('memcached'); ?><td><?= $this->printHtml((string) \phpversion('memcached')); ?>
                        <tr><td><?= $this->printHtml('redis'); ?><td><?= $this->printHtml((string) \phpversion('redis')); ?>
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Tools'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->printHtml('pdftotext'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('pdftotext', '-v')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('pdftoppm'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('pdftoppm', '-v')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('tesseract'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('tesseract', '-v')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('apache2'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('apache2', '-v')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('mysql'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('mysql', '--version')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('postgresql'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('psql', '--version')[0] ?? '')); ?>
                        <tr><td><?= $this->printHtml('sqlsrv'); ?><td><?= $this->printHtml((string) (SystemUtils::runProc('sqlsrv', '--version')[0] ?? '')); ?>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Logs'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                    <tr><td><?= $this->getHtml('Emergencies'); ?><td><?= $this->printHtml((string) ($logs['emergency'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Criticals'); ?><td><?= $this->printHtml((string) ($logs['critical'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Errors'); ?><td><?= $this->printHtml((string) ($logs['error'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Warnings'); ?><td><?= $this->printHtml((string) ($logs['warning'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Alerts'); ?><td><?= $this->printHtml((string) ($logs['alert'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Notices'); ?><td><?= $this->printHtml((string) ($logs['notice'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Info'); ?><td><?= $this->printHtml((string) ($logs['info'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Debug'); ?><td><?= $this->printHtml((string) ($logs['debug'] ?? 0)); ?>
                    <tr><td><?= $this->getHtml('Total'); ?><td><?= $this->printHtml((string) \array_sum($logs)); ?>
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Penetrators'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                    <?php foreach ($penetrators as $ip => $count) : ?>
                    <tr><td><?= $this->printHtml($ip); ?><td><?= $this->printHtml((string) $count); ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </section>
    </div>
</div>