<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public static function index(Request $req) {
    	$session = $req -> session() -> get("user");
		$infos = [
			'css_path' => 'admin',
            'script' => 'listItem',
            'session' => $session
		];

	    return view('content.admin.admin_index', compact('infos'));
	}

	public static function insert(Request $req) {
		$session = $req -> session() -> get("user");
		$infos = [
			'css_path' => 'admin',
			'session' => $session
		];

	    return view('content.admin.admin_insert', compact('infos'));
	}

	  public static function see(Request $req){
	  	$session = $req -> session() -> get("user");
        $infos = [
            'css_path' => 'admin',
            'script' => 'event',
            'session' => $session
        ];

        return view('content.admin.admin_see', compact('infos'));
    }

    public static function pictures(Request $req){
    	$session = $req -> session() -> get("user");
    	$infos = [
	  		'css_path' => 'login_register',
	  		'class' => 'registration',
	  		'session' => $session
	  	];

	  	return view('content.admin.pictures_admin_post', compact('infos'));
    }
}
