<?php 
$username;
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
       
       $error = '';


function countCharacters($str) {
    $count = 0;
    for ($i = 0; isset($str[$i]); $i++) {
        $count++;
    }
    return $count;
}

function startsWithLetter($str) {
    if (isset($str[0])) {
        $firstChar = $str[0];
       
        return ($firstChar >= 'a' && $firstChar <= 'z') || ($firstChar >= 'A' && $firstChar <= 'Z');
    }
    return false;
}

function containsValidChars($str) {
    for ($i = 0; isset($str[$i]); $i++) {
        $char = $str[$i];
        if (!(
            ($char >= 'a' && $char <= 'z') || 
            ($char >= 'A' && $char <= 'Z') || 
            $char == '.' || 
            $char == '-'
        )) {
            return false;
        }
    }
    return true;
}
if(containsValidChars($username) && startsWithLetter($username) && (countCharacters($username)>2)){
        echo "Form submitted successfully! Username: " ;
        header('location: email.html');
    }
}
?>