<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Events\UserLoginEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\API\LoginAPIRequest;
use App\Http\Requests\API\RegisterAPIRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\Http\Controllers\AppBaseController;

class AuthController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginAPIRequest $request)
    {
        //
        $user = User::where('email', $request->email)->first();
        if($user == null || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'email' => ['The provided credentials are incorrect.'],
            ], 200);
        }

        UserLoginEvent::dispatch($user);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
    
            return $this->sendResponse([
                'token' => $user->createToken('API Token')->plainTextToken,
                'profile' => $user,
                'role' => Auth::user()->getRoleNames()
            ],
            'Login successful'
        );
        }
    }

    public function register(RegisterAPIRequest $request)
    {

        $request->validated($request->all());

        $user = User::create([
            'username' => $request->username,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->sendResponse([
            'user' => $user,
            'token' => $user->createtoken('API Token')->plainTextToken,
        ],
        'Registration successful'
      );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
