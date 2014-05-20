<?php 
     
    echo "Bus Stop ,";
    echo "Answer , \n";
     for($i=0;$i<count($data['stops']);$i++)
       {
           echo $data['stops'][$i];
           echo ",";
           echo $data['answers'][$i];
           echo ", \n";
       }   
         
?> 