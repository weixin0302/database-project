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
    


    $LIKE=$_POST["LIKE"];

    if($LIKE=="我不想走"){
        echo '<span style="font-size: 150px">不要浪費資源好嗎！';
    }
    else{
    echo "你的選擇：" . $LIKE . "<br>";
    $car=$_POST["LIKE1"];
    echo "你的車種：" . $car . "<br>";
    $way=$_POST["LIKE2"];
    echo "你的方向：" . $way . "<br>";
    $start=$_POST["POST1"];
    echo "你的起點：" . $start . "<br>";
    $end=$_POST["POST2"];
    echo "你的終點：" . $end . "<br>";

    echo '<pre>';
    

    echo "里程\t$car<br>";

    if($car == "小型車牌價"){

        if($way =="N"){
             $sql = "select round(sum(收費區設定里程),1),round(sum(小型車牌價),1) from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') ";
        }
        else{
            $sql = "select round(sum(收費區設定里程),1),round(sum(小型車牌價),1) from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') ";   
        }

    }
    else if($car == "大型車牌價"){
         if($way =="N"){
             $sql = "select round(sum(收費區設定里程),1),round(sum(大型車牌價),1) from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') ";
        }
        else{
            $sql = "select round(sum(收費區設定里程),1),round(sum(大型車牌價),1) from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') ";   
        }       
    }
    else{
        if($way =="N"){
             $sql = "select round(sum(收費區設定里程),1),round(sum(聯結車牌價),1) from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') ";
        }
        else{
            $sql = "select round(sum(收費區設定里程),1),round(sum(聯結車牌價),1) from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') ";   
        }
    }
    
    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo sprintf("%s\t",$row[$i]);
        }
        echo  "<hr>";
    }

    if($way =="N"){
         $sql = "
            select rest_highway.服務區名稱 from

            (select g1.服務區名稱,g2.起點交流道,g2.迄點交流道 from (select min((h.經度-r.經度)*(h.經度-r.經度)+(h.緯度-r.緯度)*(h.緯度-r.緯度)) as dd1,r.服務區名稱 from highwayfee h,rest r where h.方向='N' and (r.方向='北上' or r.方向='南北向同一側') group by r.服務區名稱)as g1,(select h.起點交流道,h.迄點交流道,(h.經度-r.經度)*(h.經度-r.經度)+(h.緯度-r.緯度)*(h.緯度-r.緯度) as dd,r.服務區名稱 from highwayfee h,rest r where h.方向='N' and (r.方向='北上' or r.方向='南北向同一側') )as g2 where dd1=dd and g1.服務區名稱=g2.服務區名稱) as rest_highway,      

            (select * from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way'))as pass
            where pass.起點交流道 = rest_highway.起點交流道 and pass.迄點交流道 = rest_highway.迄點交流道

         ";
         //select min((h.經度-r.經度)*(h.經度-r.經度)+(h.緯度-r.緯度)*(h.緯度-r.緯度)),r.服務區名稱 from highwayfee h,rest r where h.方向='N' and r.方向='北上' group by r.服務區名稱 
        // (select * from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way'))as pass";
    }
    else{
        $sql = " 

            select rest_highway.服務區名稱 from

            (select g1.服務區名稱,g2.起點交流道,g2.迄點交流道 from (select min((h.經度-r.經度)*(h.經度-r.經度)+(h.緯度-r.緯度)*(h.緯度-r.緯度)) as dd1,r.服務區名稱 from highwayfee h,rest r where h.方向='S' and (r.方向='南下' or r.方向='南北向同一側') group by r.服務區名稱)as g1,(select h.起點交流道,h.迄點交流道,(h.經度-r.經度)*(h.經度-r.經度)+(h.緯度-r.緯度)*(h.緯度-r.緯度) as dd,r.服務區名稱 from highwayfee h,rest r where h.方向='S' and (r.方向='南下' or r.方向='南北向同一側') )as g2 where dd1=dd and g1.服務區名稱=g2.服務區名稱) as rest_highway,      

            (select * from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way'))as pass
            where pass.起點交流道 = rest_highway.起點交流道 and pass.迄點交流道 = rest_highway.迄點交流道

        ";   
    }
    
    echo "路過服務區：<br>";

    $result=$db->query($sql);
    while($row = $result->fetch(PDO::FETCH_NUM)){
        for($i=0; $i<count($row); $i++){
            echo "$row[$i]" . "\t";
        }
        echo  "<br>";
    }
    echo "<hr>";

    if($way =="N"){
         $sql = "select * from highwayfee where 國道='$LIKE' and 方向='$way' and 設定收費區代碼 between (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 迄點交流道 ='$end' and 方向='$way') and (select 設定收費區代碼 from highwayfee where 國道='$LIKE' and 起點交流道 ='$start' and 方向='$way')";
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

    
}
?>
<form action="home.php">
<input type ="submit" value="返回">
</form>