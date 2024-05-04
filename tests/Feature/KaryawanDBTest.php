<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KaryawanDBTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_view_form_authenticated_user(): void
    {
        $nip = '0094';
        $password = '12341234';

        $response = $this->post('/ceklogin', [
            'nip' => $nip,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/karyawan/add');
        $response->assertStatus(200);
    }

    public function test_user_can_addData_with_valid_credentials()
    {
        $nip = '0094';
        $password = '12341234';

        $response = $this->post('/ceklogin', [
            'nip' => $nip,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/karyawan/store', [
            'nama' => 'Test',
            'jabatan' => 'Mahasiswa',
        ]);
        $response->assertRedirect('/karyawan');
    }
}
