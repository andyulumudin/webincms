<?php

if(!function_exists('menuItem')) {
    function menuItem($data, $parent) {
        if(isset($data[$parent])) {
        $html = '';
        foreach($data[$parent] as $item) {
            $child = '';
            $check = menuItem($data,$item['menu_id']);
            if($check) {
            $child = $check;
            }
            
            $html .= '<div class="sortable-group">
                <div class="sortable-item">
                    <a href="javascript:;" class="sortable-handle"><i class="bx bx-grid-vertical"></i></a> 
                    <a data-fancybox data-type="iframe" href="'.base_url(ADMINURL.'/menu/detailitem/' . $item['menu_id']). '" class="flex-grow sortable-name">' . $item['menu_title'] . '</a> 
                    <a href="'.base_url(ADMINURL.'/menu/deleteitem/' . $item['menu_id']). '" onclick="return confirm(\'Are you sure want to delete this item?\');" class="sortable-delete"><i class="bx bxs-trash"></i></a>

                    <input type="hidden" class="menu-id" name="menu[' . $item['menu_id'].'][id]" value="' . $item['menu_id'].'">
                    <input type="hidden" class="menu-parent" name="menu[' . $item['menu_id'].'][parent]" value=" ' .$item['menu_parent'].'">
                    <input type="hidden" class="menu-order" name="menu[' . $item['menu_id'].'][order]" value=" ' .$item['menu_order'].'">
                </div>
                <div class="sortable-wrapper sortable-subgroup nested nested-sortable" data-id="' . $item['menu_id'].'">'.$child.'</div>
            </div>';
        }

        return $html;

        }
    }
}