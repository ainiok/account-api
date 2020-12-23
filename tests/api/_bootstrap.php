<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/23 11:20
 */

use Codeception\Util\Fixtures;

$faker = \Faker\Factory::create('zh_CN');
$password = 'Api-' . $faker->password;

Fixtures::add('faker', $faker);
Fixtures::add('admin', [
    'uid'        => uuid_gen(),
    'email'      => $faker->email,
    'password'   => $password,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
]);
Fixtures::add('user', [
    'uid'        => uuid_gen(),
    'name'       => $faker->name,
    'email'      => $faker->email,
    'password'   => $password,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
]);
