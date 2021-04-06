<?php

header("content-type:text\plain");
include("config.php");
include("connection.php");
include("functions.php");


$sessionId = isset($_POST['sessionId']) ? $_POST['sessionId'] : '';
$serviceCode = isset($_POST['serviceCode']) ? $_POST['serviceCode'] : '';
$phone = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';

$data = explode("*", $text);
$level= 0;
$level= count($data);

if($level==0 || $level==1){
    main_menu();
}

if($level>1){
    switch($data[1]){
        case 1:
        check_student_exist($phone);
        student_register($data,);
        break;

        case 2:
        check_student($data, $phone);
        student_vote($data, $phone);
        presidential($data, $phone);
        education($data, $phone);
        enviroment($data, $phone);
        break;

        case 3:
        view_results();
        president_results($data);
        education_results($data);
        environment_results($data);
        break;

        default:
        $text.="Invalid input";
        ussd_stop($text);
    }
}



?>