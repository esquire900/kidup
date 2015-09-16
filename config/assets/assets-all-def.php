<?php
/**
 * This file is generated by the "yii asset" command.
 * DO NOT MODIFY THIS FILE DIRECTLY.
 * @version 2015-09-16 15:41:07
 */
return [
    'all' => [
        'class' => 'yii\\web\\AssetBundle',
        'basePath' => '@app/web/release-assets',
        'baseUrl' => '@web/release-assets',
        'js' => [
            'js/all-d948150317f12b59351b908ce981d68e.js',
        ],
        'css' => [
            'css/all-d10db2db7c698164e4393e02cc77bc43.css',
        ],
    ],
    'yii\\web\\JqueryAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'yii\\web\\YiiAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'all',
        ],
    ],
    'yii\\bootstrap\\BootstrapAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\assets\\FontAwesomeAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\assets\\GsdkAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\assets\\AppAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\YiiAsset',
            'yii\\bootstrap\\BootstrapAsset',
            'yii\\web\\JqueryAsset',
            'app\\assets\\FontAwesomeAsset',
            'app\\assets\\GsdkAsset',
            'all',
        ],
    ],
    '\\yii\\web\\JqueryAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    '\\app\\assets\\FullModalAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'yii\\bootstrap\\BootstrapAsset',
            'all',
        ],
    ],
    'app\\modules\\home\\assets\\HomeAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            '\\yii\\web\\JqueryAsset',
            '\\app\\assets\\FullModalAsset',
            'all',
        ],
    ],
    '\\yii\\jui\\JuiAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'all',
        ],
    ],
    '\\app\\assets\\DropZoneAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\item\\assets\\CreateAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            '\\yii\\web\\JqueryAsset',
            '\\yii\\jui\\JuiAsset',
            '\\app\\assets\\DropZoneAsset',
            'all',
        ],
    ],
    'app\\modules\\item\\assets\\ListAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\item\\assets\\MenuSearchAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'all',
        ],
    ],
    'app\\modules\\item\\assets\\ViewAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\JqueryAsset',
            'all',
        ],
    ],
    'app\\modules\\item\\assets\\ItemAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\message\\assets\\MessageAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\pages\\assets\\WpAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    '\\app\\assets\\AngularAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    '\\yii\\widgets\\PjaxAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'yii\\web\\YiiAsset',
            'all',
        ],
    ],
    'app\\modules\\search\\assets\\ItemSearchAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            '\\app\\assets\\AngularAsset',
            '\\yii\\web\\JqueryAsset',
            '\\yii\\jui\\JuiAsset',
            '\\yii\\widgets\\PjaxAsset',
            'all',
        ],
    ],
    'app\\modules\\user\\assets\\ProfileAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\user\\assets\\SettingsAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\booking\\assets\\ConfirmAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\booking\\assets\\BookingViewsAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
    'app\\modules\\review\\assets\\ReviewScoreAsset' => [
        'sourcePath' => null,
        'js' => [],
        'css' => [],
        'depends' => [
            'all',
        ],
    ],
];