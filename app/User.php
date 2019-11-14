<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];

    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
    
    /*
    public function _construct(Request $request)
    {
        $this->request = $request;
        //$this->user = new User;
    }

    
    public function create(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
    }
    */
}
