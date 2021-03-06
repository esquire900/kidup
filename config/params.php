<?php
return [
    'adminEmail' => 'admin@kidup.dk',
    'supportEmail' => 'support@kidup.dk',
    'helloEmail' => 'hello@kidup.dk',
    'simonEmail' => 'simon@kidup.dk',
    'chrisEmail' => 'christoffer@kidup.dk',
    'alexEmail' => 'alexander@kidup.dk',
    'philipEmail' => 'philip@kidup.dk',
    'rotationEmails' => [
        ['email' => 'alexander@kidup.dk', 'name' => 'Alexander'],
        ['email' => 'philip@kidup.dk', 'name' => 'Philip'],
        ['email' => 'christoffer@kidup.dk', 'name' => 'Christoffer'],
    ],
    'user.passwordResetTokenExpire' => 3600,
    'consoleWebAlias' => YII_ENV == 'dev' ? 'web/' : YII_ENV == 'test' ? '/' : '/',
    'uploadPath' => __DIR__ . "/../uploads/",
    'payinServiceFeePercentage' => 0.075, // equals to 6%
    'payoutServiceFeePercentage' => 0.075, // equals to 6%
    'serverTimeZone' => 'Europe/Copenhagen',
    'kidupAddressLine1' => 'Ceres Alle 1',
    'kidupAddressLine2' => '8000 Aarhus C, Denmark',
    'numberOfDaysForReview' => 14,
    'icon-framework' => 'fa',
    'appstore-google' => 'google',
    'appstore-ios' => 'ios',
    'kidup-account-id' => 142 // this is the user id of the account used to send out messages to users
];
