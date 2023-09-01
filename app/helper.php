<!-- her sistem başlatıldığında çalışması için "autoload" alanına yazıldı -->
<?php

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
