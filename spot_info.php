<?php
    $dbms='mysql';     //数据库类型
    $host='127.0.0.1'; //数据库主机名
    $dbName='project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='wesley890302';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";

    try {
        $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        // echo "資料庫連接成功！！！<br/>";
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
    
    // $LIKE=$_POST["LIKE"];
    // echo "你的選擇：" . $LIKE . "<br>";
    // $car=$_POST["LIKE1"];
    // echo "你的車種：" . $car . "<br>";
    // $way=$_POST["LIKE2"];
    // echo "你的方向：" . $way . "<br>";
    // $start=$_POST["POST1"];
    // echo "你的起點：" . $start . "<br>";
    // $end=$_POST["POST2"];
    // echo "你的終點：" . $end . "<br>";
    $position=$_POST["POST4"];
    echo "你要去的景點：" . $position . "<br>";

    echo '<pre>';
    // $sql = "SHOW COLUMNS FROM highwayfee";
    // $result = $db->query($sql);
    // while($row = $result->fetch()){
    //     echo $row['Field'] . "\t";
    // }
    // echo "<hr>";

   //"select 國道,方向,起點交流道,迄點交流道,經度,緯度 from highwayfee where 國道='$LIKE' and (起點交流道 ='$start' or 迄點交流道 = '$end') "
    //"select * from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way' union select * from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way' "
//"select * from highwayfee where 國道='$LIKE' and 方向='$way' and 編號 between (select 編號 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') and (select 編號 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') "
    echo "座標：";
    $sql0="select 經度,緯度 from spot where 景點='$position' ";
    $result=$db->query($sql0);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        $px=$row[0];
        $py=$row[1];
        echo  "<hr>";
    }
    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='N' and (國道='國道一號高架') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1 ";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<br>";
    }

    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='S' and (國道='國道一號高架') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<hr>";
    }
    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='N' and (國道='國道一號') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1 ";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<br>";
    }

    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='S' and (國道='國道一號') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<hr>";
    }
    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='N' and (國道='國道三號') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1 ";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<br>";
    }

    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='S' and (國道='國道三號') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<hr>";
    }
    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='N' and (國道='國道五號') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1 ";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<br>";
    }

    $sql="select 國道,方向,編號,起點交流道 from highwayfee where 方向='S' and (國道='國道五號') order by ($px-經度)*($px-經度)+($py-緯度)*($py-緯度) limit 1";
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<hr>";
    }



    if($way =="N"){
         $sql = "select * from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') ";
    }
    else{
        $sql = "select * from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') ";   
    }
    
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<br>";
    }
?>
<form action="home.php">
<input type ="submit" value="返回">
</form>