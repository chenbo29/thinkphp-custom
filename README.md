## 基于tp5框架的API项目设计

### 框架设计构造

* 加入服务容器（pimple\container），解决依赖注入和单例化。（若不设计服务容器，采用tp自身的依赖注入）。

* 新增service层：封装业务处理相关类。

* 新增model层（继承了tp5的模型）：封装公共常用方法、tp5的数据库操作和tp5的模型。

* 解决接口请求时抛出异常信息的捕获，将html的格式输出修改为json格式输出。

* API接口响应码和返回数据格式的定义。

* API接口请求header头部新增Auth-Token处理非法请求，Auth-Token生成逻辑的定义和校验处理。

* API接口版本的设计使用 git tag 打标签的方式，线上部署各个版本代码。（TODO：web服务器的配置） 

* 配置tp5的config配置文件的auth->except参数，定义不需要接口安全验证的controller名称。

* 密码的验证逻辑

### 构造设计的功能测试部署 

* 自定义Command命令
    * php think test {{post_id}}

* 接口
    * post实体的read、list、save、update和delete的接口
    * comment实体的Service
    * user实体的login、logout和register接口
    
### 设计构造接口自动化测试

* debug模式下接口自动化测试（建立测试环境db和redis）

* 增加post文章和user用户的两个测试

* 执行测试
    * 前提：由于测试
    * vendor/bin/codecept run api