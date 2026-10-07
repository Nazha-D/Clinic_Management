<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuhtTest extends TestCase
{
    use RefreshDatabase;

      protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesAndPermissionsSeeder::class);
    }
    /**
     * A basic feature test example.
     */

    public function test_user_can_register(): void
    {
        
     $data=[
        'email'=>'test@email.com',
        'name'=>'test',
        'password'=>'12345678',
        'password_confirmation'=>'12345678',
        'role'=>'receptionist'
     ];
     $response = $this->post('/api/users/register',$data);
     $this->assertDatabaseHas('users', [
    'email' => 'test@email.com',
    'name'  => 'test',
]);
     $response->assertCreated();
  
    }



     public function test_user_can_login(): void
    {
        $user = User::factory()->create([
    'email'    => 'test@email.com',
    'password' => Hash::make('12345678'),
]);
$user->assignRole('doctor');
        
     $data=[
        'email'=>'test@email.com',
        'password'=>'12345678',
     ];
     $response = $this->post('/api/users/login',$data);
   
     $response->assertOk();
     $response->assertJsonStructure([
    'success',
    'message',
    'data', 
]);
  
    }

    public function test_user_can_reset_password()
    {

      $user = User::factory()->create([
    'email'    => 'test@email.com',
    'password' => Hash::make('12345678'),
]);
$user->assignRole('doctor');
$token=$user->createToken('auth_token')->plainTextToken;
$data=[
    'old_password'=>'12345678',
    'new_password'=>'updated123',
    'new_password_confirmation' => 'updated123',
];
    $response = $this->withToken($token)
    ->putJson('/api/users/reset-password', $data);
 
    $user->refresh(); 
$this->assertTrue(Hash::check('updated123', $user->password));
      $response->assertJsonStructure([
    'success',
    'message',
    'data', 
]); 



    }
      public function test_user_can_update_his_data()
    {

      $user = User::factory()->create([
    'email'    => 'test@email.com',
    'name'     =>'test_name',
    'password' => Hash::make('12345678'),
]);
$user->assignRole('doctor');
$token=$user->createToken('auth_token')->plainTextToken;
$data=[
    'name'=>'updated_test_name',
    'email'=>'updated_test@email.com',
    
];
    $response = $this->withToken($token)
    ->putJson('/api/users/update', $data);
  $user->refresh();
$this->assertEquals('updated_test_name', $user->name);
$this->assertEquals('updated_test@email.com', $user->email);
      $response->assertJsonStructure([
    'success',
    'message',
    'data', 
]); 



    }

      public function test_user_can_log_out()
    {

      $user = User::factory()->create([
    'email'    => 'test@email.com',
    'name'     =>'test_name',
    'password' => Hash::make('12345678'),
]);
$user->assignRole('doctor');
$token=$user->createToken('auth_token')->plainTextToken;
    $response = $this->withToken($token)
    ->postJson('/api/users/log-out');
    $this->assertDatabaseCount('personal_access_tokens', 0);
    $response->assertok();
      $response->assertJsonStructure([
    'success',
    'message',
    'data', 
]); 



    }
    }
