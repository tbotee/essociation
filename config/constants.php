<?php

return [
    'roles' => [
        'admin' => 1,
        'chairman' => 2,
        'superAdmin' => 3,
    ],
    'invitationStatus' => [
        'pending' => 0,
        'accepted' => 1,
        'rejected' => 2
    ],
    'associationCosts' => [
        'water' => 1,
        'wasteWater' => 2,
        'divideAcrossUnits' => 3,
        'divideAcrossApartments' => 4,
        'divideAcrossApartmentResidents' => 5,
    ],
    'readOnlyEaterMeterTypes' => [
        'associationMeter' => 'association-meter',
        'unitMeter' => 'unit-meter'
    ],
    'ownerType' => [
        'person' => 1,
        'company' => 2
    ]
];
