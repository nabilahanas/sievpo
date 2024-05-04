<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EvidenTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_view_page(): void
    {
        $nip = 'PHT19690905199311100';
        $password = 'Phtsmg2024';

        $response = $this->post('/ceklogin', [
            'nip' => $nip,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->get('/data/add');
        $response->assertStatus(200);
    }

    public function test_user_can_addEviden_with_valid_credentials()
    {
        $nip = 'PHT19690905199311100';
        $password = 'Phtsmg2024';

        $response = $this->post('/ceklogin', [
            'nip' => $nip,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->post('/data/store', [
            'id_user' => 5,
            'id_bidang' => 1,
            'id_shift' => 11,
            'lokasi' => 'Tembalang',
            'tgl_waktu' => '2024-01-15 05:14:28',
            'foto' => UploadedFile::fake()->image('test.png'),
        ]);
        $response->assertRedirect('/data');
    }
}
