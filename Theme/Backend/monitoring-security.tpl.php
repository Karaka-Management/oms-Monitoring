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

use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\Rest;
use phpOMS\Security\PhpCode;
use phpOMS\System\File\Local\Directory;
use phpOMS\System\File\Local\File;
use phpOMS\Uri\HttpUri;

$fileHashs = \file_get_contents(__DIR__ . '/../../../../hashs.txt'); /* Rest::request(
    new HttpRequest(
        new HttpUri('https://raw.githubusercontent.com/Karaka-Management/Build/master/hashs.txt')
    )
)->getBody(); */

$hashs = [];
$fp    = \fopen("php://memory", 'r+');
\fwrite($fp, $fileHashs);
\rewind($fp);

while($line = \fgets($fp)){
  $line = \trim($line);
  if ($line === '') {
      continue;
  }

  $whitespace = \stripos($line, ' ');
  $length     = \strlen($line);
  $hash       = \substr($line, 0, $whitespace);
  $file       = \trim(\substr($line, $whitespace + 2), '.\\/');

  $hashs[$file] = $hash;
}
\fclose($fp);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('PHPSettings'); ?></div>
            <div class="portlet-body">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->getHtml('DisabledFunctions'); ?><td><?= PhpCode::isDisabled(PhpCode::$disabledFunctions) ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <tr><td><button><?= $this->getHtml('Inspect'); ?></button>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Inspection'); ?><i class="fa fa-download floatRight download btn"></i></div>
            <div class="slider">
            <table id="fileList" class="default">
                <thead>
                <tr>
                    <td><?= $this->getHtml('Status'); ?>
                        <label for="fileList-sort-1">
                            <input type="radio" name="fileList-sort" id="fileList-sort-1">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="fileList-sort-2">
                            <input type="radio" name="fileList-sort" id="fileList-sort-2">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td class="wf-100"><?= $this->getHtml('File'); ?>
                        <label for="fileList-sort-3">
                            <input type="radio" name="fileList-sort" id="fileList-sort-3">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="fileList-sort-4">
                            <input type="radio" name="fileList-sort" id="fileList-sort-4">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td><?= $this->getHtml('Unicode'); ?>
                        <label for="fileList-sort-5">
                            <input type="radio" name="fileList-sort" id="fileList-sort-5">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="fileList-sort-6">
                            <input type="radio" name="fileList-sort" id="fileList-sort-6">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td><?= $this->getHtml('Deprecated'); ?>
                        <label for="fileList-sort-7">
                            <input type="radio" name="fileList-sort" id="fileList-sort-7">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="fileList-sort-8">
                            <input type="radio" name="fileList-sort" id="fileList-sort-8">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td><?= $this->getHtml('Modified'); ?>
                        <label for="fileList-sort-9">
                            <input type="radio" name="fileList-sort" id="fileList-sort-9">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="fileList-sort-10">
                            <input type="radio" name="fileList-sort" id="fileList-sort-10">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                    <td><?= $this->getHtml('Integrity'); ?>
                        <label for="fileList-sort-11">
                            <input type="radio" name="fileList-sort" id="fileList-sort-11">
                            <i class="sort-asc fa fa-chevron-up"></i>
                        </label>
                        <label for="fileList-sort-12">
                            <input type="radio" name="fileList-sort" id="fileList-sort-12">
                            <i class="sort-desc fa fa-chevron-down"></i>
                        </label>
                        <label>
                            <i class="filter fa fa-filter"></i>
                        </label>
                <tbody>
                        <?php
                        $files                               = Directory::listByExtension(__DIR__ . '/../../../../phpOMS/', 'php', 'tests(\/|\\\)');
                        foreach ($files as $file) : $content = \file_get_contents(__DIR__ . '/../../../../phpOMS/' . $file); ?>
                        <tr>
                            <td><?= ($unicode = PhpCode::hasUnicode($content)) || ($deprecated = PhpCode::hasDeprecatedFunction($content)) || !($integrity = PhpCode::validateFileIntegrity(
                                    __DIR__ . '/../../../../phpOMS/' . $file,
                                    $hashs['phpOMS/' . $file] ?? ''
                                )) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= $file; ?>
                            <td><?= $unicode ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= $deprecated ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../phpOMS/' . $file)->format('Y-m-d'); ?>
                            <td><?= $integrity ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <?php endforeach; ?>
                        <?php
                        $files                               = Directory::listByExtension(__DIR__ . '/../../../../Model/', 'php', 'tests(\/|\\\)');
                        foreach ($files as $file) : $content = \file_get_contents(__DIR__ . '/../../../../Model/' . $file); ?>
                        <tr>
                            <td><?= ($unicode = PhpCode::hasUnicode($content)) || ($deprecated = PhpCode::hasDeprecatedFunction($content)) || !($integrity = PhpCode::validateFileIntegrity(
                                    __DIR__ . '/../../../../Model/' . $file,
                                    $hashs['Model/' . $file] ?? ''
                                )) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= $file; ?>
                            <td><?= $unicode ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= $deprecated ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../Model/' . $file)->format('Y-m-d'); ?>
                            <td><?= $integrity ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <?php endforeach; ?>
                        <?php
                        $files = Directory::listByExtension(__DIR__ . '/../../../../Modules/', 'php', 'tests(\/|\\\)');
                        foreach ($files as $file) :
                            $content = \file_get_contents(__DIR__ . '/../../../../Modules/' . $file);
                        ?>
                        <tr>
                            <td><?= ($unicode = PhpCode::hasUnicode($content)) || ($deprecated = PhpCode::hasDeprecatedFunction($content)) || !($integrity = PhpCode::validateFileIntegrity(
                                    __DIR__ . '/../../../../Modules/' . $file,
                                    $hashs['Modules/' . $file] ?? ''
                                )) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= $file; ?>
                            <td><?= $unicode ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= $deprecated ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../Modules/' . $file)->format('Y-m-d'); ?>
                            <td><?= $integrity ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <?php endforeach; ?>
            </table>
            </div>
        </div>
    </div>
</div>
