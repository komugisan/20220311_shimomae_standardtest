<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\Contact;

class ContactController extends Controller
{
        public function index()
    {
        $messages=[
            'lastname' => '',
            'firstname' => '',
            'gender' => 1,
            'email' => '',
            'postcode' => '',
            'address' => '',
            'building_name' => '',
            'opinion' => ''
        ];
        return view('contact',['messages' => $messages]);
    }

        public function postMessage(MessageRequest $request)
    {
        $data = $request->all();
        $request->session()->put('messages', $data);
        if($data['building_name'] === NULL){
            $data['building_name'] = 'NULL';
        }

        return redirect('message-check')->withInput();
    }

    public function checkMessage(Request $request){
        $messages = $request->session()->get('messages');
        return view('message-check', compact('messages'));
    }

    public function fixMessage(Request $request){
        $messages = $request->session()->get('messages');
        return view('contact',['messages' => $messages]);
    }


        public function sendMessage(Request $request)
    {
        $messages = $request->session()->get('messages');
        Contact::create([
            'fullname' => $messages['lastname'] . ' ' . $messages['firstname'],
            'gender' => $messages['gender'],
            'email' => $messages['email'],
            'postcode' => $messages['postcode'],
            'address' => $messages['address'],
            'building_name' => $messages['building_name'],
            'opinion' => $messages['opinion'],
        ]);

        return view('message-send');
    }
}
