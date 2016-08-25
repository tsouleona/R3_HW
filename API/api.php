<?php
header("Content-Type:text/html; charset=utf-8");
require_once 'MysqlConnect.php';

    $op = $_GET['option'];
    $api = new api();

        switch ($op)
        {
            case addUser:
                $api->addUser($_GET['username']);
                break;
            case getBalance:
                $api->getBalance($_GET['username']);
                break;
            case transfer:
                $api->transfer($_GET);
                break;
            case checktransfer:
                $api->checktransfer($_GET);
                break;
        }

    class api
    {
        public function checktransfer($data)
        {
            if($data['username'] == null || $data['transid']==null)
            {
                $array = ["Message"=>"ERROR", "parameters"=>"are not complete"];
                echo json_encode($array);
                exit;
            }
            $op = $this->checkId($data['username']);
            if(!$op)
            {
                $array = ["Message"=>"ERROR", "username"=>"is not exist"];
                echo json_encode($array);
                exit;
            }
            $op2 = $this->checkTransid($data['username'], $data['transid']);
            if(!$op2)
            {
                $array = ["Message"=>"ERROR", "transfer"=>"is not exist"];
                echo json_encode($array);
                exit;
            }
            $row = $this->getEntry($data['username'], $data['transid']);

            echo json_encode($row);
        }
        public function getEntry($username, $transid)
        {
            $sql = "SELECT * FROM `entry` WHERE `user_id`=? AND `transid`=?";
            $params = [$username, $transid];
            $connect = new Connect();
            $row = $connect->fetchData($sql, $params);
            $connect->pdo_connect = null;
            return $row;
        }
        public function transfer($data)
        {
            if($data['username'] == null || $data['transid']==null ||
                $data['action'] == null || $data['amount'] == null)
            {
                $array = ["Message"=>"ERROR", "parameters"=>"are not complete"];
                echo json_encode($array);
                exit;
            }
            $op = $this->checkId($data['username']);
            if(!$op)
            {
                $array = ["Message"=>"ERROR", "username"=>"is not exist"];
                echo json_encode($array);
                exit;
            }
            $result = $this->checkTransid($data['username'], $data['transid']);
            if($result)
            {
                $array = ["Message"=>"ERROR", "transid"=>"is exist"];
                echo json_encode($array);
                exit;
            }
            if($data['action'] == "IN")
            {
                $orderBalance = $this->getBalanceInt($data['username']);
                $newBalance = $orderBalance + $data['amount'];
                $this->insertEntry($data, $newBalance);
                $this->updateUser($newBalance, $data['username']);
                $array = ["Message"=>"SUCCESS", "Deposit"=>"is ok"];
                echo json_encode($array);
                exit;
            }
            if($data['action'] == "OUT")
            {
                $orderBalance = $this->getBalanceInt($data['username']);
                $newBalance = $orderBalance - $data['amount'];
                if($newBalance < 0)
                {
                    echo "餘額不足";
                    exit;
                }
                $this->insertEntry($data, $newBalance);
                $this->updateUser($newBalance, $data['username']);
                $array = ["Message"=>"SUCCESS", "Expense"=>"is ok"];
                echo json_encode($array);
            }
        }

        public function insertEntry($data, $newBalance)
        {
            $sql = "INSERT INTO `entry`(`user_id`, `transid`, `action`, `amount`, `balance`)
                VALUES(?, ?, ?, ?, ?)";
            $params = [$data['username'], $data['transid'], "OUT", $data['amount'], $newBalance];
            $connect = new Connect();
            $connect->executeSql($sql, $params);
            $connect->pdo_connect = null;
        }

        public function updateUser($newBalance, $username)
        {
            $sql = "UPDATE `user` SET `balance`=? WHERE `id`=?";
            $params = [$newBalance, $username];
            $connect = new Connect();
            $connect->executeSql($sql, $params);
            $connect->pdo_connect = null;
        }

        public function getBalanceInt($username)
        {
            $sql = "SELECT `balance` FROM `user` WHERE `id`='".$username."';";
            $params = [$username];
            $connect = new Connect();
            $row = $connect->fetchData($sql, $params);
            $connect->pdo_connect = null;

            return $row[0]['balance'];
        }

        public function checkTransid($username, $transid)
        {
            $sql = "SELECT `transid` FROM `entry` WHERE `user_id`=?";
            $params = [$username];
            $connect = new Connect();
            $row = $connect->fetchData($sql, $params);
            $connect->pdo_connect = null;
            $x = count($row);
            for($i = 0 ; $i < $x ; $i++)
            {
                if($transid == $row[$i]['transid'])
                {
                    return true;
                }
            }
            return false;
        }
        public function addUser($username)
        {
            if($username == null)
            {
                $array = ["Message"=>"ERROR", "username"=>"is null"];
                echo json_encode($array);
                exit;
            }
            $result = $this->checkId($username);
            if($result)
            {
                $array = ["Message"=>"ERROR", "username"=>"is exist"];
                echo json_encode($array);
                exit;
            }

            $sql = "INSERT INTO `user` (`id`, `balance`)VALUES(?, 0)";
            $params = [$username];
            $connect = new Connect();
            $connect->executeSql($sql, $params);
            $connect->pdo_connect = null;
            $array = ["Message"=>"SUEECSS","username"=>"created"];
            echo json_encode($array);

        }
        public function getBalance($username)
        {
            $sql = "SELECT `balance` FROM `user` WHERE `id`='".$username."';";
            $params = [$username];
            $connect = new Connect();
            $row = $connect->fetchData($sql, $params);
            $connect->pdo_connect = null;

            $array = ["Message"=>"SUEECSS",$username."'s balance is "=>$row[0]['balance']];
            echo json_encode($array);
        }
        public function checkId($username)
        {
            $sql = "SELECT `id` FROM `user`;";
            $params = [];
            $connect = new Connect();
            $row = $connect->fetchData($sql, $params);
            $connect->pdo_connect = null;
            $x = count($row);
            for($i = 0 ; $i < $x ; $i++)
            {
                if($username == $row[$i]['id'])
                {
                    return true;
                }
            }
            return false;
        }
    }
