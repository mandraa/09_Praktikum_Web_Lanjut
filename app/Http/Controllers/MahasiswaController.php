<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas; 

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     *
     */
   public function index(Request $request)
    {
        if($request->has('search')) {
            $mahasiswa = Mahasiswa::where('Nama','Like','%'.$request->search.'%')->paginate(10);
        } else {
            $mahasiswa = Mahasiswa::with('kelas')->get();
            $mahasiswa = Mahasiswa::orderBy('id', 'desc')->paginate(10);
        }

        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required',
        ]);
        $Mahasiswa = new Mahasiswa;
        $Mahasiswa->nim = $request->get('Nim');
        $Mahasiswa->nama = $request->get('Nama');
        $Mahasiswa->jurusan = $request->get('Jurusan');
        $Mahasiswa->No_Handphone = $request->get('No_Handphone');
        $Mahasiswa->Email = $request->get('Email');
        $Mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        // $Mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $Mahasiswa->kelas()->associate($kelas);
        $Mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //$Mahasiswa = Mahasiswa::find($Nim);
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();

        return view('mahasiswa.detail', ['Mahasiswa' => $Mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'kelas_id' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required',
        ]);
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $Mahasiswa->nim = $request->get('Nim');
        $Mahasiswa->nama = $request->get('Nama');
        $Mahasiswa->jurusan = $request->get('Jurusan');
        $Mahasiswa->No_Handphone = $request->get('No_Handphone');
        $Mahasiswa->Email = $request->get('Email');
        $Mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        $Mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas_id');

        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
        //Mahasiswa::find($Nim)->update($request->all());
        $Mahasiswa->kelas()->associate($kelas);
        $Mahasiswa->save();
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Dihapus');
    }
};
