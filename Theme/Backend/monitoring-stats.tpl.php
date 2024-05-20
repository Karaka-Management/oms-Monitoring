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

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6" >
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Daily'); ?></div>
            <div class="portlet-body">
                <canvas class="chart" id="impressions-daily"
                    data-chart='{
                        "type": "line",
                        "data": {
                            "labels": [
                                <?php $data = []; foreach ($this->data['stats']['impressions'] as $key => $value) { $data[] = '"' . $key . '"'; } echo \implode(',', $data); ?>
                            ],
                            "datasets": [
                                {
                                    "label": "<?= $this->getHtml('Daily'); ?>",
                                    "type": "line",
                                    "data": [
                                        <?php $data = []; foreach ($this->data['stats']['impressions'] as $value) { $data[] = $value[0]; } echo \implode(',', $data); ?>
                                    ],
                                    "fill": false,
                                    "borderColor": "rgb(255, 99, 132)",
                                    "backgroundColor": "rgb(255, 99, 132)",
                                    "tension": 0.0
                                }
                            ]
                        },
                        "options": {
                            "plugins": {
                                "legend": {
                                    "display": false
                                }
                            },
                            "title": {
                                "display": false,
                                "text": "<?= $this->getHtml('Daily'); ?>"
                            },
                            "scales": {
                                "x": {
                                    "id": "axis-1",
                                    "display": true
                                },
                                "y": {
                                    "id": "axis-2",
                                    "display": true,
                                    "position": "left",
                                    "beginAtZero": true,
                                    "ticks": {
                                        "stepSize": 1
                                    }
                                }
                            }
                        }
                }'></canvas>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
    <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Country'); ?></div>
            <div class="portlet-body">
                <canvas class="chart" id="country-daily"
                    data-chart='{
                        "type": "bar",
                        "data": {
                            "labels": [
                                <?php $data = []; foreach ($this->data['stats']['impressions'] as $key => $value) { $data[] = '"' . $key . '"'; } echo \implode(',', $data); ?>
                            ],
                            "datasets": [
                                <?php $c = 0; foreach ($this->data['stats']['country'] as $country => $values) : ++$c; ?>
                                <?= $c > 1 ? ',' : ''; ?>
                                {
                                    "label": "<?= $this->printHtml($country); ?>",
                                    "type": "bar",
                                    "data": [
                                        <?php $data = []; foreach ($this->data['stats']['impressions'] as $key => $value) { $data[] = $values[$key] ?? 0; } echo \implode(',', $data); ?>
                                    ]
                                }
                                <?php endforeach; ?>
                            ]
                        },
                        "options": {
                            "responsive": true,
                            "title": {
                                "display": false,
                                "text": "<?= $this->getHtml('Country'); ?>"
                            },
                            "scales": {
                                "x": {
                                    "id": "axis-1",
                                    "display": true,
                                    "stacked": true
                                },
                                "y": {
                                    "id": "axis-2",
                                    "display": true,
                                    "position": "left",
                                    "beginAtZero": true,
                                    "ticks": {
                                        "stepSize": 1
                                    },
                                    "stacked": true
                                }
                            }
                        }
                }'></canvas>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6" >
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Browser'); ?></div>
            <div class="portlet-body">
                <canvas class="chart" id="browser-pie"
                    data-chart='{
                        "type": "pie",
                        "data": {
                            "labels": [
                                <?php $data = []; foreach ($this->data['stats']['browser'] as $key => $value) { $data[] = '"' . $key . '"'; } echo \implode(',', $data); ?>
                            ],
                            "datasets": [
                                {
                                    "label": "<?= $this->getHtml('Browser'); ?>",
                                    "type": "pie",
                                    "data": [
                                        <?php $data = []; foreach ($this->data['stats']['browser'] as $value) { $data[] = $value[0]; } echo \implode(',', $data); ?>
                                    ]
                                }
                            ]
                        },
                        "options": {
                            "responsive": true,
                            "title": {
                                "display": false,
                                "text": "<?= $this->getHtml('Browser'); ?>"
                            }
                        }
                }'></canvas>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Domain'); ?></div>
            <div class="portlet-body">
                <canvas class="chart" id="domain-daily"
                    data-chart='{
                        "type": "bar",
                        "data": {
                            "labels": [
                                <?php $data = []; foreach ($this->data['stats']['impressions'] as $key => $value) { $data[] = '"' . $key . '"'; } echo \implode(',', $data); ?>
                            ],
                            "datasets": [
                                <?php $c = 0; foreach ($this->data['stats']['domain'] as $host => $values) : ++$c; ?>
                                <?= $c > 1 ? ',' : ''; ?>
                                {
                                    "label": "<?= $this->printHtml($host); ?>",
                                    "type": "bar",
                                    "data": [
                                        <?php $data = []; foreach ($this->data['stats']['impressions'] as $key => $value) { $data[] = $values[$key] ?? 0; } echo \implode(',', $data); ?>
                                    ]
                                }
                                <?php endforeach; ?>
                            ]
                        },
                        "options": {
                            "responsive": true,
                            "title": {
                                "display": false,
                                "text": "<?= $this->getHtml('Domain'); ?>"
                            },
                            "scales": {
                                "x": {
                                    "id": "axis-1",
                                    "display": true,
                                    "stacked": true
                                },
                                "y": {
                                    "id": "axis-2",
                                    "display": true,
                                    "position": "left",
                                    "beginAtZero": true,
                                    "ticks": {
                                        "stepSize": 1
                                    },
                                    "stacked": true
                                }
                            }
                        }
                }'></canvas>
            </div>
        </section>
    </div>
</div>