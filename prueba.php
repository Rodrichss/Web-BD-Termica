<?php
$subject = "Mail for checking";
$msg = "Hey! Let us play with PHP.";
$receiver = "a22310376@ceti.mx";
if(mail($receiver, $subject, $msg)){
    echo "Succesful";
}else{
    echo "Not success";
}
?>