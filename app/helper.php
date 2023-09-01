<?php
// <!-- her sistem başlatıldığında çalışması için "autoload" alanına yazıldı -->

if(!function_exists('dosyasil')){
    function dosyasil($string){
        if(file_exists($string)){
            if(!empty($string)){
                unlink($string);
            }
        }
    }
}

if(!function_exists('resimyukle')){
    function resimyukle($img, $name, $yol){
            $extension = $img->getClientOriginalExtension();
            $folderName = time().'-'.Str::slug($name);

            if (in_array($extension, ['pdf', 'svg', 'webp', 'jiff'])) { // Dosya uzantısına göre işlemler
                $img->move(public_path($yol), $folderName.'.'.$extension);
                $imgurl = $yol.$folderName.'.'.$extension;
            } else {
                $img = ImageResize::make($img);
                $img->encode('webp', 75)->save($yol.$folderName.'.webp');
                $imgurl = $yol.$folderName.'.webp';
            }
            return $imgurl;
    }
}

if(!function_exists('strLimit')){
    function strLimit($text, $limit, $url=null){
        if($url == null){
            $end = '...';
        }else{
            $end = '<a class="ml-2" href="' . $url . '">[...]</a>';
        }
        return Str::limit($text, $limit, $end);
    }
}
