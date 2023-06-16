<?php

namespace App\Http\Controllers;

use App\Mail\MailWelcome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
// use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use QRcode;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;
    // use ResetsPasswords;
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // date_default_timezone_set('Africa/Tunis');

        // dd(Carbon::now()->add(5, 'minute')->toDateTimeString());
//         $origin = date_create('2020-11-13 22:10:00');
//   $target = date_create('2020-11-25 21:10:00');
//   $interval = date_diff($origin, $target);
//   return $interval->format('%a days, %h hours');
        if ($request->has('moderator')) {
            $request['password'] = '12345678';
            $request['password_confirmation'] = '12345678';
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'sexe' => 'required',
            'phone' => 'required|numeric|digits:8',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
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
            return response()->json(['status' => 'success', 'message' => 'Compte crée avec succées!', 'token' => null, 'user' => $user, 'qr_code' => $filename], 200);
        }
        $token = $user->createToken('token')->accessToken;

        return response()->json(['message' => 'Votre compte est crée avec succées!', 'token' => $token, 'user' => $user], 200);
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

        if (RateLimiter::tooManyAttempts(request()->ip(), 3)) {
            return response()->json(
                [ 'message' => 'Too many fail login attempt your ip has restricted for 1 minute.' ], 
                429
            );
        }
        $searchAccount = User::where('email', $credentials['email'])->first();
        if (!$searchAccount) {
            return response()->json(['error' => 'Compte non trouvé !'], 401);
        }

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('token')->accessToken;
            return response()->json(['token' => $token, 'user' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'Désolé, Mot de passe Incorrect !'], 401);
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

    /**
     * Send password reset link. 
     */
    public function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }


    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'message' => 'Un lien est envoyé à votre email, verifier votre boite de reception',
            // 'data' => $response
        ],200);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => "Ce compte n'existe pas!"],403);
    }

    /**
     * Handle reset password 
     */
    public function callResetPassword(Request $request)
    {
        return $this->resetPassword($request);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Mot de passe reinitialisé avec succées!'],200)
            : response()->json(['message' => 'Ce lien peut être expiré ou le token est invalid!'],498) ;
    }



    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset successfully.']);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed, Invalid Token.']);
    }
}
