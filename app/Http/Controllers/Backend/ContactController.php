<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::paginate(10);
        return view('backend.pages.contact.index', compact('contacts'));
    }

    public function edit($id){
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('backend.pages.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id){
        $update = $request->statu;
        Contact::where('id', $id)->update(['status' => $update]);
        return back()->withSuccess('Contact updated successfully');
    }

    public function destroy(Request $request){
        $contact = Contact::where('id', $request->id)->firstOrFail();

        $contact->delete();
        return response(['error'=>false, 'message'=>'Contact deleted successfully']);
    }

    public function status(Request $request){
        $update = $request->statu;
        $updateCheck = $update == "false" ? '0' : '1';
        Contact::where('id', $request->id)->update(['status' => $updateCheck]);
        return response(['error'=>false, 'status'=>$update]); // ajax kullanıldığı için response kullanıldı.
    }
}
