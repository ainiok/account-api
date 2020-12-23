<?php

/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/23 11:58
 */

use Codeception\Util\Fixtures;
use Codeception\Events;

class FixtureExtension extends \Codeception\Extension
{
    // list events to listen to
    // Codeception\Events constants used to set the event

    public static $events = array(
        Events::SUITE_INIT         => 'initSuite',
        Events::SUITE_BEFORE       => 'beforeSuite',
        Events::SUITE_AFTER        => 'afterSuite',
        Events::TEST_BEFORE        => 'beforeTest',
        Events::STEP_BEFORE        => 'beforeStep',
        Events::STEP_AFTER         => 'afterStep',
        Events::TEST_FAIL          => 'testFailed',
        Events::RESULT_PRINT_AFTER => 'print',
    );

    // HOOK: Modules are created and initialized
    public function initSuite(\Codeception\Event\SuiteEvent $e)
    {
    }

    // HOOK: 每个测试案例前
    public function beforeSuite(\Codeception\Event\SuiteEvent $e)
    {
    }

    // HOOK: 每个测试案例之后
    public function afterSuite(\Codeception\Event\SuiteEvent $e)
    {
    }

    // HOOK: 每个测试函数前
    public function beforeTest(\Codeception\Event\TestEvent $e)
    {
        $db = $this->getModule('Db');
        // create admin
        $db->haveInDatabase('admins', self::transform(Fixtures::get('admin')));
        // create user
        $db->haveInDatabase('users', self::transform(Fixtures::get('user')));
    }

    // HOOK: 每个断言步骤前
    public function beforeStep(\Codeception\Event\StepEvent $e)
    {
    }

    // HOOK: 每个断言步骤后
    public function afterStep(\Codeception\Event\StepEvent $e)
    {
        $laravel = $this->getModule('Laravel5');
        $redis   = $laravel->app['redis'];
        if ($redis instanceof \Illuminate\Redis\RedisManager) {
            /**
             * @var \Illuminate\Redis\Connections\Connection
             */
            foreach ($redis->connections() ?: [] as $connection) {
                $connection->disconnect();
            }
        }
    }

    // HOOK: on fail
    public function testFailed(\Codeception\Event\FailEvent $e)
    {
    }

    // HOOK:
    public function print(\Codeception\Event\PrintResultEvent $e)
    {
    }

    protected function transform($params)
    {
        if (isset($params['password'])) {
            $params['password'] = password_hash(md5($params['password']), PASSWORD_BCRYPT);
        }
        return $params;
    }
}
