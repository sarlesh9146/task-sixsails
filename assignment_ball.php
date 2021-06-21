<?php
 $ball_weight=array("red"=>1,"green"=>0.5,"yellow"=>0.25);

 $file="coloured_balls.txt";
 $fopen = fopen($file, 'r');
 $fread = fread($fopen,filesize($file));
 fclose($fopen);

 $split = explode(',', $fread);
 $total_balls=count($split);
 $count_of_every_element=array_count_values($split);

 $total_weight_balls=0;
 foreach($count_of_every_element as $ball_color=>$total_count){
     $total_weight_balls= $total_weight_balls+$total_count*$ball_weight[$ball_color];
 }

 foreach($count_of_every_element as $ball_color=>$count){
    $number_of_balls[]= "<p>Number of ".$ball_color." balls: ".$count."</p>";
    $average_of_balls[]= "<p>Average of ".$ball_color." balls: ".round($count/$total_balls, 2)."</p>";
    $weighted_of_balls[]= "<p>Weighted average of ".$ball_color." balls: ".round($count*$ball_weight[$ball_color]/$total_weight_balls, 2)."</p>";
 }
 echo implode($number_of_balls,' ');
 echo implode($average_of_balls,' ');
 echo implode($weighted_of_balls,' ');

?>