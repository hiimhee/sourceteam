<?php
    include "config.php";
    function simplePagingMore($spcon,$cur_p,$total_p,$tab_return,$page_per,$table_select,$type_select,$where_select,$id_danhmuc,$id_list='') {
        $str_page = '<div class="btn_viewmore d-flex justify-content-center align-items-center">';
        $str_page .= '<a class="text-white btn btn-dark '.$class.'" data-page="'.($cur_p+1).'" data-tab="'.($tab_return).'" data-per="'.($page_per).'" data-table="'.($table_select).'" data-type="'.($type_select).'" data-where="'.($where_select).'"  data-danhmuc="'.($id_danhmuc).'" data-list="'.($id_list).'">'.xemthem.' '.$spcon.' '.sanpham.'</a>';
        $str_page .= '</div>';
        return $str_page;
    }
    function simplePaging($cur_p,$total_p,$tab_return,$page_per,$table_select,$type_select,$where_select,$id_danhmuc,$id_list='') {
        $str_page = '<nav aria-label="Pagingnation" class="d-flex justify-content-center align-items-center"><ul class="pagination paging-sm m-0">';
        $str_page .= '
        <li class="page-item">
          <a data-page="1" data-tab="'.($tab_return).'" data-per="'.($page_per).'" data-table="'.($table_select).'" data-type="'.($type_select).'" data-where="'.($where_select).'"  data-danhmuc="'.($id_danhmuc).'" data-list="'.($id_list).'" class="page-link">&laquo;</a>
        </li>';
        for ($i=1; $i<=$total_p; $i++) {
            $class = ($i == $cur_p) ? 'bg-primary active text-white' : '';
            $str_page .= '
            <li class="class="page-item"">
                <a class="page-link '.$class.'" data-page="'.($i).'" data-tab="'.($tab_return).'" data-per="'.($page_per).'" data-table="'.($table_select).'" data-type="'.($type_select).'" data-where="'.($where_select).'"  data-danhmuc="'.($id_danhmuc).'" data-list="'.($id_list).'">'.$i.'</a>
            </li>';
        };
        $str_page .= '
        <li class="page-item">
          <a data-page="'.($total_p).'" data-tab="'.($tab_return).'" data-per="'.($page_per).'" data-table="'.($table_select).'" data-type="'.($type_select).'" data-where="'.($where_select).'"  data-danhmuc="'.($id_danhmuc).'" data-list="'.($id_list).'" class="page-link">&raquo;</a>
        </li>';
        $str_page .= '</ul></nav>';
        return $str_page;
    }
    $id_danhmuc = (int)$_POST['id_danhmuc'];
    $id_list = (int)$_POST['id_list'];
    $page_per = (int)$_POST['page_per'];
    $table_select = (string)$_POST['table_select'];
    $type_select = (string)$_POST['type_select'];
    $where_select = (string)$_POST['where_select'];
    $tab_return = (string)$_POST['tab_return'];
    $page = (string)$_POST['page'];
    $viewmore = (int)$_POST['viewmore'];
    if ($page < 1) {
        $page = 1;
    }
    $limit = $page_per;
    $start = ($limit * $page) - $limit;
    if($id_danhmuc) $where_tmp .= " and id_list = " . $id_danhmuc;
    if($id_list) $where_tmp .= " and id_cat = " . $id_list;
    $where = "find_in_set('hienthi',status) and type='$type_select' $where_select $where_tmp order by numb,id desc";
    $text_sql = "select * from table_$table_select where $where limit $start,$limit";
    $text_sql2 = "select count(id) as dem from table_product where $where";
    $count_num = $d->rawQueryOne($text_sql2);
    $page_count = ceil($count_num['dem'] / $page_per);
    $product = $d->rawQuery($text_sql);
    $spcon = ceil($count_num['dem'] - (count($product) * $page));
?>
<?php if($product) {
    echo $func->GetProducts($product, 'boxProduct');
} else { ?>
<div class="alert alert-warning" role="alert">
    <?=khongtimthayketqua?>
</div>
<?php } ?>
<?php if($page_count>1) { ?>
    <?php if($viewmore==1) { ?>
        <?php if($page<$page_count) { ?>
            <div class="clearfix"></div>
            <?=simplePagingMore($spcon,$page,$page_count,$tab_return,$page_per,$table_select,$type_select,$where_select,$id_danhmuc,$id_list)?>
        <?php } ?>
    <?php } else { ?>
        <div class="clearfix"></div>
        <?=simplePaging($page,$page_count,$tab_return,$page_per,$table_select,$type_select,$where_select,$id_danhmuc,$id_list)?>
    <?php } ?>
<?php } ?>