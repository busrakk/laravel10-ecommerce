<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContentFormRequest;

class AjaxController extends Controller
{
    public function contactsave(ContentFormRequest $request){
        // zorunlu alanlar
        ///// ContentFormRequest 'ten çağırıldı............
        // $validationData = $request->validate([
        //     'name' => 'required|string|min:3',
        //     'email' => 'required|email',
        //     'subject' => 'required',
        //     'message' => 'required',
        // ]);

        // mesajlar değiştirmek istersek
        // $validationData = $request->validate([
        //     'name' => 'required|string|min:3',
        // ], [
        //     'name.required' => 'İsim zorunlu!',
        //     'name.string' => 'Karakterden oluşmalı',
        //     'name.min' => 'En az 3 Karakterden oluşmalı',
        // ]);

        // $data = $request->all();
        // $data['ip'] = request()->ip();
        //return $data;

        $newData = [
            'name' => Str::title($request->name),
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => $request->ip(),
        ];
        $lastsave = Contact::create($newData);

        return back()->withSuccess('Successfully sent.');
        // return back()->with([
        //     'message' => 'Successfully sent',
        //     //'errors' => $validationData,
        // ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
