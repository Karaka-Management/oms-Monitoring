<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Monitoring
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
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
                </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-4">
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

    <div class="col-xs-12 col-md-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Penetrators'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                    <?php foreach ($penetrators as $ip => $count) : ?>
                    <tr><td><?= $this->printHtml($ip); ?><td><?= $this->printHtml($count); ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </section>
    </div>
</div>
