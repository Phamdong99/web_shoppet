<?php

namespace App\Helper;

use http\Exception\BadMessageException;

class Helper
{
    public static function category($categories, $parent_id = 0, $char = '')
    {
        $html  = '';

        foreach ($categories as $key => $category){
            if($category->parent_id == $parent_id){
                $html .= '
                <tr>
                <td>'. $category->id .'</td>
                <td>'. $char . $category->name .'</td>
                <td>
                             <a href='. $category->file .'  target="_blank">
                               <img src='. $category->file .' height="40px" alt="">
                             </a>
                    </td>
                <td>'. self::active($category->active) .'</td>
                <td>'. $category->created_at .'</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/categories/edit/'. $category->id .'">
                    <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                    onclick="removeRow('. $category->id .', \'/admin/categories/destroy\')">
                    <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
                </tr>
                ';

                //Sau khi lấy được danh mục cha rồi thì ta xoá đi tại vị trí key
                unset($categories[$key]);
                //chạy lại function ,chính nó là self
                //sau khi lấy được id cha rồi thì lấy id cha tìm kiếm con của nó
                $html .= self::category($categories, $category->id, $char.'|--');
            }
        }
        return $html;

    }
    public static function active($active = 0)
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">Không hoạt động</span>'
            : '<span class="btn btn-success btn-xs">Hoạt động</span>';
    }
}
