<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderByDesc('id')->get();
        return view('admin.contact.index', ['contacts' => $contacts]);
    }
    
    public function detail ($id)
    {
        $contact = Contact::find($id);

        if ($contact != null) {
            
            $contact->trang_thai = 1;
            $contact->save();

            return view('admin.contact.detail', ['contact' => $contact ]);
        }

        return redirect()->back()->with('error', 'Phản hồi không tồn tại');
    }
    
    public function delete ($id)
    {
        $contact = Contact::find($id);

        if ($contact != null) {
            $contact->delete();
            return redirect()->back()->with('success', 'Xóa phản hồi thành công');
        }

        return redirect()->back()->with('error', 'Phản hồi không tồn tại');
    }
}
