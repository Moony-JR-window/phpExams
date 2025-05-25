

<?php

if($_SERVER['REQUES_METHOD']=='POST'){

    if(isset($_FILES['image'])&& ($_FILES['image'],['error']===UPLOAD_ERR_OK)){
        $file= $_FILES['image'];
        $size= 3* 1024*1024
        if(isset($file['size']>$size)){
            die("Imge Allow only leess than 3MB ")
        }
        $allowType= ['image/png','image/jpeg','image/gif','image/webp']
        if(!in_array($allowType , $file[]))
    }
}