<?php

return [
    'component.cache' => [
        'class' => yii\caching\ApcCache::class,
    ],
    'component.view' => [
        'class' => rmrevin\yii\minify\View::class,
    ],
];
