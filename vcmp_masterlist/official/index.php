<?php
    if ($db = new PDO('sqlite:..\database.db'))
    {
        $db->exec("CREATE TABLE IF NOT EXISTS list (ip TEXT NOT NULL, port INTEGER NOT NULL, is_official BOOL NOT NULL)");
        $q = $db->query("SELECT * FROM list WHERE is_official != 0");
        if ($q)
        {
            $result = array('success' => true, 'servers' => array());
           // echo json_encode($result);
            for($i = 0;$item = $q->fetch();$i++)
            {
                $item['is_official'] = ($item['is_official'] != 0);
                $result['servers'][$i] = $item;
            }
            echo json_encode($result);
            $q = null;
            exit();
        }
    }
    header("HTTP/1.0 500 Internal Server Error");
    $result = array('success' => false, 'errorCode' => 1, 'error' => 'Failed to query the masterlist database');
    echo json_encode($result);
?>
