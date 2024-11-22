<?php 

    if(isset($_POST['submit'])){

        if (isset($_POST['blood'])) {
            $gender = $_POST['blood'];
            header('location: page7.html');
        }
    else{
        echo "Please select a bloodgroup.";
    }
}
    else{
        
        header('location: page6.html');
    }


?>