<?php
/*
 * @Author: Brightness
 * @Date: 2021-10-29 17:03:14
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 09:41:32
 * @Description:  
 */
/**
 * 简单工厂模式
 * 减少new操作，代创建需要的对象
 */

/**
 * db 相关的统一接口
 * 定义统一的操作方法
 */
interface db{
    public function conn();
}
/***********服务端,以下类加密不对外开放***************** */

/**
 * mysql
 */
class MysqlDb implements db{
    public function conn()
    {
        echo '连接上 mysql<br/>';
    }
}
/**
 * sqlite
 */
class SqliteDb implements db{
    public function conn()
    {
        echo '连接上 sqlite<br/>';
    }
}
//内部
// $mysql = new MysqlDb();
// $mysql->conn();
// $sqlite = new SqliteDb();
// $sqlite->conn();


//对外开放
/**
 * 简单工厂
 */
class Factory{
    static function createDb($type)
    {
        if($type == 'mysql'){
            return new MysqlDb();
        }else if($type == 'sqlite'){
            return new SqliteDb();
        }else{
            throw new Exception('Error db type');
        }
    }
}
/**************调用者(比如客户端)不知道有 MysqlDb、SqliteDb这两个类***************** */
//所以需要服务端提供一个开放的类，factory 工厂类进行访问，创建对象
//外部
// $sqlite = Factory::createDb('sqlite');
// $sqlite->conn();

// $mysql = Factory::createDb('mysql');
// $mysql->conn();

/********如果新增了oracle 数据库链接呢？怎么办********* */
/**
 * 继续修改Factory的代码?
 * 显然不好，要符合开闭原则，对修改封闭，对扩展开放
 */

//  所以改造factory类，使其易于扩展
/**
 * 工厂类接口
 */
interface DbFactory{
 function createDb();
}

class MysqlFactory implements DbFactory{
    public function createDb()
    {
        return new MysqlDb();
    }
}

class SqliteFactory implements DbFactory{
    public function createDb()
    {
        return new SqliteDb();
    }
}



/***此时，服务端扩展oracle就方便了 */
class OracleDb implements db{
    public function conn()
    {
        echo '连接上oracle';
    }
}

class OracleFactory implements DbFactory{
    public function createDb()
    {
        return new OracleDb();
    }
}


/*******客户端 调用******** */
$mysql = (new MysqlFactory)->createDb();
$mysql->conn();
$sqlite = (new SqliteFactory)->createDb();
$sqlite->conn();
$oracle = (new OracleFactory)->createDb();
$oracle->conn();


