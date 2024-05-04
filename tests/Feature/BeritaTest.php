<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class BeritaTest extends TestCase
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

        $response = $this->get('/berita/add');
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

        $response = $this->post('/berita/store', [
            'judul' => 'Test',
            'gambar' => UploadedFile::fake()->image('test.png'),
            'deskripsi' => 'Test Deskripsi',
            'tgl_publikasi' => '2024-04-30'
        ]);
        $response->assertRedirect('/berita');
    }
}
