<?php

namespace App\Http\Controllers;

use App\CustomClasses\Token;
use App\User;
use App\Book;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    public function login(Request $request)
    {    
        if ($request->email != null) 
        {
            $user = User::where('email', $request->email)->first();
        }
        else 
        {
            return response()->json(['message' => 'No has enviado el email'], 401);    
        }
        if ($user->password == $request->password)
        {
            $data_token = new Token(['email' => $user->email]);
            $data_token = $data_token->encode();
            return response()->json(["token"=>$data_token], 201);
        }      
        return response()->json(['message' => 'No registrado'], 401);    
    }

    public function lend(Request $request)
    {
        $token = new Token();
        $header = $request->header("Authorization"); 

        $data_token = $token->decode($header);

        $user = User::where('email', $data_token->email)->first();
        $book = Book::where('title', $request->title)->first();
        $user->books()->attach($book);
        return response()->json(['Message' => 'Libro Prestado']);    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        $data_token = ["email"=>$user->email];
        
        $token = new Token($data_token);
        $token = $token->encode();

        return response()->json(["token"=> $token], 201);
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $users = User::all();
        foreach ($users as $key => $value) {
            return response()->json(['Users' => $value]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
