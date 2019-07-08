<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;//para redes sociales
use App\User;//para crear el usuario

class SocialiteController extends Controller
{
	//validar drivers disponibles
	private $availableDrivers = [
		'facebook','twitter', 'google'
	];
     //llamado a la red social
     public function redirectToProvider($provider)
    {
    	if (!in_array($provider, $this->availableDrivers)) {
    		return redirect()->route('login');
    	}
        
        return Socialite::driver($provider)->redirect();
    }

    //recuperamos la informacion del usuario desde la red social
    public function handleProviderCallback($provider)
    {
    	//si no es un provedor valido redireccionar a la pagina de login
    	if (!in_array($provider, $this->availableDrivers)) {
    		return redirect()->route('login');
    	}

        $userSocial = Socialite::driver($provider)->user();
        //dd($user);//imprime en pantalla para ver los datos que obtuvimos

        //validacion para permitir correos  nulos
        if ($userSocial->getEmail()) {
        	//obtener datos
      		  $user = User::where('email', $userSocial->getEmail())->first();
        }else{//el usuario no tiene registrado correo en la red social
        	//obtener datos
       		 $user = User::where($provider.'_id', $userSocial->getID())->first();
        }
        
        //actualizar informacion
        if ($user)
        {
        	$user->update([
                'name' =>  $userSocial->getName(),
                $provider.'_id' => $userSocial->getId(),
                'nick' => $userSocial->getNickname(),
                'avatar' => $userSocial->getAvatar()
            ]);
        }//crear nuevo usuario
        else {
            //usar los datos recuperados para registrar al usuario en nuestra aplicacion
            $user = User::create([
                'name' =>  $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'password' => '',
                $provider.'_id' => $userSocial->getId(),
                'nick' => $userSocial->getNickname(),
                'avatar' => $userSocial->getAvatar()
            ]);
        }
        //iniciar sesion en la aplicacion
       // Auth::login($user);//necesita cargar el use auth
        auth()->login($user);//o se puede utilizar el helper
        return redirect()->route('home');
    }
}
