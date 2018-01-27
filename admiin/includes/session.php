<?php 
session_start();
function Message(){
    if(isset($_SESSION["errormessage"])){
    $output="<div class=\"alert alert-danger\">";
        $output.=htmlentities($_SESSION["errormessage"]);
        $output.="</div>";
    $_SESSION["errormessage"]=null;
    return $output;
}
}
function success(){
     if(isset($_SESSION["success_message"])){
         $output="<div class=\"alert alert-success\">";
    $output.=htmlentities($_SESSION["success_message"]);
        $output.="</div>";
    $_SESSION["success_message"]=null;
    return $output;
}
}
?>