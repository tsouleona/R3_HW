<?php
    for ($i = 0; $i < 40; $i++){
        do{
            $bow[$i] = rand(0, 99);
            for ($j = 0 ; $j < $i ; $j++){
                if ($bow[$i] == $bow[$j]) {
                    $bow[$i] = 0;
                    break;
                }
            }
        }while($bow[$i] == 0);
    }

    echo "炸彈位置<br>";

    //個位數前面補0
    for($i = 0 ; $i < 40 ; $i++)
    {
        $bow[$i] = str_pad($bow[$i],2,"0",STR_PAD_LEFT);
    }
    //全部給null
    for($i=0 ; $i<10 ; $i++)
    {
        for($j=0 ; $j<10 ; $j++)
        {
            $origin[$i][$j] = 0;
        }
    }

    for($k=0;$k<40;$k++)
    {
        $x = substr($bow[$k], 0, 1);
        $y = substr($bow[$k], 1, 1);

        $origin[$x][$y] = "M";


    }

    for($i=0 ; $i<10 ; $i++)
    {
        for($j=0 ; $j<10 ; $j++)
        {
            echo $origin[$i][$j]." ";
            if($j == 9)
            {
                echo "<br>";
            }
        }
    }
    echo "<br>-------------------------------------------------------<br>";

    $data_all =[];

    for($i=0 ; $i<10 ; $i++)
    {
        for($j=0 ; $j<10 ; $j++)
        {
            $data_all[] = $origin[$i][$j];
        }
    }
    echo "<br>變一維-------------------------------------------------------<br>";
    $count = count($data_all);
    for($i = 0 ; $i < $count ; $i++)
    {
        echo $data_all[$i];
    }

    for($i = 0 ; $i < $count ; $i++)
    {
        if(!preg_match("/M/", $data_all[$i]))
        {
            if(($i - 1) % 10 != 9)
            {
                if(preg_match("/M/", $data_all[$i - 1]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i + 1) % 10 != 0)
            {
                if(preg_match("/M/", $data_all[$i + 1]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i - 11) % 10 != 9)
            {
                if(preg_match("/M/", $data_all[$i - 11]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i - 10) > 0)
            {
                if(preg_match("/M/", $data_all[$i - 10]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(($i - 9) %10 != 0)
            {
                if(preg_match("/M/", $data_all[$i - 9]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }

            if(($i + 9) % 10 != 9)
            {
                if(preg_match("/M/", $data_all[$i + 9]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }
            if(preg_match("/M/", $data_all[$i + 10]))
            {
                $data_all[$i] = (int)$data_all[$i] + 1;
            }
            if(($i + 11) % 10 != 0)
            {
                if(preg_match("/M/", $data_all[$i + 11]))
                {
                    $data_all[$i] = (int)$data_all[$i] + 1;
                }
            }

        }
    }
    echo "<br>計算幾顆炸彈-------------------------------------------------------<br>";
    for($i = 0 ; $i < $count ; $i++)
    {
        echo $data_all[$i];
    }
    for($i = 0 ; $i < $count ; $i++)
    {
        if(preg_match("/M/", $data_all[$i]))
        {
            $data_all[$i] = "x";
        }
    }
    echo "<br>";
    for($k = 0 ; $k < $count; $k++)
    {
        $x = floor($k/10);
        $y = $k%10;
        $ans[$x][$y] = $data_all[$k];
    }
    for($i = 0 ; $i <10 ; $i++)
    {
        $ans[$i][10] = "N";
    }
    for($i=0 ; $i<11 ; $i++)
    {
        for($j=0 ; $j<11 ; $j++)
        {
            echo $ans[$i][$j]." ";
            if(preg_match("/N/", $ans[$i][$j]))
            {
                echo "<br>";
            }
        }
    }
