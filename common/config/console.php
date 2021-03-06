<?php
/**
 * console.php
 * @author Revin Roman http://phptime.ru
 */

$vendor_dir = realpath(dirname(dirname(__DIR__)) . '/vendor');

return [
    'vendorPath' => $vendor_dir,
    'extensions' => require($vendor_dir . '/yiisoft/extensions.php'),
];
