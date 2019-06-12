<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminContactsController extends Controller
{

    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    //=========================================================//
    public function show()
    {
        return redirect()->route('contacts.index');
    }

    //=========================================================//
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        Session::flash('error', 'تم حذف الرسالة بنجاح');
        return redirect()->back();
    }

    //=========================================================//
    public function send($id)
    {
        $contact = Contact::findOrFail($id);

        $data = array( 'email' => $contact->email, 'name' => $contact->name,
            'from' => 'courses_academy@gmail.com');

        Mail::send( 'emails.reply', $data, function( $message ) use ($data)
        {
            $message->to( $data['email'] )->from( $data['from'],
                $data['name'] )->subject( 'Welcome!' );
        });


        Session::flash('success', 'تم إرسال الرسالة بنجاح');
        return redirect()->route('contacts.index');
    }

}
