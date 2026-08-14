<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeUser=$this->route('user');
       
        $id=$routeUser instanceof \App\Models\User ?  $routeUser->id:$routeUser;


        return [
            'name'=>['sometimes','string','max:255'],
        'email'=>['sometimes','email','max:255',Rule::unique('users','email')->ignore($id)],
       'current_password' => ['required_with:password', 'string', 'current_password'],
            'password'         => ['sometimes', 'string', 'min:6', 'confirmed', 'different:current_password'],
        ];
    }
}
