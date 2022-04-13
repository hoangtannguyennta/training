<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $title = "Danh sách người dùng";
        $users = User::all();
        return view('user.list',compact('users','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm người dùng";
        return view('user.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];
        $messages = [
            'name.required'=>'Vui lòng nhập tên!',
            'name.min'=>'Vui lòng nhập tên không ít hơn 3 ký tự!',
            'name.max'=>'Vui lòng nhập tên không quá hơn 50 ký tự!',
            'password.required'=>'Vui lòng nhập mật khẩu!',
            'password.confirmed'=>'Mật khẩu không khớp !',
            'password.min'=>'Vui lòng nhập mật khẩu ít hơn 6 ký tự!',
            'email.unique'=>'Email đã tồn tại!',
            'email.required'=>'Vui lòng nhập email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('user.create')->withErrors($validator)->withInput();
        else:
            $atribute = new User;
            $atribute['name'] = $request->name;
            $atribute['email'] = $request->email;
            $atribute['password'] = Hash::make($request->password);
            $atribute->save();
            return redirect()->route('user.create')->with('success','#');
        endif;
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhật người dùng";
        $users = User::findOrFail($id);
        return view('user.edit',compact('users','title'));
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
        $atribute = User::findOrFail($id);
        $rules = [
            'name' => 'required|min:3|max:50',
            'email'=>['required','string','email','max:255',Rule::unique('users')->ignore($atribute->id)],
        ];
        $messages = [
            'name.required'=>'Vui lòng nhập tên!',
            'name.min'=>'Vui lòng nhập tên không ít hơn 3 ký tự!',
            'name.max'=>'Vui lòng nhập tên không quá hơn 50 ký tự!',
            'email.unique'=>'Email đã tồn tại!',
            'email.required'=>'Vui lòng nhập email',
        ];
        if($request->password != ''){
            $rules = [
                'password' => 'required|string|confirmed|min:6',
            ];
            $messages = [
                'password.required'=>'Vui lòng nhập mật khẩu!',
                'password.confirmed'=>'Mật khẩu không khớp !',
                'password.min'=>'Vui lòng nhập mật khẩu ít hơn 6 ký tự!',
            ];
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->back()->withErrors($validator)->withInput();
        else:
            $atribute['name'] = $request->name;
            $atribute['email'] = $request->email;
            if($request->password != '') $atribute['password'] = Hash::make($request->password);
            $atribute->save();
            if($atribute->wasChanged()){ 
                return redirect()->back()->with('success','#');
            }else{
                return redirect()->back();
            }
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('user.index');
    }
}
