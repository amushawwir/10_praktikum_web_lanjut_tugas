<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Mahasiswa_Matakuliah;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('nim', 'asc')->paginate(3);
        return view('mahasiswa.index',['mahasiswa'=>$mahasiswa,'paginate'=>$paginate]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create',['kelas' => $kelas]);
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_Lahir'=> 'required',
        ]);
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->kelas_id = $request->get("Kelas");
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_Lahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //fungsi eloquent untuk menambah data
        //Mahasiswa::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
        return view('mahasiswa.detail', ['Mahasiswa' => $mahasiswa]);
    }
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();;
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_Lahir'=> 'required',
        ]);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->kelas_id = $request->get("Kelas");
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_Lahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');
        
        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //fungsi eloquent untuk mengupdate data inputan kita
        //Mahasiswa::find($Nim)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function cari(Request $request)
    {
        //Menangkap data pencarian
        $cari = $request->cari;

        //Mengambil data dari tabel mahasiswa sesuai dengan pencarian Nama
        $mahasiswa = DB::table('mahasiswa')
        ->where('nama', 'like', "%" . $cari . "%")
        ->paginate(3);

        //Mengirim data mahasiswa ke view index
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa]);
    }

    public function nilai($id_mahasiswa)
    {
        // Join relasi ke mahasiswa dan mata kuliah
        $mhs = Mahasiswa_MataKuliah::with('matakuliah')->where("mahasiswa_id", $id_mahasiswa)->get();
        $mhs->mahasiswa = Mahasiswa::with('kelas')->where("nim", $id_mahasiswa)->first();
        //dd($mhs[0]);
        // Menampilkan nilai
        return view('mahasiswa.nilai', compact('mhs'));
    }
}