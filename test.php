<?php
	// 1st section
        $fh = fopen('awards.csv', 'r') or die("Unable to open file");
        $fhg = fopen('contracts.csv', 'r') or die("Unable to open file");
         while (($data = fgetcsv($fh, 0, ",")) !== FALSE) {
            $awards[]=$data;
        }
        while (($data = fgetcsv($fhg, 0, ",")) !== FALSE) {
                $contracts[]=$data;
        }
       // echo "<pre>";
       // print_r($awards);
       // die();
        //echo "<pre>";
        //print_r($contracts);
        //die();

 // 2nd section   
        for($x=0;$x< count($contracts);$x++)
        {
            if($x==0){
                unset($awards[0][0]);
                $line[$x]=array_merge($contracts[0],$awards[0]); //header
            }
            else{
                $deadlook=0;
                for($y=0;$y <= count($awards);$y++)
                {
                    if($awards[$y][0] == $contracts[$x][0]){
                        unset($awards[$y][0]);
                        $line[$x]=array_merge($contracts[$x],$awards[$y]);
                        $deadlook=1;
                       // echo "<pre>";
                        //print_r($line[$x]);
                        //if($line)
                    }



                }
                if($deadlook==0)
                    $line[$x]=$contracts[$x];
            }
        }
  // 3 section     
        $fp = fopen('final.csv', 'w') or die("Unable to open file");//output file set here

        foreach ($line as $fields) {
            fputcsv($fp, $fields);
        }
        //printf("Total amount of Current contracts: ". );
        //echo "Total amount of current contracts:";//.$line;
        //echo "<pre>";
        //print_r($line);
        fclose($fp);
?>