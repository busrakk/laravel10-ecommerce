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

if(!function_exists('folderOpen')){
    function folderOpen($folderPath, $permissions = 0777){
        if(!file_exists($folderPath)){
            mkdir($folderPath, $permissions, true);
        }
    }
}

// random order sıra oluşturma
if(!function_exists('generateOTP')){
    function generateOTP($n){
        $generator = "123456789123";
        $result = '';
        for($i=1;$i<$n;$i++){
            $result = substr($generator,(rand()%(strlen($generator))),1);
        }
        return $result;
    }
}

if (!function_exists('sifrele')) {
    function sifrele($string){
        return encrypt($string);
    }
}

if (!function_exists('sifrelecoz')) {
    function sifrelecoz($string){
        return decrypt($string);
    }
}
