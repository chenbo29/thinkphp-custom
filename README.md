## 基于tp5框架的API项目设计

### 框架设计构造

* 新增service层：封装业务处理相关类。

* 新增model层（继承了tp5的模型）：封装公共常用方法、tp5的数据库操作和tp5的模型。

* 解决接口请求时抛出异常信息的捕获，将html的格式输出修改为json格式输出。

* API接口响应码和返回数据格式。

* 加入服务容器化（pimple\container），解决依赖注入和单例化。（若不设计服务容器化，采用tp自身的依赖注入）。

* API接口请求header头部新增Auth-Token处理非法请求。（80%，TODO: accessKey和secretKey）

* API接口版本的设计使用 git tag 打标签的方式，线上部署各个版本代码。（TODO：web服务器的配置） 

### tp5的功能测试部署 

* 部署command命令（test）：php think test，更新某条数据

* post实体的read、list、save、update和delete的接口设计（PostMan） 


### todo
* 不同controller的auth验证
* 注释
* 版本