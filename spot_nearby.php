
<HTML>
　<HEAD>
　　<TITLE>網頁製作教學</TITLE>
　　<Meta>
　</HEAD>
　<BODY>
<FORM name="表單55" method="post" action="spot_nearby_info.php">
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
    
    // echo "<br>";

    echo "想要查詢縣市？：";
    echo "<select name='POST5'>";
    $sql ="select distinct(縣市各區) from city";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        echo "<option>$row[0]</option><br>";
    }
    echo "</select>";

?>
<BR>
<input type="submit" value="送出">
</FORM>
　</BODY>
</HTML>