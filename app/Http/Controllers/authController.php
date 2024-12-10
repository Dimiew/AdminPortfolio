<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{

    function index() {
        return view('auth.dimm'); {
            
        }
    }

    function redirect() {
        return Socialite::driver('google')->redirect();
    }

    function callback() {
        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;
        $avatar = $user->avatar;


        // mengecek apakah email sudah terdaftar pada table database yaitu table users
        // count() : Kalo misal ada data nya, maka jumlah data tersebut lebih dari kosong
        $cek = User::where('email', $email)->count();
        if ($cek > 0) {
            $avatar_file = $id . ".jpg";
            $fileContent = file_get_contents($avatar);
            File::put(public_path("admin/images/faces/$avatar_file"), $fileContent);
            // agar email, name, and google_id masuk ke database.
            // kalau semisal ada isinya maka akan melakukan proses update
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'google_id' => $id,
                'avatar' => $avatar_file,
            ]
        );
        Auth::login($user);
        return redirect()->to('dashboard');
        }else {
            return redirect()->to('auth')->with('error', 'Akun mu belum terdaftarkan!');
        }
        
    }

    public function logout() {
        Auth::logout();
        return redirect()->to('auth');
    }
}
