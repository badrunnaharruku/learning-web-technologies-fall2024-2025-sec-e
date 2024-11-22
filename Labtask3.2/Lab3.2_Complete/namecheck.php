<?php
if (isset($_POST['submit'])) {
    
    $username = trim($_POST['username']);

    
    if ($username === "" || $username === null) {
        echo "Username cannot be empty.<br>";
    } else {
        
        $wordCount = 0;
        $insideWord = false;

        
        for ($i = 0; $i < strlen($username); $i++) {
            if ($username[$i] == ' ' || $username[$i] == '.' || $username[$i] == '-') {
                if ($insideWord) {
                    $wordCount++;
                    $insideWord = false; 
                }
            } else {
                $insideWord = true; 
            }
        }

        
        if ($insideWord) {
            $wordCount++;
        }

        // If there are fewer than 2 words
        if ($wordCount < 2) {
            echo "Username must contain at least two words.<br>";
        } 
        // if username starts with a letter
        else if (!(($username[0] >= 'a' && $username[0] <= 'z') || ($username[0] >= 'A' && $username[0] <= 'Z'))) {
            echo "Username must start with a letter.<br>";
        } 
        
        else {
            $isValid = true;
            for ($i = 0; $i < strlen($username); $i++) {
                $char = $username[$i];
                // Only a-z, A-Z, period, dash, and spaces are allowed:
                if (!(($char >= 'a' && $char <= 'z') || 
                      ($char >= 'A' && $char <= 'Z') || 
                      $char === '.' || 
                      $char === '-' || 
                      $char === ' ')) {
                    $isValid = false;
                    break;
                }
            }

            if (!$isValid) {
                echo "Username can only contain letters (a-z, A-Z), periods, dashes, and spaces.<br>";
            } else {
                // If all criteria is filled up:
                echo "Username is valid!<br>";
            
                 header('Location: page2.html');
                
            }
        }
    }
} else {
    
    header('location: page1.html'); 
    exit();
}
?>
