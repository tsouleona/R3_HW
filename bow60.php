<?php
    for ($i = 0; $i < 1200; $i++){
        do{
            $bow[$i] = rand(0, 2999);
            for ($j = 0 ; $j < $i ; $j++){
                if ($bow[$i] == $bow[$j]) {
                    $bow[$i] = 0;
                    break;
                }
            }
        }while($bow[$i] == 0);
    }

    for($i = 0 ; $i < 1200 ; $i++)
    {
        $bow[$i] = str_pad($bow[$i],4,"0",STR_PAD_LEFT);
    }
    for($i=0 ; $i<50 ; $i++)
    {
        for($j=0 ; $j<60 ; $j++)
        {
            $origin[$i][$j] = 0;
        }
    }

    for($k = 0 ; $k < 1200 ; $k++)
    {
        $x = floor((int)$bow[$k]/60);
        $y = (int)$bow[$k]%60;

        $origin[$x][$y] = "M";
    }
    $data_all =[];

    for($i=0 ; $i<50 ; $i++)
    {
        for($j=0 ; $j<60 ; $j++)
        {
            $data_all[] = $origin[$i][$j];
        }
    }

    $count = count($data_all);
    for($i = 0 ; $i < $count ; $i++)
    {
        if(!preg_match("/M/", $data_all[$i]))
        {
            if(($i - 1) % 60 != 59)
            {
                if(preg_match("/M/", $data_all[$i - 1]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i + 1) % 60 != 0)
            {
                if(preg_match("/M/", $data_all[$i + 1]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i - 61) % 60 != 59)
            {
                if(preg_match("/M/", $data_all[$i - 61]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i - 60) > 0)
            {
                if(preg_match("/M/", $data_all[$i - 60]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i - 59) % 60 != 0)
            {
                if(preg_match("/M/", $data_all[$i - 59]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }

            if(($i + 59) % 60 != 59)
            {
                if(preg_match("/M/", $data_all[$i + 59]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(preg_match("/M/", $data_all[$i + 60]))
            {
                $data_all[$i] = (int)$data_all[$i] + 1;
            }
            if(($i + 61) % 60 != 0)
            {
                if(preg_match("/M/", $data_all[$i + 61]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }

        }
    }

    for($k = 0 ; $k < 3000; $k++)
    {
        $x = floor($k/60);
        $y = $k % 60;

        $ans[$x][$y] = $data_all[$k];
    }

    for($i = 0 ; $i < 49 ; $i++)
    {
        $ans[$i][60] = "N";
    }

    for($i=0 ; $i<50 ; $i++)
    {
        for($j=0 ; $j<61; $j++)
        {
            echo $ans[$i][$j];
        }
    }
