<?php 
require_once __DIR__ . '/Base.php';
class PostCest extends Base
{
    protected $postId;
    protected $post;
    public function _before(ApiTester $api, \Codeception\Module\Db $db)
    {
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->sendPOST('/login', ['username' => 'chenbo', 'password' => '123456']);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $result = json_decode($api->grabResponse(), true);
        $this->accessKey = $result['data']['accessKey'];
        $this->time = time();
    }

    public function testList(ApiTester $api, \Codeception\Module\Db $db){
        list($postId, $post) = $this->insertDemoData($db);
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->haveHttpHeader('Auth-Token', 'test');
        $api->sendGET("/post?{$this->generateParamUrl()}");
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '', 'data' => [$post] ]);
    }

    public function testUpdate(ApiTester $api, \Codeception\Module\Db $db){
        list($postId, $post) = $this->insertDemoData($db);
        $title = date('Y-m-d H:i:s') . '标题';
        $content = date('Y-m-d H:i:s') . '内容';
        $newPost = ['title' => $title, 'content' => $content];
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->haveHttpHeader('Auth-Token', 'test');
        $api->sendPUT("/post/{$postId}?{$this->generateParamUrl()}", $newPost);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '编辑保存成功', 'data' => []]);
    }

    public function testRead(ApiTester $api, \Codeception\Module\Db $db)
    {
        list($postId, $post) = $this->insertDemoData($db);
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->haveHttpHeader('Auth-Token', 'test');
        $api->sendGET("/post/{$postId}?{$this->generateParamUrl()}");
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '', 'data' => $post]);
    }

    public function testSave(ApiTester $api, \Codeception\Module\Db $db)
    {
        $title = date('Y-m-d H:i:s') . '标题';
        $content = date('Y-m-d H:i:s') . '内容';
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->haveHttpHeader('Auth-Token', 'test');
        $api->sendPOST("/post?{$this->generateParamUrl()}", ['title' => $title, 'content' => $content]);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $response = $this->getResult($api);
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '保存成功', 'data' => ['id' => $response['data']['id']]]);
    }

    private function insertDemoData($db){
        $post = ['title' => 'test title', 'content' => 'test content', 'create_time' => time(), 'update_time'=>time()];
        $postId = $db->haveInDatabase('post', $post);
        return [$postId, $post];
    }
}
