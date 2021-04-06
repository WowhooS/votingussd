<?php

function main_menu(){
    $text=  "Welcome to TEAU IVote.\n";
    $text.= "1. Register\n";
    $text.= "2. Vote\n";
    $text.= "3.View results";
    ussd_start($text);
}

function check_student_exist($phone){
    global $connection;
    $select_phone = "select * from students where phoneNumber = '$phone'";
    $query = mysqli_query($connection, $select_phone) or die("There was an error".mysqli_error($connection));

    $check = mysqli_num_rows($query);

    if($check>0){
        $text = "This phonenumber $phone is already registered";
        ussd_stop($text);
    }
}

function student_register($data){
    global $connection;
    if (count($data) == 2){
        $text= "Please enter your username\n";
        ussd_start($text);
    }

    if (count($data) == 3){
        $text= "Please enter your admission number\n";
        ussd_start($text);
    }

    if (count($data) == 4){
        $text= "Please enter your password\n";
        ussd_start($text);
    }
    
    if (count($data) == 5){
        $phone=$_POST['phoneNumber'];
        $username=$data[2];
        $admno=$data[3];
        $password=$data[4];

        $sqli = "insert into students(phoneNumber, username, admno, password) values ('$phone', '$username', '$admno', '$password')";

        $result = mysqli_query($connection, $sqli) or die("There was an error".mysqli_error($connection));

        if($result == 1){
            $text = "You have successfully registered";
            ussd_stop($text);
        }
    }
}

function check_student($data, $phone){
    global $connection;

    if (count($data) == 2){
        $text= "Please enter your password\n";
        ussd_start($text);
    }

    if (count($data) ==3){
        $phone= $_POST['phoneNumber'];
        $password= $data[2];
    
    $statement= "select * from students where phoneNumber='$phone' and password='$password'";
    $result= mysqli_query($connection, $statement) or die("There was an error".mysqli_error($connection));
    $check= mysqli_num_rows($result);

    if ($check>0){
        return true;
    }else{
        $text= "Please check your password or try to register again";
        ussd_stop($text);
    } 
   }
}

function student_vote($data, $phone){
    if(count($data) ==3){
        $text="Welcome to TEAU Ivote.Press 1 to continue:";
        ussd_start($text);
    }   
}

function presidential($data, $phone){
    global $connection;
    $sql="insert into president(president_id, name, vote_count) values('P001','SamuelMureithi',0), ('P002','EstherAtieno',0), ('P003','AnthonyKimei',0)";
    $result = mysqli_query($connection, $sql) or die("There was an error".mysqli_error($connection));

    if (count($data) == 4){
        $text= "Please choose your desired president.\n 1.Samuel Mureithi\n2.Esther Atieno\n3.Anthony Kimei";
        ussd_start($text);
    }
    if (count($data) == 5){
        $phone= $_POST['phoneNumber'];
        $choice= $data[4];
        
        $sql="UPDATE president SET vote_count=vote_count + 1 WHERE id='$choice'";
        $result= mysqli_query($connection, $sql) or die("There was an error".mysqli_error($connection));
    }
}

function education($data, $phone){
    global $connection;
    $sql="insert into education_min(edu_id, name, vote_count) values('E001','AlexOloo',0), ('E002','DianaBaraka',0), ('E003','AnnKioko',0)";
    $result = mysqli_query($connection, $sql) or die("There was an error".mysqli_error($connection));

    if (count($data) == 5){
        $text= "Please choose your desired education minister.\n 1.Alex Oloo\n2.Diana Baraka\n3.Ann Kioko";
        ussd_start($text);
    }
    if (count($data) == 6){
        $phone= $_POST['phoneNumber'];
        $choice= $data[5];

        $sql="UPDATE education_min SET vote_count=vote_count + 1 WHERE id='$choice'";
        $result= mysqli_query($connection, $sql) or die("There was an error".mysqli_error($connection));   
    }
}

function enviroment($data, $phone){
    global $connection;
    $sql="insert into enviroment_min(envr_id, name, vote_count) values('V001','JanyWhite',0), ('V002','IreneBett',0), ('V003','KyraPendo',0)";
    $result = mysqli_query($connection, $sql) or die("There was an error".mysqli_error($connection));

    if (count($data) == 6){
        $text= "Please choose your desired environment minister.\n 1.Jany White\n2.Irene Bett\n3.Kyra Pendo";
        ussd_start($text);
    }
    if (count($data) == 7){
        $phone= $_POST['phoneNumber'];
        $choice= $data[6];

        $sql="UPDATE enviroment_min SET vote_count=vote_count + 1 WHERE id='$choice'";
        $result= mysqli_query($connection, $sql) or die("There was an error".mysqli_error($connection));

        if($result == 1){
            $text = "You have voted successfully";
            ussd_stop($text);
        }
    }
}

function view_results(){
    
}
function president_results($data){
    global $connection;
    $pres1="SELECT * FROM president WHERE id='1'";
    $result = mysqli_query($connection, $pres1) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="Presidential results.\n";
    ussd_start($text);

    $text="Samuel Mureithi:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }

    $pres2="SELECT * FROM president WHERE id='2'";
    $result = mysqli_query($connection, $pres2) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nEsther Atieno:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }

    $pres3="SELECT * FROM president WHERE id='3'";
    $result = mysqli_query($connection, $pres3) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nAnthony Kimei:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }   
}

function education_results($data){
    global $connection;
    $edu1="SELECT * FROM education_min WHERE id='1'";
    $result = mysqli_query($connection, $edu1) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nEducation minister results.\n";
    ussd_start($text);

    $text="\nAlex Oloo:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }

    $edu2="SELECT * FROM education_min WHERE id='2'";
    $result = mysqli_query($connection, $edu2) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nDiana Baraka:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }

    $edu3="SELECT * FROM education_min WHERE id='3'";
    $result = mysqli_query($connection, $edu3) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nAnn Kioko";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }    
}

function environment_results($data){
  
    global $connection;
    $envr1="SELECT * FROM enviroment_min WHERE id='1'";
    $result = mysqli_query($connection, $envr1) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nEnvironment minister results\n";
    ussd_start($text);

    $text="\nJany White:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }

    $envr2="SELECT * FROM president WHERE id='2'";
    $result = mysqli_query($connection, $envr2) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nIrene Bett:";
    ussd_start($text);

    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }

    $envr3="SELECT * FROM president WHERE id='3'";
    $result = mysqli_query($connection, $envr3) or die("There was an error".mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);

    $text="\nKyra Pendo:";
    ussd_start($text);


    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            echo $row['vote_count'];
            break;
        }
    }
}
function ussd_start($text){
    echo "CON ".$text;

}
function ussd_stop($text){
    echo "END ".$text;
    exit(0);
}
?>