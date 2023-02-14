<?php

namespace App\Http\Controllers;

use App\Mail\MailWelcome;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use QRcode;

class AuthController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        
        if ($request->has('moderator')) {
            $request['password']= '12345678';
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'sexe' => 'required',
            'phone' => 'required|numeric|digits:8',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors' => $validator->errors()],422);
        }
        $code = $request->email;
        $filename = 'test' . md5($code) . '.png';
        include(app_path() . '/phpqrcode/qrlib.php');
        QRcode::png($code, \public_path("temp/$filename"));
        $details = [
            'name' => $request->name,
            'qrcode' => "temp/$filename"
        ];
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,     
            'phone' => $request->phone,     
            'sexe' => $request->sexe,     
            'qr_code' => $filename,
            'password' => bcrypt($request->password)
        ]);

        Mail::to($request->email)->send(new MailWelcome($details));
        if ($request->has('moderator')) {
            return response()->json(['status'=>'success','message'=>'Compte crée avec succées!','token' => null, 'user' => $user,'qr_code'=> $filename], 200);
        }
        $token = $user->createToken('token')->accessToken;

        return response()->json(['message'=>'Votre compte est crée avec succées!', 'token' => $token, 'user' => $user], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $searchAccount = User::where('email', $credentials['email'])->first();
        if (!$searchAccount) {
            return response()->json(['error' => 'Compte non trouvé !'], 401);
        }

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('token')->accessToken;
            return response()->json(['token' => $token, 'user' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'Désolé, adresse e-mail ou mot de passe invalide !'], 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $user = Auth::user()->load(['roles']);
        return response()->json(['user' => $user], 200);
    }


    /**
     * Lougout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['message' => 'logged out'], 200);
    }
}
