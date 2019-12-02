<?php

namespace App\Http\Controllers;

use App\Mail\Command;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public static function index(Request $req) {
      $session = $req -> session() -> get("user");
		  $infos = [
			  'css_path' => 'home_page',
			  'script' => 'carousel',
        	'session' => $session
		];

	    return view('content.classic_user.home_page', compact('infos'));
	}

	public static function logout(Request $req) {
		$session = null;
		if($req -> session() -> exists("user")) {
	        $req -> session() -> pull("user");
	    }

	    $infos = [
			'css_path' => 'home_page',
			'script' => 'carousel',
	        'session' => $session
		];

      	return view("content.classic_user.home_page", compact('infos'));
	}

	public static function show(Request $req, $id){
    $session = $req->session()->get("user");
		$infos = [
			'css_path' => 'profile',
			'id' => $id,
      		'session' => $session
		];

    	return view('content.classic_user.user_profile', compact('infos'));
	}

	public static function login(Request $req) {
    if ($req -> getRequestUri() == '/login?success=false') {
      if($req -> session() -> exists("user")) {
        $req -> session() -> pull("user");
      }
    }

		$infos = [
			'css_path' => 'login_register',
			'class' => 'login',
		];

	    return view('content.classic_user.login', compact('infos'));
	}

	public static  function registration() {
		$infos = [
			'css_path' => 'login_register',
			'class' => 'registration',
			'script' => 'verifications'
		];

	    return view('content.classic_user.registration', compact('infos'));
	}

	public static function logSecure(Request $req) {
    $session = $req -> session() -> put('user',$req -> input("user"));
		$infos = [
			'css_path' => 'login_register',
			'class' => 'login'
		];

		return view('content.classic_user.secure_login', compact('infos'));
	}

	public static function regSecure(){
		$infos = [
			'css_path' => 'login_register',
			'class' => 'registration'
		];
		return view('content.classic_user.secure_registration', compact('infos'));
	}

	public static function shop(Request $req) {
    $session = $req -> session() -> get("user");
		$infos = [
			'css_path' => 'shop',
			'script' => 'carousel',
      		'session' => $session
		];

	    return view('content.classic_user.shop', compact('infos'));
	}

	public static function panier(Request $req, $id){
    $session = $req -> session() -> get("user");
		$infos = [
			'css_path' => 'panier',
			'id' => $id,
      		'session' => $session
		];

	    return view('content.classic_user.panier', compact('infos'));
	}

	public static function legalMentions(){
		$infos = [
			'css_path' => 'policy'
		];

	    return view('content.classic_user.legal_mentions', compact('infos'));
	}

	public static function cgu(){
		$infos = [
			'css_path' => 'policy'
		];

	    return view('content.classic_user.cgu', compact('infos'));
	}

	public static function cgv(){
		$infos = [
			'css_path' => 'policy'
		];

	    return view('content.classic_user.cgv', compact('infos'));
	}

  public static function showAct(Request $req, $id){
    $session = $req->session()->get("user");
    $infos = [
      'css_path' => 'activity',
      'id' => $id,
      'session' => $session
    ];

    return view('content.classic_user.activity', compact('infos'));
  }

  public static function regAct(Request $req, $id){
  	$session = $req->session()->get('user');

  	$infos = [
	    'id' => $id,
	    'session' => $session
    ];

    return view('content.classic_user.register_activity', compact('infos'));
  }

  public static function result(Request $req) {
    $session = $req->session()->get("user");
    $infos = [
      'css_path' => 'result',
      'script' => 'result',
      'session' => $session
    ];

    return view('content.classic_user.result', compact('infos'));
  }

  public static function picActPost($id){

  	$infos = [
  		'css_path' => 'login_register',
  		'id' => $id, 
  		'class' => 'registration'
  	];

  	return view('content.classic_user.pictures_act_post', compact('infos'));
  }

   public static function addCommand(Request $req, $product) {
		$infos = $product.'/';
		if ($req -> cookie('panier') !== null) {
			  $value = $req -> cookie('panier');
			  $newInfos = $value.$infos;
			  $cookie = cookie("panier",$newInfos, time() + 365*24*3600, null, null, false, true);
		} else {
		  	$cookie = cookie("panier",$infos, time() + 365*24*3600, null, null, false, true);
		}

		$details = [
            'title' => 'Title: ',
            'body' => 'Body: '
        ];

		\Mail::to('valentin.pain@viacesi.fr')->send(new Command($details));

		return redirect()->action('UsersController@shop')->cookie($cookie);
		}
}