<!DOCTYPE html>
<html>
<head>
    <title>Email Reminder For  Birthday </title>
</head>
    <body>
    <?php
    if($agentEmail){
        echo $agentEmail;   
    }else{
        echo "<p>Happy Birthday to you from Realtag .</p>";
    }
     
    ?>
    <!--@if (!empty($agentEmail))-->
    <!--    {{ $agentEmail }}-->
    <!--@else-->
    <!--    <p>No valid email content found.</p>-->
    <!--@endif-->
    
    </body>
</html>

