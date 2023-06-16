<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use QRcode;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'sexe' => 'required',
            'phone' => 'required|numeric|digits:8',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$userId,
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
        $user = User::findOrFail(Auth::user()->id);
        $oldQrcode = $user->qr_code;
        $code = $request->email;
        $filename = 'test' . md5($code) . '.png';
        include(app_path() . '/phpqrcode/qrlib.php');
        QRcode::png($code, \public_path("temp/$filename"));
        if ($filename != $oldQrcode) {
            $destination = 'temp/' . $oldQrcode;
            File::delete($destination);
        }
        $user['qr_code'] = $filename;
        $user->update($request->all());
        return response()->json(['user' => $user, 'qr_code' => $filename], 200);
    }

    public function getNames (){
        
        $names = User::pluck('name');
        return response()->json(['names' => $names], 200);

    }
}
