<?php 

class UserTestCest
{
    public function _before(ApiTester $I)
    {
        $I->module = '[用户]';
    }

    // tests
    public function getUser(ApiTester $I)
    {
        $I->wantTo('获取用户信息');
        $I->sendGet('/user/0b9f47e48cfc464ebe34a2cbae0e68c6');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'uid'        => 'string',
            'name'       => 'string',
            'email'      => 'string:email',
            'forbidden'  => 'boolean',
            'created_at' => 'string',
            'updated_at' => 'string',
        ]);
    }
}
