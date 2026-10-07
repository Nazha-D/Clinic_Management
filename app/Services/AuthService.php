<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

Class AuthService{
  
public function register($data)
{
    return DB::transaction(function()use($data){
    $role=Role::where('name',$data['role'])->firstOrFail();
    $user=User::create([
        'email'=>$data['email'],
        'name'=>$data['name'],
        'password'=>Hash::make($data['password']),
    ]);

    $user->assignRole($role);
    return $user;

    });

}
public function login($data)
{
   
    $user=User::where('email',$data['email'])->firstOrFail();

    if(Hash::check($data['password'],$user->password))
        {
            $user->tokens()->delete();
            return $user->createToken('auth_token')->plainTextToken;
        }
        else 
            throw ValidationException::withMessages(['password' => 'Wrong Password']);
        
}

public function logout()
{
Auth::user()->tokens()->delete();       
}

public function resetPassword($data)
{
    return DB::transaction(function()use($data){
    $user = Auth::user();
    
    if (!Hash::check($data['old_password'], $user->password)) {
        throw ValidationException::withMessages(['old_password' => 'Wrong Password']);
    }
    
    $user->update(['password' => Hash::make($data['new_password'])]);
    return $user;
      
    });
}
public function updateUser($data)
{
    return DB::transaction(function()use($data){
     $user=Auth::user();
$updates = [];

if (isset($data['name'])) {
    $updates['name'] = $data['name'];
}
if (isset($data['email'])) {
    $updates['email'] = $data['email'];
}

if (!empty($updates)) {
    $user->update($updates);
}
      return $user;
    });
}
}