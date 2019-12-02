<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffCesi extends Controller
{
    public static function index(Request $req) {
        $session = $req -> session() -> get("user");
        $infos = [
            'css_path' => 'staff',
            'script' => 'listAdmin',
            'session' => $session
        ];

        return view('content.cesi_staff.notif_staff', compact('infos'));
    }

    public static function download(){
    	return view('content.cesi_staff.download_pictures');
    }
}
