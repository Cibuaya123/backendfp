<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User; // panggil model User
use App\Models\Log; // panggil model User
use Firebase\JWT\JWT; // panggil libary Jwt
use Illuminate\Support\Facades\Validator; // panggil libary validator untuk validasi inputan
use Illuminate\Support\Facades\Auth; // panggil libary untuk otentikasi
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthController extends Controller
{
    // fungsi atau untuk registrasi akun
    public function register(Request $request){
     
        // buat validasi inputan
    $validator = Validator::make($request->all(),[
        'name'=>'required', // nama harus isi
        'email'=>'required|email|unique:users,email', // email harus diisi,berformat email,dan unik
        'password'=>'required|min:8', //assword minimal harus diisi 8 karakters
        'confirmation_password'=>'required|same:password' // konfirmasi password harus diisi,dan sesuai dengan password
    ]);
    // kondisi ketika satu atau lebih dari inputan tidak sesuai aturan di atas
    if($validator->fails()){
        return messageError($validator->messages()->toArray());
        
    }
    $user =$validator->validated();

    //masukan kedatabase tabel user
    User::create($user);

    //isi token jwt
    $payload =[
        'name'=> $user ['name'],
        'role'=>'users',
        'iat'=> now()->timestamp, // waktu  di buat
        'exp'=>now()->timestamp + 7200 // waktu toen kadaluarsa (2 jam setelah token dibuat)
    ];
    //generate token dengan algoritma Hs256
    $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');

    //buat login
    log::create([
        'module'=>'login',
        'action'=>'login_akun',
        'useraccess'=>$user['email']
    ]);
    // kirim response ke pengguna
    return response()->json([
    "data"=>[
        'msg'=>'berhasil login',
        'name'=>$user['name'],
        'email'=>$user['email'],
        'role'=>'user'
    ],
    "token"=> "Bearer {$token}"
],200);

    }
    
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return messageError($validator->messages()->toArray());
            
        }
        if (Auth::attempt($validator->validated())) {
            $payload =[
                'name'=> Auth::user()->name,
                'role'=>Auth::user()->role,
                'iat'=> now()->timestamp, // waktu  di buat
                'exp'=>now()->timestamp + 7200 // waktu toen kadaluarsa (2 jam setelah token dibuat)
            ];
            $token = JWT::encode($payload,env('JWT_SECRET_KEY'),'HS256');
            Log::create([
                'module'=>'login',
                'action'=>'login_akun',
                'useraccess'=>Auth::user()->email
            ]);
            return response()->json([
                "data"=>[
                    'msg'=>'berhasil login',
                    'name'=>Auth::user()->name,
                    'email'=>Auth::user()->email,
                    'role'=>Auth::user()->role
                ],
                "token"=> "Bearer {$token}"
            ],200);
        }
        return response()->json("email atau password salah",422);
    }
 
 
       
    
}
