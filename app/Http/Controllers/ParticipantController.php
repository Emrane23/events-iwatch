<?php

namespace App\Http\Controllers;

use App\Mail\MailWelcome;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use QRcode;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $input =  $request->all();
       // include(app_path().'/phpqrcode/qrlib.php');
        $code = $request->email ;
        $filename ='test' . md5($code) . '.png';
        include(app_path().'/phpqrcode/qrlib.php'); 
        QRcode::png($code, \public_path("temp/$filename"));
        $input['qr_code']= $filename;
        Participant::create($input);
        $details = [
            'name' => $request->name , 
            'qrcode' => "temp/$filename"
        ] ;
        // Mail::send('email.welcome',$details,function($message) use ($request,$filename){
        //     $message->to($request->email)
        //     ->subject("Welcome to iWatch MAC")
        //     ->attach("temp/$filename");
        // });

        Mail::to($request->email)->send(new MailWelcome($details));
        return response()->json(['status'=>'success','message'=>'participant saved succefully !' ],201);

    }

    /**p
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
