<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Models\Participations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipationsController extends Controller
{
    public function participateInEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'panels_checked' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors' => $validator->errors()]);
        }
        $panels = $request->panels_checked;
        $qrCodeEmail = $request->data;
        $user = User::where('email', $qrCodeEmail)->first();

        if (empty($user)) {
            return response()->json(["message" => "utilisateur introuvable! "], 404);
        }

        $participation = Participations::where('user_id', $user->id)->whereIn('panel_id', $panels)->get();
        if ($participation->count() > 0) {
            // $panelsId = $participation->pluck('panel_id');
            // $name = '';
            // $panlsName = Panel::whereIn('id', $panelsId)->pluck('name');
            // foreach ($panlsName as $key => $value) {
            //     $name = $name ." ". $value ."\n" ;
            // }
            return response()->json(["message" => "Vous êtes déjà participé à l'un des panels!"], 400);
        }

        $user->participation()->attach($panels);

        return response()->json(["status"=>"success" ,"message" => "Participation avec succées!"], 200);
    }
}
