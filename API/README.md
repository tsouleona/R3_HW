# R3_HW API

1.建立帳號 (varchar)option=addUser
    參數:
        (varchar)username=你要設定的帳號

2.取得餘額 (varchar)option=getBalance
    參數:
        (varchar)username=你的帳號

3.轉帳 (varchar)option=transfer
    參數:
        (varchar)username=你的帳號
        (int)transid=不重複的轉帳序號
        (varchar)action=IN或是OUT(IN為轉入，OUT為轉出)
        (int)amount=要轉帳的金額

4.轉帳確認 (varchar)option=checktransfer
    參數:
        (varchar)username=你的帳號
        (int)transid=不重複的轉帳序號

https://lab1-srt459vn.c9users.io/R3_HW/API/api.php?option=addUser