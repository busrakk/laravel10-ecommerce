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

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/slider/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
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

        $slider = Slider::where('id', $id)->firstOrFail();

        if ($request->hasFile('image')) {
            dosyasil($slider->image);

            $img = $request->file('image');
            $folderName = $request->name;
            $uploadFolder = 'img/setting/';
            folderOpen($uploadFolder);
            $imgurl = resimyukle($img, $folderName, $uploadFolder);
        }

        $slider->update([
            'name' => $request->name,
            'content' => $request->content,
            'link' => $request->link,
            'status' => $request->status,
            'image' => $imgurl ?? NULL,
        ]);

        return back()->withSuccess('Slider updated successfully');
        // return $request->all();
    }

    public function destroy(Request $request){
        $slider = Slider::where('id', $request->id)->firstOrFail();

        // bu kısmı helper.php dosyasında fonk oluşturuldu
        // if(file_exists($slider->image)){
        //     if(!empty($slider->image)){
        //         unlink($slider->image); // resmi sil
        //     }
        // }

        dosyasil($slider->image);

        $slider->delete();
        return response(['error'=>false, 'message'=>'Slider deleted successfully']);
    }

    public function status(Request $request){
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Slider::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error'=>false, 'status'=>$update]); // ajax kullanıldığı için response kullanıldı.
    }
}
