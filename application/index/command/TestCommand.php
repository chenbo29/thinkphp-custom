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

/**
 * 测试使用command的test脚本命令类
 * Class TestCommand
 * @package app\index\command
 */
class TestCommand extends BaseCommand
{
    protected $container;

    /**
     * 脚本命令的配置方法
     */
    protected function configure()
    {
        $this->setName('test')
            ->addArgument('id')
            ->setDescription('测试脚本处理命令');
    }

    /**
     * 脚本命令执行方法
     * @param Input $input
     * @param Output $output
     * @return int|null|void
     */
    protected function execute(Input $input, Output $output)
    {
        $id = $input->getArgument('id');
        if ($this->getPostService()->checkExistsById($id)) {
            $this->getPostService()->updateById(['title' => date('H:i:s', time()) . 'command处理'], $id);
            $result = $this->getPostService()->getById($id);
            $output->info("记录{$id}的脚本处理结果说明信息");
            $output->info(var_export($result));
        } else {
            $output->info("记录{$id}不存在");
            $result = $this->getPostService()->listWithPaginate(1, 1);
            $output->info(var_export($result));
        }
    }

    /**
     * 获取post service服务类
     * @return mixed
     */
    private function getPostService(){
        return $this->createService('post:PostService');
    }
}