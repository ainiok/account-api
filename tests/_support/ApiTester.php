<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/

use Codeception\Util\Fixtures;

class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    /**
     * Define custom actions here
     */
    public $module = '';

    public $faker;
    public $safePassword;
    public $specialChar = '\">()=?#|\'&;%</';
    // admin
    public $adminUid;
    public $adminEmail;
    public $adminPwd;

    // user
    public $userUid;
    public $userName;
    public $userEmail;
    public $userPwd;
    public $userPhone;

    public function __construct(\Codeception\Scenario $scenario)
    {
        parent::__construct($scenario);
        $this->faker = Fixtures::get('faker');
        $this->safePassword = $this->faker->password . 'Api@1';

        // Admin
        $this->adminUid   = Fixtures::get('admin')['uid'];
        $this->adminEmail = Fixtures::get('admin')['email'];
        $this->adminPwd   = Fixtures::get('admin')['password'];
        // User
        $this->userUid   = Fixtures::get('user')['uid'];
        $this->userName  = Fixtures::get('user')['name'];
        $this->userEmail = Fixtures::get('user')['email'];
        $this->userPwd   = Fixtures::get('user')['password'];
//        $this->userPhone = Fixtures::get('user')['phone'];
    }

    /**
     * 随机生成admin
     *
     * @return array
     * @throws Exception
     */
    public function genRandomAdmin()
    {
        $I    = $this;
        $data = [
            'uid'      => uuid_gen(),
            'email'    => $I->faker->email,
            'password' => $I->adminPwd
        ];
        $I->haveRecord('admins', $data);
        return $data;
    }

    /**
     * 随机获取用户
     *
     * @return array
     * @throws Exception
     */
    public function genRandomUser()
    {
        $I    = $this;
        $data = [
            'uid'        => uuid_gen(),
            'name'       => $I->faker->name,
            'email'      => $I->faker->email,
            'password'   => bcrypt(md5($I->safePassword)),
            'phone'      => $I->faker->phoneNumber,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        $I->haveRecord('users', $data);
        return $data;
    }

    /**
     * 请求成功相应
     */
    public function seeSuccessResponseByJson()
    {
        $this->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $this->seeResponseIsJson();
    }

    /**
     * 请求失败相应
     */
    public function seeFailedResponseByJson()
    {
        $this->seeResponseCodeIs(Codeception\Util\HttpCode::BAD_REQUEST);
        $this->seeResponseIsJson();
        $this->seeResponseContainsJson(['success' => false]);
    }

    /**
     * 随机邮箱
     *
     * @return string
     */
    public function randEmail()
    {
        return str_random(8) . '@testapi.com';
    }

    public function wantTo($text)
    {
        parent::wantTo($this->module . $text);
    }

    public function expect($prediction)
    {
        parent::expect($this->module . $prediction);
    }
}
