<?php

namespace App;

class View {
    public static function page($page, $data = array()){
        //get the file from the views folder
        $file = dirname(__FILE__) . "/../views/" . "$page.view.php";
        //check if file exists
        if(file_exists($file)){
            //Extract variables from the array
            extract($data);

            // include the template
            include $file;

        }else {
            //if the file not found go to 404 page
            echo "file does not exist";
        }
    }
}