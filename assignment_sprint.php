<?php 

//db connection fetch the data.
$mysqli = new mysqli("localhost","root","password","task_jira");
$query = mysqli_query($mysqli,"select * from feature_task ORDER BY priority asc, id asc");
$row = mysqli_fetch_all($query,MYSQLI_ASSOC);
foreach ($row as $key => $entry) {
    $priority_row[$entry['priority']][] = $entry;
}


$sprint_days=10;       //we can sprint days
$count_day[1]=0;
$devloper_array=array(1=>'devloper 1',2=>'devloper 2'); //dynamic we can add more 
for($k=1;$k<=count($devloper_array);$k++){
    $sprint_no[$k]=1;
}

for($i=1;$i<=count($priority_row);$i++){
    $max_days[$i] = max(array_column($priority_row[$i], 'effort_days'));

    $count_of_priority=count($priority_row[$i]);
    if($count_of_priority<count($devloper_array)){
        $count_of_priority=count($devloper_array);
    }
    $b=1;
    for($j=0;$j<$count_of_priority;$j++){
        if($priority_row[$i][$j]){
            $count_day[$b]=$count_day[$b]+$priority_row[$i][$j]['effort_days'];
            if($count_day[$b]<$sprint_days){
            $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=$priority_row[$i][$j];
            }else{
                 $remaining_days=$sprint_days+$priority_row[$i][$j]['effort_days']-$count_day[$b];
                if($remaining_days>0){
                    $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $remaining_days,"priority" => $i);
                }
            }
        }else{
            $count_day[$b]=$count_day[$b]+$max_days[$i];
            if($count_day[$b]<$sprint_days){
                $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $max_days[$i],"priority" => $i);
            }else{
                $remaining_days=$sprint_days+$max_days[$i]-$count_day[$b];
                if($remaining_days>0){
                    $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $remaining_days,"priority" => $i);
                }
            }
        }
        
        if($priority_row[$i][$j] && $max_days[$i]>$priority_row[$i][$j]['effort_days'] ){
            $miscell_days=$max_days[$i]-$priority_row[$i][$j]['effort_days'];
            $count_day[$b]=$count_day[$b]+$miscell_days;
            if($count_day[$b]<$sprint_days){
                $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $miscell_days,"priority" => $i);
            }else{
                $remaining_days=$sprint_days+$miscell_days-$count_day[$b];
                if($remaining_days>0){
                    $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $remaining_days,"priority" => $i);
                }
            }
        }

        if($priority_row[$i][$j] && $count_day[$b]>$sprint_days){
            //echo "<pre>=====".print_r($count_day[$b]);print_r($devloper_with_priority[$b]);
            $count_day[$b]=0;            
            $sprint_no[$b]=$sprint_no[$b]+1;
            $count_day[$b]=$count_day[$b]+$priority_row[$i][$j]['effort_days'];
            $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=$priority_row[$i][$j];
            
            if($priority_row[$i][$j] && $max_days[$i]>$priority_row[$i][$j]['effort_days'] ){
                $miscell_days=$max_days[$i]-$priority_row[$i][$j]['effort_days'];
                $count_day[$b]=$count_day[$b]+$miscell_days;
                if($count_day[$b]<$sprint_days){
                    $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $miscell_days,"priority" => $i);
                }else{
                    $remaining_days=$sprint_days+$miscell_days-$count_day[$b];
                    if($remaining_days>0){
                        $devloper_with_priority[$b]['SPRINT '.$sprint_no[$b]][]=array("task_name" => "Miscellaneous tasks","effort_days" => $remaining_days,"priority" => $i);
                    }
                }
            }
        }

        $b=$b+1;
        if($b>count($devloper_array)){
            $b=1;
        }        
    }
}

foreach($devloper_with_priority as $devloper=>$sprints){
    echo "<br><b>devloper ".$devloper."</b><br>";
    foreach($sprints as $sprint_name=>$sprint_data){
        $days=1;
        for($m=0;$m<count($sprint_data);$m++){
            echo $sprint_name." - Days ".$days."-".($days+$sprint_data[$m]['effort_days']-1)." ".$sprint_data[$m]['task_name']."<br>";
            $days=$days+$sprint_data[$m]['effort_days'];
        }
    }
}

//echo"<pre>";print_r($devloper_with_priority);

?>