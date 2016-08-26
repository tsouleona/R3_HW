<?php
    for ($i = 0; $i < 10; $i++)
    {
        $data_all[$i] = "M";
    }

    for($i = 10 ; $i < 100 ; $i++)
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
        $x = floor($k/10);
        $y = $k%10;
        $ans[$x][$y] = $data_all[$k];
    }
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>踩地雷</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Jquery-->
    <script src="jquery/jquery.js"></script>
    <script src="jquery/jquery.blockUI.js"></script>


</head>
<body>

    <br><br><br>
    <div class="row" align="center">
        <div  class="container">
            <button class="btn btn-primary btn-lg" onclick="window.location.reload();">開新局</button>
            <br>
            <table id="game" class="table table-bordered">
                <?php for($i=0;$i<10;$i++){?>
                    <tr>
                        <?php for($j=0;$j<10;$j++){?>
                            <td id="td<?php echo $i.$j;?>" style="background:#fff" onmousedown = check('<?php echo $i.$j;?>'); height="80" >
                                <input id="<?php echo "2".$i.$j;?>" style="display:none" align="center" value="<?php echo $ans[$i][$j];?>" />
                                <h4 id="<?php echo $i.$j;?>" style="visibility:hidden" align="center" ><?php echo $ans[$i][$j];?></h4>
                            </td>
                        <?php }?>
                    </tr>
                <?php }?>
            </table>
    </div>
    <script>
    $(document).ready(function()
    {
        $(document).bind("contextmenu",function(event){
          return false;
        });
    });

    function check(num){
        $("#td"+num).mousedown(function(event){
            switch(event.which)
            {
                case 1:
                    document.getElementById(num).style.visibility="visible";
                    document.getElementById("td"+num).style.background="#40e0d0";
                    if($("#"+num).text() == "M")
                    {
                        alert('踩到地雷!!GAME OVER');

                        allh4 = document.getElementsByTagName("h4");
                        for(i=0;i<allh4.length;i++)
                        {
                            allh4[i].style.visibility="visible";
                        }

                        $('#game').block({ message: null });
                    }
                    if($("#"+num).text() == "0")
                    {
                        view(num);
                    }
                    break;
                case 3:
                    if($("#"+num).text() != "F")
                    {
                        $("#"+num).text("F");
                        document.getElementById(num).style.visibility="visible";
                    }else{
                        $("#"+num).text($("#2"+num).val());
                        document.getElementById(num).style.visibility="hidden";
                    }
                    break;
            }
        })
    };
    function view(num)
    {
        num1 = parseInt(num) + 1;
        if((num1 % 10 != 0))
        {
            num2 = num1.toString();
            if(num2.length == 1 && $("#"+"0"+num1).text() != "M")
            {
                document.getElementById("0"+num1).style.visibility="visible";
                //document.getElementById("td"+"0"+num1).style.background="#40e0d0";
                // if($("#"+"0"+num1).text() == "0")
                // {
                //     view(num1);
                // }
            }
            if(num2.length == 2 && $("#"+num1).text() != "M")
            {
                document.getElementById(num1).style.visibility="visible";
                //document.getElementById("td"+num1).style.background="#40e0d0";
                // if($("#"+num1).text() == "0")
                // {
                //     view(num1);
                // }
            }
        }

        num_1 = parseInt(num) - 1;
        if((num_1 % 10 != 9) && num_1 > 0)
        {
            num_2 = num_1.toString();
            if(num_2.length == 1 && $("#"+"0"+num_1).text() != "M")
            {
                document.getElementById("0"+num_1).style.visibility="visible";
                //document.getElementById("td"+"0"+num_1).style.background="#40e0d0";
                // if($("#"+"0"+num_1).text() == "0")
                // {
                //     view(num_1);
                // }

            }
            if(num_2.length == 2 && $("#"+num_1).text() != "M")
            {
                document.getElementById(num_1).style.visibility="visible";
                //document.getElementById("td"+num_1).style.background="#40e0d0";
                // if($("#"+num_1).text() == "0")
                // {
                //     view(num_1);
                // }
            }
        }

        num10 = parseInt(num) + 10;
        if(num10 > 0)
        {
            if($("#"+num10).text() != "M")
            {
                document.getElementById(num10).style.visibility="visible";
                //document.getElementById("td"+num10).style.background="#40e0d0";
                // if($("#"+num10).text() == 0)
                // {
                //     view(num10);
                // }
            }
        }

        num11 = parseInt(num) + 11
        if((num11 % 10 != 0))
        {
            if($("#"+num11).text() != "M")
            {
                document.getElementById(num11).style.visibility="visible";
                //document.getElementById("td"+num11).style.background="#40e0d0";
                // if($("#"+num11).text() == 0)
                // {
                //     view(num11);
                // }
            }
        }


        num9 = parseInt(num) + 9;
        if((num9 % 10 != 9))
        {
            if($("#"+num9).text() != "M")
            {
                document.getElementById(num9).style.visibility="visible";
                //document.getElementById("td"+num9).style.background="#40e0d0";
                // if($("#"+num9).text() == 0)
                // {
                //     view(num9);
                // }
            }
        }


        num_10 = parseInt(num) - 10
        if(num_10 >= 0)
        {
            num_102 = num_10.toString();
            if(num_102.length == 1 && $("#"+"0"+num_10).text() != "M")
            {
                document.getElementById("0"+num_10).style.visibility="visible";
                //document.getElementById("td"+"0"+num_10).style.background="#40e0d0";
                // if($("#"+"0"+num_10).text() == 0)
                // {
                //     view(num_10);
                // }
            }
            if(num_102.length == 2 && $("#"+num_10).text() != "M")
            {
                document.getElementById(num_10).style.visibility="visible";
                //document.getElementById("td"+num_10).style.background="#40e0d0";
                // if($("#"+num_10).text() == 0)
                // {
                //     view(num_10);
                // }
            }
        }

        num_11 = parseInt(num) - 11;
        if(num_11 % 10 != 9)
        {
            num_112 = num_11.toString();
            if((num_112.length == 1) && $("#"+"0"+num_11).text() != "M")
            {
                document.getElementById("0"+num_112).style.visibility="visible";
                //document.getElementById("td"+"0"+num_112).style.background="#40e0d0
                //if($("#"+"0"+num_11).text() == 0)
                // {
                //     view(num_11);
                // }
            }
            if(num_112.length == 2 && $("#"+num_11).text() != "M")
            {
                document.getElementById(num_11).style.visibility="visible";
                //document.getElementById("td"+num_11).style.background="#40e0d0
                // if($("#"+num_11).text() == 0)
                // {
                //     view(num_11);
                // }
            }
        }

        num_9 = parseInt(num) - 9;
        if((num_9 % 10 != 0))
        {
            num_92 = num_9.toString();
            if(num_92.length == 1 && $("#"+"0"+num_9).text() != "M")
            {
                document.getElementById("0"+num_9).style.visibility="visible";
                //document.getElementById("td"+"0"+num_9).style.background="#40e0d0";
                // if($("#"+"0"+num_9).text() == 0)
                // {
                //     view(num_9);
                // }
            }
            if(num_92.length == 2 && $("#"+num_9).text() != "M")
            {
                document.getElementById(num_9).style.visibility="visible";
                //document.getElementById("td"+num_9).style.background="#40e0d0";
                // if($("#"+num_9).text() == 0)
                // {
                //     view(num_9);
                // }
            }
        }
    };
    </script>
    <div id="hi"></div>
    <!-- Bootstrap Core js -->
    <script src="js/bootstrap.js"></script>
</body>
</html>