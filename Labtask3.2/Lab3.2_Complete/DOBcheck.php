<?php
    if( isset($_POST['dob']) ){
        $dob = $_POST['dob'];
        
        if( $dob == "" || $dob == null ){
            echo "invalid";
            header('location: page4.html');
        }

        else{
            $array = explode('-', $dob);
            $year = $array[0];
            $month = $array[1];
            $day = $array[2];

            if( $year < 1953 || $year > 1999 ){
                echo "invalid";
            }
            else if( $month < 1 || $month > 12 ){
                echo "invalid";
            }
            else if( $day < 1 || $day > 31 ){
                echo "invalid";
            }
            else{
                echo "valid";
                header('location: page3.html');
            }
        }
    }
    else{
        echo "invalid";
        header('location: page4.html');
        exit();
    }
?>