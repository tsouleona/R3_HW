<?php
    for ($i = 0; $i < 40; $i++)
    {
        $data_all[$i] = "M";
    }

    for($i = 40 ; $i < 100 ; $i++)
    {
        $data_all[$i] = 0;
    }

    shuffle($data_all);

    for($i = 0 ; $i < 100 ; $i++)
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

            if(preg_match("/M/", $data_all[$i - 10]))
            {
                $data_all[$i] = (int)$data_all[$i] + 1;
            }

            if(($i - 9) % 10 != 0)
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
    for($k = 0 ; $k < 100; $k++)
    {
        if(preg_match("/M/", $data_all[$k]))
        {
            $data_all[$k] = "x";
        }

    }
    for($k = 0 ; $k < 100; $k++)
    {
        $x = floor($k/10);
        $y = $k%10;
        $ans[$x][$y] = $data_all[$k];
    }
    for($i = 0 ; $i < 9 ; $i++)
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
