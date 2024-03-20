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

$logs = \array_reverse($logger->get(25), true);

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Modules'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('Timestamp'); ?>
                    <td><?= $this->getHtml('Level'); ?>
                    <td><?= $this->getHtml('Source'); ?>
                    <td class="wf-100"><?= $this->getHtml('Message'); ?>
                <tbody>
                        <?php foreach ($logs as $key => $value) :
                        $url = \phpOMS\Uri\UriFactory::build('{/base}/admin/monitoring/log/view?{?}&id=' . $key); ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href=<?= $url; ?>><i class="g-icon">schedule</i> <?= $this->printHtml($value[0] ?? ''); ?></a>
                    <td><a href=<?= $url; ?>><i class="g-icon"><?= $this->printHtml(\in_array($value[1], ['notice', 'info', 'debug']) ? 'info' : 'warning'); ?></i> <?= $this->printHtml($value[1] ?? ''); ?></a>
                    <td><a href=<?= $url; ?>><i class="g-icon">wifi</i> <?= $this->printHtml($value[2] ?? ''); ?></a>
                    <td><a href=<?= $url; ?>><i class="g-icon">chat</i> <?= $this->printHtml($value[7] ?? ''); ?></a>
                        <?php endforeach;
                        if (!isset($key)) : ?>
                <tr>
                    <td colspan="4">
                        <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>
