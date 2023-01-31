<?php
include "config.php";

$result = 0;
$table = (!empty($_POST['table'])) ? htmlspecialchars($_POST['table']) : '';
$id = (!empty($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
$attr = (!empty($_POST['attr'])) ? htmlspecialchars($_POST['attr']) : '';
$check = $_POST['check'];


if($check == "true"){
    if ($id) {
        $status_detail = $d->rawQueryOne("select status from #_$table where id = $id limit 0,1");
        $status_array = (!empty($status_detail['status'])) ? explode(',', $status_detail['status']) : array();
        
        foreach ($status_array as $k => $v) {
            if($v == $attr){
                unset($status_array[$k]);
            }
        }

        if(array_search($attr, $status_array) !== true) {
            array_push($status_array, $attr);
        }       

        $data = array();
        $data['status'] = (!empty($status_array)) ? implode(',', $status_array) : "";
        $d->where('id', $id);
        if ($d->update($table, $data)) {
            $result = 1;
            $cache->delete();
        }
    }
}
else if($check == "false"){
    if ($id) {
        $status_detail = $d->rawQueryOne("select status from #_$table where id = $id limit 0,1");
        $status_array = (!empty($status_detail['status'])) ? explode(',', $status_detail['status']) : array();
        
        if (array_search($attr, $status_array) !== false) {
            $key = array_search($attr, $status_array);
            unset($status_array[$key]);
        }

        $data = array();
        $data['status'] = (!empty($status_array)) ? implode(',', $status_array) : "";
        $d->where('id', $id);
        if ($d->update($table, $data)) {
            $result = 2;
            $cache->delete();
        }
    }
}

echo $result;
