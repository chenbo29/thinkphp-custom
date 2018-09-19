<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/9/19
 * Time: 15:27
 */

namespace app\index\command;


use think\console\Input;
use think\console\Output;

class TestCommand extends BaseCommand
{
    protected $container;

    protected function configure()
    {
        $this->setName('test')->setDescription('测试脚本处理命令');
    }

    protected function execute(Input $input, Output $output)
    {
//        脚本处理逻辑
        $this->getPostService()->updateById(['title' => date('H:i:s', time()) . 'command处理'], 61);
        $result = $this->getPostService()->getById(61);
        $output->info("脚本处理结果说明信息");
        $output->info(var_export($result));
    }

    private function getPostService(){
        return $this->createService('post:PostService');
    }
}