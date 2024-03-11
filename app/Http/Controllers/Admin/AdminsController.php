<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lib\HelperTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{

    use HelperTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;


        $admins = User::where('role_id',1)->whereHas('admin')->latest()->paginate($perPage);

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $display_image = resizeImage('img/no_image.jpg', 100, 100,$this->getBaseUrl());
        $no_image = resizeImage('img/no_image.jpg', 100, 100,$this->getBaseUrl());
        return view('admin.admins.create',compact('display_image','no_image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|string|max:255|unique:users',
            'password'=>'required',
            'role'=>'required'
        ]);
        $requestData = $request->all();
        $requestData['password']= Hash::make($requestData['password']);
        $requestData['role_id'] = 1;
        $requestData['admin_role_id'] = $request->role;
        $admin= User::create($requestData);
        //$admin->adminRoles()->attach($request->roles);
        $admin->admin()->create($requestData);

        return redirect('admin/admins')->with('flash_message', __('default.changes-saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $admin = User::findOrFail($id);
        $this->checkAdmin($admin);
        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id);

        if ($admin->picture && file_exists(DIR_MER_IMAGE . $admin->picture) && is_file(DIR_MER_IMAGE . $admin->picture)) {
            $display_image = resizeImage($admin->picture, 100, 100,$this->getBaseUrl());
        } else {
            $display_image = resizeImage('img/no_image.jpg', 100, 100,$this->getBaseUrl());
        }

        $no_image = resizeImage('img/no_image.jpg', 100, 100,$this->getBaseUrl());

        $this->checkAdmin($admin);
        return view('admin.admins.edit', compact('admin','display_image','no_image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'name'=>'required',
            'email'=>'required|email|string|max:255',
            'role'=>'required'
        ];


        $admin = User::find($id);
        if($admin->email != $request->email){
            $rules['email'] = 'required|email|string|max:255|unique:users';
        }

        $this->validate($request,$rules);
        $requestData = $request->all();

        $admin = User::findOrFail($id);

        if(!empty($requestData['password'])){
            $requestData['password']= Hash::make($requestData['password']);
        }
        else{
            $requestData['password'] = $admin->password;
        }

        $requestData['admin_role_id'] = $request->role;


        $admin->update($requestData);
       $admin->admin()->update([
           'admin_role_id'=>$request->role,
           'about'=>$request->about,
           'notify'=>$request->notify,
           'public'=>$request->public,
           'social_facebook'=>$request->social_facebook,
           'social_twitter'=>$request->social_twitter,
           'social_linkedin'=>$request->social_linkedin,
           'social_instagram'=>$request->social_instagram,
           'social_website'=>$request->social_website,
       ]);
        return redirect('admin/admins')->with('flash_message', __('default.changes-saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
         try{
             User::destroy($id);
         }
        catch (\Exception $exception){
             flashMessage(__('default.locked-message'));
             return back();
        }

        return redirect('admin/admins')->with('flash_message', __('default.record-deleted'));
    }

    private function checkAdmin(User $admin){
        if(!$admin->admin){
            $admin->admin()->create([
                'admin_role_id'=>2,
                'public'=>0
            ]);
        }
        return $admin;
    }
}
