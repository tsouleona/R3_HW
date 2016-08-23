<?php
    $check = $_GET['map'];
    //判別輸入的數量
    if($check == null)
    {
        echo "不符合，因為您輸入的內容為空。";
        exit;
    }
    $checkarray = str_split($check);//變陣列
    $stringLen = count($checkarray);
    if($stringLen < 109 || $stringLen > 109)
    {
        echo "不符合，因為內容長度為109，您的字串為[".$stringLen."]個字符。";
        exit;
    }
    $count = @array_count_values($checkarray);

    if($count['m'] != 0)
    {
        echo "不符合，因為M要大寫。";
        exit;
    }
    if($count['M'] != 40)
    {
        echo "不符合，因為炸彈的數量限制為40，您設置了[".$count['M']."]顆炸彈。";
        exit;
    }
    if($count['n'] != 0)
    {
        echo "不符合，因為N要大寫。";
        exit;
    }
    if($count['N'] != 9)
    {
        echo "不符合，因為N的數量限制為9，您設置[".$count['N']."]行換行字符。";
        exit;
    }

    $cutString = explode("N",$check);//以N為開頭切割
    $trunString = implode($cutString);//變字串
    $original = str_split($trunString);//變陣列
    $data_all = $original;
    //預先判別格式



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

    for($i=0 ; $i<10 ; $i++)
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

        echo "不符合，因為數字錯誤，[X]為錯誤的地方。";
        for($i = 0 ; $i < 109 ; $i++)
        {
            if($final[$i] != $checkarray[$i])
            {
                $final[$i] = "[X]";
            }
        }
        for($i = 0 ; $i < 109 ; $i++)
        {
            echo $final[$i];
        }
    }

