<?php
    $check = $_GET['map'];
    //判別輸入的數量
    if($check == null)
    {
        echo "不符合，因為您輸入的內容為空。";
        exit;
    }

    $cutString = explode("N",$check);
    $trunString = implode($cutString);
    $original = str_split($trunString);
    $data_all = $original;
    //預先判別格式
    if(count($data_all) < 99)
    {
        echo "不符合，因為您輸入的內容長度不足。";
        exit;
    }
    $count = @array_count_values($original);
    if($count['n'] != 0)
    {
        echo "不符合，因為N要大寫。";
        exit;
    }
    if($count['m'] != 0)
    {
        echo "不符合，因為M要大寫。";
        exit;
    }
    if($count['N'] != 9)
    {
        echo "不符合，因為N的數量不對。";
        exit;
    }
    if($count['M'] != 40)
    {
        echo "不符合，因為M的數量不對。";
        exit;
    }

//開始判別對錯
    for($i = 0 ; $i < 100 ; $i++)
    {
        if(!preg_match("/M/", $data_all[$i]))
        {
            $data_all[$i] = "0" ;
        }
    }

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
            $ans[$i][$j];
        }
    }
    for($i=0 ; $i<11 ; $i++)
    {
        for($j=0 ; $j<11 ; $j++)
        {
             $final[] = $ans[$i][$j];
        }
    }
    $stringFinal = implode("", $final);
    $compare = strcmp($stringFinal, $check);
    if( $compare == 0)
    {
         echo "符合。";
    }
    elseif($compare != 0)
    {
        echo "不符合，因為數字錯誤。";
    }
