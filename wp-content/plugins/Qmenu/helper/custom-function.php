<?php
function stripSpecial($str){
    $arr = array(",","$","!","?","&","'",'"',"+", "(", ")");
    $str = str_replace($arr,"",$str);
    $str = trim($str);
   while (strpos($str,"  ")>0) $str = str_replace("  "," ",$str);
    $str = str_replace(" ","-",$str);
    return $str;
}

function stripUnicode($str){
    if(!$str) return false;
    $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ','D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
     'i'=>'í|ì|ỉ|ĩ|ị', 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
     'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach($unicode as $khongdau=>$codau) {
      $arr = explode("|",$codau);
      $str = str_replace($arr,$khongdau,$str);
    }
    return $str;
}

function transformArray( $tbl ){
    //credit: https://stackoverflow.com/questions/45653938/php-array-merge-recursive-with-foreach-loop
    $collection = array_merge_recursive(...$tbl);
    //var_dump($collection);die;
    foreach($collection as &$item) 
    {

        if( $collection['MaBan'] == $item && is_array( $collection['MaBan'] ) || 
            $collection['TongDoanhThu'] == $item && is_array( $collection['TongDoanhThu'] ))
        {   
            //var_dump($item);die;
            $item = array_unique( $item );
           // $item = implode("", $item );
        }

        // if( $collection['MaBan'] !== $item && $collection['TongDoanhThu'] !== $item && $collection['TenHangBan'] !== $item
        //      && !is_array($item) )
        // {
        //     $item = explode(" ", $item );
        // }

        if( $collection['TenHangBan'] == $item && !is_array( $collection['TenHangBan'] ) ) 
        {
          //$tbl_transformed['TenHangBan'] = array();
          $item = array($item);
          //var_dump($tbl_transformed['TenHangBan']);die;
        }
        
    }
     //var_dump($collection);die;
    return $collection; //die;

}

function changeTitle($str){
    $str = stripUnicode($str);

    $str = ucwords($str);
    while (strpos($str,"  ")>0) $str = str_replace("  "," ",$str);
    $str = str_replace(" ","",$str);

    return $str;
}


function pr($array = null) { echo "<pre>" . print_r($array, true) . "</pre>"; } 

function combineTwoArraysIntoMultiDeArray($input)
{   
    
    $keys = array_keys($input);//pr( $keys );
    $values = array_values($input);//pr( $values );

    $menu_item  = array($keys[0] => $values[0]);

    /**
     * cach 1
     * 
     */
    $submenu_group = array_combine($input[$keys[1]], $input[$keys[2]]);
   
    $input = $menu_item  + array( 'submenu_group' => $submenu_group );
    
    /**
     * cach 2 (very complicated)
     */
        // $menu_subitem  = $input[$keys[1]];
    // $pics  = array($input[$keys[2]]);//pr($pics);die;

    // $result = [];
    // foreach( $menu_subitem as $index => $key )
    // {
    //   foreach($pics as $pic){
    //        $t = $pic[$index];
    //   }
    //   $result[$key] = $t;
    // }

    // $input = $menu_item  + array( 'submenu_group' => array_combine($menu_subitem , $result) );
    ////////////////////// 
    
    return $input;
}

function customizeArray($input)
{  
  $menu_item = $input['menu_item'];
  $menu_link = $input['menu_link'];
  $menu_pic = $input['menu_pic'];
  $submenu_group = array();
  $i = 0;
  foreach( $input['menu_subitem'] as $sub )
  {
    $submenu_group[] = array(
        'menu_subitem' => $sub, 
        'menu_sublink' => $input['menu_sublink'][$i], 
        'menu_subpic' => $input['menu_subpic'][$i]
    );

    $i++;
  }

  $submenu_group = array( 'submenu_group' => $submenu_group );

  unset( $input['menu_subitem'], $input['menu_sublink'], $input['menu_subpic'] );

  $output = array_merge( $input, $submenu_group );

 // pr ( $output );die;
  return $output;
}

function generateRandomString($length = 3) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ( $haystack as $k => $v ) {
        if ( ($strict ? $k === $needle : $k == $needle) ) {
            return true;
        }
    }

    return false;
}
//ref: https://stackoverflow.com/questions/4128323/in-array-and-multidimensional-array