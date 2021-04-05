<?php

header("content-type:text\plain");
include("connection.php");
include("functions.php");

$sessionId =$_POST['sessionId'];
$serviceCode=$_POST['serviceCode'];
$phone=$_POST['phoneNumber'];
$text = $_POST['text'];


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