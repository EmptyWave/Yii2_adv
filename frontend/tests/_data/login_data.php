<?php
return [
  [
    'id' => 1,
    'username' => 'erau',
    'auth_key' => 'tUu1qHcde0diwUol3xeI-18MuHkkprQI',
    // password_0
    'password_hash' => \Yii::$app->security->generatePasswordHash('erau'),
    'password_reset_token' => 'RkD_Jw0_8HEedzLk7MM-ZKEFfYR7VbMr_1392559490',
    'created_at' => '1392559490',
    'updated_at' => '1392559490',
    'email' => 'sfriesen@jenkins.info',
    'phone' => '89998889988',
  ],
  [
    'id' => 2,
    'username' => 'test.test',
    'auth_key' => 'O87GkY3_UfmMHYkyezZ7QLfmkKNsllzT',
    // Test1234
    'password_hash' => \Yii::$app->security->generatePasswordHash('test.test'),
    'email' => 'test@mail.com',
    'status' => '9',
    'created_at' => '1548675330',
    'updated_at' => '1548675330',
    'verification_token' => '4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330',
    'phone' => '89998889988',
  ],
];
