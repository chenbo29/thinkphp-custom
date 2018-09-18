<?php
namespace app\index\controller;

use app\index\service\impl\PostImplService;
use app\index\ServiceKernel;
use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index()
    {

        $result = $this->getPostService()->getById(1);
        return ['code' => 200, 'data' => ['name' => 'test'], 'post' => Request::instance()->isPost(), 'get' => Request::instance()->isGet()];
    }

    public function create(){

    }

    public function save(){
        $title = Request::instance()->post('title','','htmlspecialchars');
        $content = Request::instance()->post('content','','htmlspecialchars');
        if ($this->getPostService()->insert(['title' => $title, 'content' => $content])){

        } else {
            return ['code' => 500,'']
        }
    }

    public function read($id){
        $post = $this->getPostService()->getById($id);
        return ['code' => 200, 'data' => $post];
    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }

    private function getPostService(){
        return new PostImplService();
    }
}