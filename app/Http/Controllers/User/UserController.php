<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return response()->json(['data'=>$users]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $rule=[
            'name'=> 'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ];

        // validate
        $this->validate($request,$rule);

        $data=$request->all();
        $data['password']=bcrypt($request->password);
        $data['verified']=User::UNVERIFIED_USER;
        $data['verification_token']=User::generateVerificationCode();
        $data['admin']=User::REGULAR_USER;

        $user=User::create($data);
        return response()->json(['data'=>$user]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=User::findOrFail($id);
        return response()->json(['data'=>$user]);

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

        $user=User::findOrFail($id);
        $rules =[
            'email'=>'email|unique:users,email,'.$user->id,
            'password'=>'min6|confirmed',
            'admin'=>'in:'.User::ADMIN_USER.','.User::REGULAR_USER
        ];

        $this->validate($request,$rules);

        if ($request->has('name')){
            $user->name=$request->name;
        }

        if ($request->has('email') && $user->email != $request->email){
            $user->verified=User::UNVERIFIED_USER;
            $user->verification_tocken=User::generateVerificationCode();
            $user->email=$request->email;
        }

        if ($request->has('password')){
            $user->password=bcrypt($request->password);
        }

        if ($request->has('admin')){
            if (!$user->isVerified()){
                return response()->json(['error'=>'only verified use can modify this admin field','code'=>'409'],409);
            }

            //todo you must implement some other verification her ^_^

            $user->admin=$request->admin;
        }

        /**
         * there is no change here
         */
        if (!$user->isDirty()){
            return response()->json(['erro'=>'no change here','code'=>'422'],422);
        }

        $user->save();

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

        $user=User::findOrFail($id);
        $user->delete();
        return response()->json(['data'=>$user],200);

    }
}
