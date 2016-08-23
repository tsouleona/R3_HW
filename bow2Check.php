<?php

    $check = $_GET['map'];
    //判別輸入的數量
    if($check == null)
    {
        echo '不符合，因為您輸入的內容為空。\n';
        exit;
    }
    if(!preg_match("/^[0-9a-zA-Z]+$/", $check))
    {
        echo '不符合，因為內容有特殊字元。\n';
    }
    $checkarray = str_split($check);//變陣列
    $stringLen = count($checkarray);
    $count = @array_count_values($checkarray);
    $tag = 0;
    if($stringLen < 109 || $stringLen > 109)
    {
        $x = ceil($stringLen/11);
        echo '不符合，因為地圖大小限制為 10 * 11，非 '.$x.' * 10。';
    }
    if($count['m'] != 0)
    {
        echo '不符合，因為M要大寫。\n';
        $tag = 1;
    }
    if($count['M'] != 40 && $count['m'] != 40)
    {
        echo '不符合，因為炸彈的數量限制為40，您設置了['.($count['M']+$count['m']).']顆炸彈。\n';
        $tag = 1;
    }
    if($count['n'] != 0)
    {
        echo '不符合，因為N要大寫。\n';
        $tag = 1;
    }
    if(preg_match("/N/", $checkarray[($stringLen- 1)]))
    {
        echo '不符合，因為最後一個不能為N。\n';
        $tag = 1;
    }
    if($count['N'] != 9)
    {
        echo '不符合，因為N的數量限制為9，您設置['.$count['N'].']行換行字符。\n';
        $tag = 1;
    }
    if($tag == 0)
    {
        $cutString = explode("N",$check);//以N為開頭切割
        $trunString = implode($cutString);//變字串
        $data_all = str_split($trunString);//變陣列

        //開始判別對錯
        for($i = 0 ; $i < 100 ; $i++)
        {
            if(preg_match("/m/", $data_all[$i]))
            {
                $data_all[$i] = "M" ;
            }
            if(!preg_match("/M/", $data_all[$i]))
            {
                $data_all[$i] = "0" ;
            }

        }
        for($i = 0 ; $i < 109 ; $i++)
        {
            if(preg_match("/m/", $checkarray[$i]))
            {
                $checkarray[$i] = "M";
            }
        }
        $compareString = implode($checkarray);//變字串
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
        $compare2 = strcmp($stringFinal, $compareString);

        if( $compare == 0)
        {
             echo "符合。";
             exit;
        }
        if($compare2 != 0)
        {

            echo '不符合，因為內容有錯誤 ';
            for($i = 0 ; $i < 109 ; $i++)
            {
                if($final[$i] != $checkarray[$i])
                {
                    if(is_numeric($final[$i]))
                    {
                        echo '，第 '.($i + 1).' 個 '.$checkarray[$i].' 應為 '.$final[$i].' ';
                    }
                }
            }
            echo '。\n';
        }
    }


