<?php

namespace App\Helper;

use http\Exception\BadMessageException;

class Helper
{
    public static function category($categories, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $categories) {
            if($categories->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>'. $categories->id .'</td>
                    <td>'. $char . $categories->name .'</td>
                    <td>
                             <a href='. $categories->thumb .' target="_blank">
                               <img src='. $categories->thumb .' height="40px">
                             </a>
                    </td>
                    <td>'. self::active($categories->active) .'</td>
                    <td>'. $categories->updated_at .'</td>
                    <td>
                          <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' .$categories->id .' ">
                            <i class="fas fa-edit"></i>
                          </a>

                          <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow(' . $categories->id .', \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                          </a>
                    </td>
                </tr>

                ';

                unset($categories[$key]);

                $html .= self::categories($categories, $categories->id,$char.'|--');

            }

        }
        return $html;

    }
}
