<?php
/**
 * Created by PhpStorm.
 * User: hr
 * Date: 2018/10/8
 * Time: 16:35
 */

namespace app\index\service\user\impl;


use app\index\model\impl\UserImplModel;
use app\index\service\BaseService;
use app\index\service\user\UserService;
use Pimple\Container;

class UserImplService extends BaseService implements UserService
{
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->model = new UserImplModel();
    }

    public function ifRegistered($mobile)
    {
        return $this->checkExistsByWhere(['mobile' => $mobile]);
    }

    public function register($mobile, $password, $type)
    {
        $salt = '123';
//        todo $salt
        $this->handlePassword($password, $salt);
        $fields = [
            'mobile' => $mobile,
            'password' => $this->handlePassword($password),
            'type' => $type
        ];
        return $this->insert($fields);
    }

    private function handlePassword($password, $salt = null){
        //如果加密因子为空为老会员
        if (empty($authCode)) {
            return md5($password);
        } else {
            return md5(md5($password) . $authCode);
        }
    }
}