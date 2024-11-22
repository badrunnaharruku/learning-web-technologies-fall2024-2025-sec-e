<?php 

    if(isset($_POST['submit'])){

        if (isset($_POST['degree'])&& count($_POST['degree'])>=2) {
            $degree = $_POST['degree'];
            header('location: page6.html');
        }
    else{
        echo "Please Select At Least Two Degree";
    }
}
    else{
        
        header('location: page5.html');
    }


?>