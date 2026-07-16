<?php

namespace App\Http\Controllers;

use App\Models\ProgramPhoto;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    public function index()
    {
        $photos = [
            'tjkt' => ProgramPhoto::where('jurusan', 'tjkt')->latest()->get(),
            'bdp'  => ProgramPhoto::where('jurusan', 'bdp')->latest()->get(),
            'tbsm' => ProgramPhoto::where('jurusan', 'tbsm')->latest()->get(),
        ];

        return view('program_keahlian', compact('photos'));
    }

    public function showJurusan($jurusan)
    {
        $photos = ProgramPhoto::where('jurusan', $jurusan)->latest()->get();

        $titles = [
            'tjkt' => 'Teknik Komputer Jaringan dan Telekomunikasi',
            'bdp'  => 'Bisnis Daring & Pemasaran',
            'tbsm' => 'Teknik dan Bisnis Sepeda Motor',
        ];

        $views = [
            'tjkt' => 'jurusan.tjkt',
            'bdp'  => 'jurusan.bdp',
            'tbsm' => 'jurusan.tbsm',
        ];

        if (!isset($views[$jurusan])) {
            abort(404);
        }

        return view($views[$jurusan], compact('photos', 'jurusan'));
    }
}