<?php 

    if(isset($_POST['submit'])){
        $username = $_POST['email'];
        $atfound= false;
        $dotfound= false;
        $flag = 0;
        for($i=0; $i <strlen($username);$i++)
        {
            $char=$username[$i];
            if($char=='@')
            {
                if($atfound)
                {
                    $flag=1;
                }
                $atfound=true;
            }
            elseif($char=='.')
            {
                if($dotfound)
                {
                    $flag=1;
                }
                $dotfound=true;
            }
        }
        if($username == null){
            echo "please enter an email";
        }

        elseif($flag==1){
            echo "Invalid Email";
        }
    else{
        header('location: page3.html');
    }
}

    else{
        
        header('location: page 2.html');
    }


?>