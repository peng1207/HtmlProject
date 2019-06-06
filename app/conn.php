<?php

require_once('response.php');
// $serverName="huangshupeng.cn"; 
// $username="root"; 
// $password="hsp13824404512hsp"; 
// $dbname="ZKDataBase"; 

// $conn = mysql_connect($serverName,$username,$password); 
// if (!$conn){
//     echo "数据库连接失败"; 
// }
// mysql_select_db($dbname);
 
class DB {
    private $host    ='huangshupeng.cn'; //数据库主机
    private $user     = 'root'; //数据库用户名
     private $pwd     = 'hsp13824404512hsp'; //数据库用户名密码
      private $database = 'ZKDataBase'; //数据库名
    private $charset = 'utf8'; //数据库编码，GBK,UTF8,gb2312
     private $link;             //数据库连接标识;
     static $_instance; //存储对象
      /**
      * 构造函数
      * 私有
       */
       private function __construct($pconnect = false) {
            // if (!$pconnect) {
              $this->link = mysql_connect($this->host, $this->user, $this->pwd) or $this->err();
            // } else {
            //    $this->link = @ mysql_pconnect($this->host, $this->user, $this->pwd) or $this->err();
            // }
            if (!$this->link){
                echo "连接失败"; 
            }
             mysql_select_db($this->database) or $this->err();
            // $this->query("SET NAMES '{$this->charset}'", $this->link);
            return $this->link;
            // return null;
        }
        /**
         * 防止被克隆
         *
        */
      private function __clone(){}
       public static function getInstance($pconnect = false){
            if (self::$_instance == null){
                self::$_instance = new self($pconnect);
            }

        //  if(FALSE == (self::$_instance instanceof self)){
        //       self::$_instance = new self($pconnect);
        //   }
        
          return self::$_instance;
        // return null;
       } 
    public function cloae(){
         mysql_close($this->link);
    }
    public function getConn(){
      return $this->link;
    }
    /**
      * 错误信息输出
     */
    protected function err($sql = null) {
          //这里输出错误信息
            echo 'error';
            exit();
       }
}

$db_conn = DB::getInstance();
$conn = $db_conn->getConn();

?>


