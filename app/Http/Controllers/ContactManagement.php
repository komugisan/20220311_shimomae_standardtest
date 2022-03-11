<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactManagement extends Controller
{
        public function index()
    {
        $contacts = Contact::Paginate(10);
        $params = '';
        return view('message-management',['contacts' => $contacts, 'params' => $params]);
    }

    public function check(Request $request){
    if ($request->has('search')){
        list($contacts, $params) = $this->search($request);
    }elseif ($request->has('delete')){
        $params = '';
        $contacts = $this->delete($request->id);
    }
    return view('message-management',['contacts' => $contacts , 'params' => $params]);
    }

    public function search($request){

        switch(true){
            case $request->startDate == NULL && $request->endDate == NULL:
                $startDate = $request->startDate;
                $endDate = $request->endDate;
                break;

            case !$request->startDate == NULL && !$request->endDate == NULL:
                $startDate = Carbon::parse($request->startDate)->startOfDay();
                $endDate = Carbon::parse($request->endDate)->endOfDay();
                break;

            case !$request->startDate == NULL && $request->endDate == NULL:
                $startDate = Carbon::parse($request->startDate)->startOfDay();
                $endDate = $request->endDate;
                break;

            case $request->startDate == NULL && !$request->endDate == NULL:
                $startDate = $request->startDate;
                $endDate = Carbon::parse($request->endDate)->endOfDay();
                break;
        }

            $contacts = Contact::name($request->name)
            ->gender($request->gender)
            ->email($request->email)
            ->created_at($startDate,$endDate)
            ->get()->paginate(10);

            $params = [
                'name' =>$request->name,
                'gender' =>$request->gender,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'email' => $request->email,
                'search' => $request->search
            ];

            foreach($params as $key => $value){
                if($value == null){
                    $params[$key] = '';
                }
            }

        return [$contacts,$params];
    }

    public function delete($id){
        Contact::find($id)->delete();
        $contacts = Contact::Paginate(10);
        return $contacts;
    }
}