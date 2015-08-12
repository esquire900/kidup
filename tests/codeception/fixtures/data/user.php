<?php

$time = time();

$user = [
    'admin' => [ // row #0
        'id' => 1,
        'email' => 'simon@kidup.dk',
        'password_hash' => '$2y$13$zSOTbjAPHZ7PloN466qJMO1DkCvLNsFLAdZEuKr/v.SbIh.xwLx4a',
        'auth_key' => 'uWfEsiaKTqukagQrRKxYFwnJ0wNRH88U',
        'confirmed_at' => null,
        'unconfirmed_email' => null,
        'blocked_at' => null,
        'registration_ip' => null,
        'flags' => 0,
        'status' => 0,
        'role' => 0,
        'created_at' => $time,
        'updated_at' => $time,
    ],
    'owner' => [ // row #1
        'id' => 2,
        'email' => 'owner@kidup.dk',
        'password_hash' => '$2y$13$zSOTbjAPHZ7PloN466qJMO1DkCvLNsFLAdZEuKr/v.SbIh.xwLx4a',
        'auth_key' => 'SP3bMc7frK4-IkXEsXpoeYEpDZqSN2oy',
        'confirmed_at' => 1433880679,
        'unconfirmed_email' => null,
        'blocked_at' => null,
        'registration_ip' => '192.168.33.1',
        'flags' => 0,
        'status' => 0,
        'role' => 0,
        'created_at' => $time,
        'updated_at' => $time,
    ],
    'renter' => [ // row #2
        'id' => 3,
        'email' => 'renter@kidup.dk',
        'password_hash' => '$2y$13$zSOTbjAPHZ7PloN466qJMO1DkCvLNsFLAdZEuKr/v.SbIh.xwLx4a',
        'auth_key' => 'TV9XJATdT2m43kSjy-j0Q6ykb-NtTbGz',
        'confirmed_at' => $time,
        'unconfirmed_email' => null,
        'blocked_at' => null,
        'registration_ip' => '192.168.33.1',
        'flags' => 0,
        'status' => 0,
        'role' => 0,
        'created_at' => $time,
        'updated_at' => $time,
    ],
    'blocked' => [ // row #2
        'id' => 4,
        'email' => 'iamblocked@kidup.dk',
        'password_hash' => '$2y$13$zSOTbjAPHZ7PloN466qJMO1DkCvLNsFLAdZEuKr/v.SbIh.xwLx4a',
        'auth_key' => 'TV9XJATdT2m43kSjy-j0Q6ykb-NtTbGz',
        'confirmed_at' => $time,
        'unconfirmed_email' => null,
        'blocked_at' => $time - 24*60*60,
        'registration_ip' => '192.168.33.1',
        'flags' => 0,
        'status' => 0,
        'role' => 0,
        'created_at' => $time,
        'updated_at' => $time,
    ],
    'no_location' => [ // row #2
        'id' => 5,
        'email' => 'ihavenolocation@kidup.dk',
        'password_hash' => '$2y$13$zSOTbjAPHZ7PloN466qJMO1DkCvLNsFLAdZEuKr/v.SbIh.xwLx4a',
        'auth_key' => 'TV9XJATdT2m43kSjy-j0Q6ykb-NtTbGz',
        'confirmed_at' => $time,
        'unconfirmed_email' => null,
        'blocked_at' => $time - 24*60*60,
        'registration_ip' => '192.168.33.1',
        'flags' => 0,
        'status' => 0,
        'role' => 0,
        'created_at' => $time,
        'updated_at' => $time,
    ],
    'user_with_recovery_token' => [ // row #2
        'id' => 6,
        'email' => 'ihavearecoverytoken@kidup.dk',
        'password_hash' => '$2y$13$zSOTbjAPHZ7PloN466qJMO1DkCvLNsFLAdZEuKr/v.SbIh.xwLx4a',
        'auth_key' => 'TV9XJATdT2m43kSjy-j0Q6ykb-NtTbGz',
        'confirmed_at' => $time,
        'unconfirmed_email' => null,
        'blocked_at' => $time - 24*60*60,
        'registration_ip' => '192.168.33.1',
        'flags' => 0,
        'status' => 0,
        'role' => 0,
        'created_at' => $time,
        'updated_at' => $time,
    ]
];
return $user;
