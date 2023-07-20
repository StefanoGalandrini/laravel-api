<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MailToAdmin;
use App\Mail\MailToLead;
use App\Models\Lead;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $validations = [
        'name'          => 'required|string|min:5|max:50',
        'email'         => 'required|email|max:255',
        'message'       => 'required|string',
        'newsletter'    => 'required|boolean',
    ];

    public function store(Request $request)
    {
        $data = $request->all();

        // validate
        $validator = Validator::make($data, $this->validations);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors(),
            ]);
        }

        // save in db
        $newLead = new Lead();
        $newLead->name = $data['name'];
        $newLead->email = $data['email'];
        $newLead->message = $data['message'];
        $newLead->newsletter = $data['newsletter'];

        $newLead->save();

        // send email to lead to confirm
        Mail::to($newLead->email)->send(new MailToLead($newLead));


        //send email to admin to manage request
        // Mail::to(env('ADMIN_ADDRESS', 'admin@boolpress.com'))->send(new MailToAdmin($newLead));

        // return success to frontend
        return response()->json([
            'success' => true,
        ]);
    }
}
