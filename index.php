<?php

include_once('config.php');
include_once('err_handler.php');
include_once('db_connect.php');
include_once('functions.php');

//include_once('find_token.php');


//добавить автора
if(preg_match_all("/^(add_author)$/ui", $_GET['type'])){
    if(!isset($_GET['name_a'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name!",
            true,
            "ERROR_n",
            null
        );
        exit();
    }


    $name_a = $_GET['name_a'];
    $query = "INSERT INTO `author`(`name`) VALUES ('$name_a');";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR_a",
            null
        );
        exit();
    }

    $ip = get_ip();
    $query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
    $res=mysqli_query($connection, $query);

    echo ajax_echo(
        "Уcпех!",
        "Новый автор добавлен в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
}

// добавить стиль  
else if(preg_match_all("/^(add_style)$/ui", $_GET['type'])){
    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "INSERT INTO `style`(`name`) VALUES ('".$_GET[`name`]."')";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    
    echo ajax_echo(
        "Уcпех!",
        "Новый стиль добавлен в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
}


//добавить экспонат
else if(preg_match_all("/^(add_exhibit)$/ui", $_GET['type'])){
    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    if(!isset($_GET['author_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр author_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['year_of_creation'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр year_of_creation!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['style_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр style_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['type_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр type_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    if(!isset($_GET['hall_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр hall_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "INSERT INTO `style`(`name`,`author_id`,`year_of_creation`,`style_id`,`type_id`,`hall_id`) VALUES ('".$_GET['name']."','".$_GET['author_id']."',
    '".$_GET['year_of_creation']."','".$_GET['style_id']."','".$_GET['type_id']."','".$_GET['hall_id']."')";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    
    $ip = get_ip();
    $query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
    $res=mysqli_query($connection, $query);

    echo ajax_echo(
        "Уcпех!",
        "Новый экспонат добавлен в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
}    


// обновить куратора 

else if(preg_match_all("/^(update_hall_curator)$/ui", $_GET['type'])){
    if(!isset($_GET['curator'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр curator!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    if(!isset($_GET['hall_name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр hall_name!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "UPDATE `hall` SET `curator`= '".$_GET['curator']."' WHERE `hall_name` = '".$_GET['hall_name']."'";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    
    $ip = get_ip();
    $query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
    $res=mysqli_query($connection, $query);

    echo ajax_echo(
        "Уcпех!",
        "Куратор зала изменен в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
} 

// обнавить название зала 

else if(preg_match_all("/^(update_hall_name)$/ui", $_GET['type'])){
    if(!isset($_GET['hall_name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр hall_name!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    if(!isset($_GET['curator'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр curator!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "UPDATE `hall` SET `hall_name`= '".$_GET['hall_name']."' WHERE `curator` = '".$_GET['curator']."'";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    
    $ip = get_ip();
    $query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
    $res=mysqli_query($connection, $query);

    echo ajax_echo(
        "Уcпех!",
        "Название зала изменено в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
} 

// обнавить местоположение экспоната
else if(preg_match_all("/^(update_location_exhibit)$/ui", $_GET['type'])){
if(!isset($_GET['hall_id'])){
    echo ajax_echo(
        "Ошибка!",
        "Вы не указали Get параметр hall_id!",
        true,
        "ERROR",
        null
    );
    exit();
}
if(!isset($_GET['name'])){
    echo ajax_echo(
        "Ошибка!",
        "Вы не указали Get параметр curator!",
        true,
        "ERROR",
        null
    );
    exit();
}

$query = "UPDATE `exhibit` SET `hall_name`= '".$_GET['hall_id']."' WHERE `name' = '".$_GET['name']."'";

$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}

$ip = get_ip();
$query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
$res=mysqli_query($connection, $query);

echo ajax_echo(
    "Уcпех!",
    "Местоположение экспоната изменено в бд!",
    false,
    "SUCCESS",
    null
);
exit();
} 


// список экспонатов в зале
else if(preg_match_all("/^(list_exhibit_hall)$/ui", $_GET['type'])){

    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр hall_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }
$query = "SELECT `exhibit`.`name` FROM `exhibit` INNER JOIN `hall` on `exhibit`.`hall_id`  = `hall`.`hall_name` WHERE `hall`.`hall_name`= ".$_GET['name'].";";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}



$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}

$ip = get_ip();
$query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
$res=mysqli_query($connection, $query);

echo ajax_echo(
    "Уcпех!",
    "Список экспонатов",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}



//Вывести все экспонаты по типу 

else if(preg_match_all("/^(list_exhibit_type)$/ui", $_GET['type'])){
if(!isset($_GET['hall_name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр hall_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

$query = "SELECT `exhibit`.`name` FROM `exhibit` INNER JOIN `exhibit_type` on `exhibit`.`type_id` = `exhibit_type`.`id` WHERE `exhibit_type`.`name`= '".$_GET['hall_name']."'";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}



$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}

$ip = get_ip();
$query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
$res=mysqli_query($connection, $query);

echo ajax_echo(
    "Уcпех!",
    "Список экспонатов",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}


//Вывод по автору 

else if(preg_match_all("/^(list_exhibit_author)$/ui", $_GET['type'])){
$query = "SELECT `exhibit`.`name` FROM `exhibit` INNER JOIN `author` on `exibit`.`author_id` = `author`.`id` WHERE `author`.`name`= '".$_GET['name']."'";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}



$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}


$ip = get_ip();
$query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
$res=mysqli_query($connection, $query);

echo ajax_echo(
    "Уcпех!",
    "Список экспонатов",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}


//Вывод по году создания 

else if(preg_match_all("/^(list_exhibit_year)$/ui", $_GET['type'])){
$query = "SELECT `name` FROM `exhibit` WHERE `year_of_creation`= '".$_GET['year_of_creation']."'";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}



$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}



$ip = get_ip();
$query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
$res=mysqli_query($connection, $query);

echo ajax_echo(
    "Уcпех!",
    "Список экспонатов",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}

//Вывод по тематике 

else if(preg_match_all("/^(list_exhibit_style)$/ui", $_GET['type'])){
$query = "SELECT `exhibit`.`name` FROM `exhibit` INNER JOIN `style` on `exibit`.`style_id` = `style`.`id` WHERE `style`.`name`= '".$_GET['name']."'";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}



$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}

$ip = get_ip();
$query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
$res=mysqli_query($connection, $query);

echo ajax_echo(
    "Уcпех!",
    "Список экспонатов",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}

if(preg_match_all("/^(users_ip|ip)$/ui", $_GET['type'])){
    $ip = get_ip();
    $query = "INSERT INTO ip_log (`ip`,`action`) VALUES ('".$ip."','".$_GET['type']."')";
    $res=mysqli_query($connection, $query);

    $query2 = "SELECT COUNT(id) FROM `ip_log` WHERE ip = '".$ip."'";
    $res2 =  mysqli_query($connection, $query2);
    
    $arr_res = array();
    $rows = mysqli_num_rows($res2);

    for ($i=0; $i < $rows; $i++) { 
        $row = mysqli_fetch_assoc($res2);
        array_push($arr_res, $row);
    }
    
    echo ajax_echo(
        "Уcпех!",
        "Список ip",
        false,
        "SUCCESS",
        $arr_res
    );
    //echo strval($res2);
    exit();
}



