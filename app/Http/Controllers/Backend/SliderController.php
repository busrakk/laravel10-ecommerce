<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use ImageResize;
use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        return view('backend.pages.slider.index', compact('sliders'));
    }

    public function create(){
        return view('backend.pages.slider.edit');
    }

    public function edit($id){
        $slider = Slider::where('id', $id)->first();
        return view('backend.pages.slider.edit', compact('slider'));
    }

    public function store(SliderRequest $request){

        $uploadFolder = 'img/slider/';
        if (!file_exists(public_path($uploadFolder))) {
            mkdir(public_path($uploadFolder), 0777, true); // Dizini oluştur ve izinleri ayarla
        }

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $extension = $img->getClientOriginalExtension();
            $folderName = time().'-'.Str::slug($request->name);
            // $uploadFolder = 'img/slider/';

            if (in_array($extension, ['pdf', 'svg', 'webp', 'jiff'])) { // Dosya uzantısına göre işlemler
                $img->move(public_path($uploadFolder), $folderName.'.'.$extension);
                $imgurl = $uploadFolder.$folderName.'.'.$extension;
            } else {
                $img = ImageResize::make($img);
                $img->encode('webp', 75)->save($uploadFolder.$folderName.'.webp');
                $imgurl = $uploadFolder.$folderName.'.webp';
            }
        }

        Slider::create([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $imgurl ?? NULL,
        ]);

        return back()->withSuccess('Slider created successfully');
        // return $request->all();
    }

    public function update(Request $request, $id){
        $uploadFolder = 'img/slider/';
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $extension = $img->getClientOriginalExtension();
            $folderName = time().'-'.Str::slug($request->name);

            if (in_array($extension, ['pdf', 'svg', 'webp', 'jiff'])) { // Dosya uzantısına göre işlemler
                $img->move(public_path($uploadFolder), $folderName.'.'.$extension);
                $imgurl = $uploadFolder.$folderName.'.'.$extension;
            } else {
                $img = ImageResize::make($img);
                $img->encode('webp', 75)->save($uploadFolder.$folderName.'.webp');
                $imgurl = $uploadFolder.$folderName.'.webp';
            }
        }

        Slider::where('id', $id)->update([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $imgurl ?? NULL,
        ]);

        return back()->withSuccess('Slider updated successfully');
        // return $request->all();
    }

    public function destroy($id){
        $slider = Slider::where('id', $id)->firstOrFail();

        if(file_exists($slider->image)){
            if(!empty($slider->image)){
                unlink($slider->image); // resmi sil
            }
        }

        $slider->delete();
        return back()->withSuccess('Slider deleted successfully');
    }

    public function status(Request $request){
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Slider::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error'=>false, 'status'=>$update]); // ajax kullanıldığı için response kullanıldı.
    }
}
