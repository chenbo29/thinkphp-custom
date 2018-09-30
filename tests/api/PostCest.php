<?php 
require_once __DIR__ . '/Base.php';
class PostCest extends Base
{
    protected $postId;
    protected $post;

    public function _before(ApiTester $api, \Codeception\Module\Db $db, \Codeception\Module\Redis $redis)
    {
        $this->initUser($db);
        $this->initUserSession($redis);
        list($this->postId, $this->post) = $this->insertDemoData($db);
        $api->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $api->haveHttpHeader('Auth-Token', 'test');
    }

    public function testList(ApiTester $api){
        $api->sendGET("/post?{$this->generateParamUrl()}");
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '', 'data' => [$this->post] ]);
    }

    public function testUpdate(ApiTester $api){
        $title = date('Y-m-d H:i:s') . '标题';
        $content = date('Y-m-d H:i:s') . '内容';
        $newPost = ['title' => $title, 'content' => $content];
        $api->sendPUT("/post/{$this->postId}?{$this->generateParamUrl()}", $newPost);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '编辑保存成功', 'data' => []]);
    }

    public function testRead(ApiTester $api)
    {
        $api->sendGET("/post/{$this->postId}?{$this->generateParamUrl()}");
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '', 'data' => $this->post]);
    }

    public function testSave(ApiTester $api)
    {
        $title = date('Y-m-d H:i:s') . '标题';
        $content = date('Y-m-d H:i:s') . '内容';
        $api->sendPOST("/post?{$this->generateParamUrl()}", ['title' => $title, 'content' => $content]);
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '保存成功']);
    }

    public function testDelete(ApiTester $api)
    {
        $api->sendDELETE("/post/{$this->postId}?{$this->generateParamUrl()}");
        $api->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $api->seeResponseIsJson();
        $api->seeResponseContainsJson(['code' => \app\index\ResponseCode::statusSuccess, 'msg' => '删除成功']);
    }

    private function insertDemoData($db){
        $post = ['id' => 1, 'title' => 'test title', 'content' => 'test content', 'create_time' => time(), 'update_time'=>time()];
        $postId = $db->haveInDatabase('post', $post);
        return [$postId, $post];
    }
}
