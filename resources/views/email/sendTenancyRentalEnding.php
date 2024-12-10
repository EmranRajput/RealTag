<!DOCTYPE html>
<html>
<head>
    <title>Tenancy Rental Ending Reminder </title>
</head>
    <body>
    <?php
    if($description){
        echo $description;   
    }else{
         echo "<p>No content .</p>";
    }
     
    ?>
    <!--@if (!empty($agentEmail))-->
    <!--    {{ $agentEmail }}-->
    <!--@else-->
    <!--    <p>No valid email content found.</p>-->
    <!--@endif-->
    
    </body>
</html>

