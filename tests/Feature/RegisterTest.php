<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_view_regpage_authenticated_user(): void
    {
        $nip = '0094';
        $password = '12341234';

        $response = $this->post('/ceklogin', [
            'nip' => $nip,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_user_can_register_with_valid_credentials()
    {
        $nip = '0094';
        $password = '12341234';

        $response = $this->post('/ceklogin', [
            'nip' => $nip,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/registered', [
            'nama_user' => 'Test',
            'nip' => '21120120140094',
            'no_hp' => '083106413842',
            'role' => 2,
            'jabatan' => 51,
            'password' => '12341234',
        ]);
        $response->assertRedirect('/users');
    }
    
}
