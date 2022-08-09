<?php

namespace App\Helper;

use Illuminate\Support\Str;

class Helper
{
//    Load danh mục phía admin
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
        return $active == 0 ? '<span class="" style="color: red">Không hoạt động</span>'
            : '<span class="" style="color: #00A000">Hoạt động</span>';
    }
//    Load danh mục bên trang chủ khách hàng
    public static function categories($categories, $parent_id = 0)
    {
        $html = '';

        foreach ($categories as $key => $category)
        {
            if($category->parent_id == $parent_id){
                $html.='
                    <li>
                        <a href="/danh-muc/'. $category->id .'-'. Str::slug($category->name, '-').'.html">
                            '.$category->name.'
                        </a>';

                        if(self::isChild($categories, $category->id))
                        {
                            $html .='<ul class="sub-menu">';
                            $html .= self::categories($categories,$category->id);
                            $html .='</ul>';
                        }

                        unset($categories[$key]);

                        $html.='</li>
                ';
            }
        }

        return $html;
    }
//    Kiểm tra cấp 2 của danh mục
    public static function isChild($categories, $id)
    {
        foreach ($categories as $category)
        {
            if($category->parent_id == $id ){
                return true;
            }
        }
        return false;
    }

//    price
    public static function price($price = 0, $price_sale = 0)
    {
        if($price_sale != 0) return '<strike style="color: #0c84ff">'.number_format($price).'Vnd'.'</strike>'
            .'<br>'.number_format($price_sale).'Vnd';
        if($price != 0) return number_format($price).'Vnd' ;
        return '<a href="/contacts">Liên Hệ</a>';
    }
//    public static function price1($price = 0, $price_sale = 0)
//    {
//        if($price_sale != 0) return number_format($price_sale).'Vnd';
//        if($price != 0) return number_format($price).'Vnd' ;
//        return '<a href="/contacts">Liên Hệ</a>';
//    }
    public static function price2($price = 0, $price_sale = 0)
    {
        if($price_sale != 0) return $price_sale;
        if($price != 0) return $price;
        return '<a href="/contacts">Liên Hệ</a>';
    }


}
