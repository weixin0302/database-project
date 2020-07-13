
<HTML>
　<HEAD>
　　<TITLE>網頁製作教學</TITLE>
　　<Meta>
　</HEAD>
　<BODY>
<FORM name="表單" method="post" action="info.php">
你要走哪個國道呢？：
<SELECT NAME="LIKE">
<OPTION VALUE="國道一號">國道一號
<OPTION VALUE="國道一號高架">國道一號高架
<OPTION VALUE="國道三號">國道三號
<OPTION VALUE="國道三甲">國道三甲
<OPTION VALUE="國道五號">國道五號
<OPTION VALUE="我不想走">我不想走
</SELECT>
<BR>

<!-- <FORM name="表單1" method="post" action="info.php"> -->
你想查什麼車種呢？：
<SELECT NAME="LIKE1">
<OPTION VALUE="小型車牌價">小型車牌價
<OPTION VALUE="大型車牌價">大型車牌價
<OPTION VALUE="聯結車牌價">聯結車牌價
</SELECT>
<BR>

<!-- <FORM name="表單2" method="post" action="info.php"> -->
你要往哪個方向呢？：
<SELECT NAME="LIKE2">
<OPTION VALUE="S">南下
<OPTION VALUE="N">北上
</SELECT>
<BR>

<?php
    $dbms='mysql';     //数据库类型
    $host='127.0.0.1'; //数据库主机名
    $dbName='project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='wesley890302';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";

    try {
        $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        //echo "資料庫連接成功！！！<br/>";
        /*你还可以进行一次搜索操作
        foreach ($dbh->query('SELECT * from FOO') as $row) {
            print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
        }
        */
        $dbh = null;
    } catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
    }
    //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    
    echo "你要從哪裡開始呢？：";
    echo "<select name='POST1'>";
    $sql ="select distinct(起點交流道) from highwayfee ";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        echo "<option>$row[0]</option><br>";
    }
    echo "</select>";

?>
<BR>
<?php
    $dbms='mysql';     //数据库类型
    $host='127.0.0.1'; //数据库主机名
    $dbName='project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='wesley890302';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";

    try {
        $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        //echo "資料庫連接成功！！！<br/>";
        /*你还可以进行一次搜索操作
        foreach ($dbh->query('SELECT * from FOO') as $row) {
            print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
        }
        */
        $dbh = null;
    } catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
    }
    //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    
    
    echo "你要從哪裡結束呢？：";
    echo "<select name='POST2'>";
    $sql ="select distinct(迄點交流道) from highwayfee";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        echo "<option>$row[0]</option><br>";
    }
    echo "</select>";

?>
<BR>
<?php
    $dbms='mysql';     //数据库类型
    $host='127.0.0.1'; //数据库主机名
    $dbName='project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='wesley890302';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";

    try {
        $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        //echo "資料庫連接成功！！！<br/>";
        /*你还可以进行一次搜索操作
        foreach ($dbh->query('SELECT * from FOO') as $row) {
            print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
        }
        */
        $dbh = null;
    } catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
    }
    //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    
    
    // echo "你所在城市是什麼呢？";sdsda
    // echo "<select name='POST3'>";
    // $sql ="select distinct(縣市各區) from city";
    // $result=$db->query($sql);
    // while($row = $result->fetch(PDO::FETCH_NUM)){
    //     echo "<option>$row[0]</option><br>";
    // }
    // echo "</select>";

?>
<!-- <BR> -->
<input type="submit" value="送出">
</FORM>
　</BODY>
</HTML>