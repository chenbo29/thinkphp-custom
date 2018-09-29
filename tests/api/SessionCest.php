<?php 

class SessionCest extends Base
{
    public function _before(ApiTester $api)
    {
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->haveHttpHeader('Auth-Token', 'test');
    }

    public function testRegister(ApiTester $api)
    {
        $user = [
            'username' => $this->username,
            'password' => $this->password
        ];
        $api->sendPOST('/register', $user);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '注册成功']);
    }

    public function testLogin(ApiTester $api)
    {
        $user= [
            'username' => $this->username,
            'password' => $this->password
        ];
        $api->sendPOST('/login', $user);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '登陆成功']);
    }

    public function testLogout(ApiTester $api, \Codeception\Module\Redis $redis)
    {
        $this->initUserSession($redis);
        $api->sendGET("/logout?{$this->generateParamUrl()}");
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '会话信息已经注销']);
    }
}
