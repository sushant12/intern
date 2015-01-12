<?php
	//echo "<pre>";
	//E_NOTICE();
	$file1 = fopen('awards.csv', 'r') or die("Unable to open file");
    $file2 = fopen('contracts.csv', 'r') or die("Unable to open file");

    while (($data = fgetcsv($file1, 0, ",")) !== FALSE) {
            $awards[]=$data;
    }

    while (($data = fgetcsv($file2, 0, ",")) !== FALSE) {
            $contracts[]=$data;
    }

    for($x = 0; $x < count($contracts); $x++){
    	if($x==0){
                unset($awards[0][0]);
                $line[$x]=array_merge($contracts[0],$awards[0]);
         }else{
                $contractsMerge=0;
                for($y=0;$y <= count($awards);$y++)
                {
                    if($awards[$y][0] == $contracts[$x][0]){
                    	$awardsIndex = $awards[$y][0];
                        
                        unset($awards[$y][0]);
                        $line[$x]=array_merge($contracts[$x],$awards[$y]);
                        
                         if(($line[$x][0] == $awardsIndex) && ($line[$x][1] == 'Current')){
                         	$total += (int) $line[$x][12];
                         }
                        $contractsMerge=1;
                    }
                }
                if($contractsMerge==0)
                    $line[$x]=$contracts[$x];
            }
    }

	$file3 = fopen('final.csv', 'w') or die("Unable to open file");

	foreach ($line as $fields) {
	    fputcsv($file3, $fields);
	}
	echo "The total of current awardee is : ". $total;

    fclose($file1);
    fclose($file2);
    fclose($file3);