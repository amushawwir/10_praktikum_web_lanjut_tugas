@extends('mahasiswa.layout')
@section('content')
<div class="container mt-3">
        <h2 class="text-center mb-5">MAHASISWA JURUSAN TEKNOLOGI INFORMASI</h3>
        <h2 class="text-center mb-4">KARTU HASIL STUDI (KHS)</h2>

        <br><br><br>

        <div class="col-lg-12 d-flex align-item-center flex-row justify-content-between">
        <table class="mt-4">
            <thead>
                <tr>
                    <td class="text-left">
                        <p class="text-dark font-weight-bold">Nama:</p>
                    </td>
                    <td>
                        <p class="text-dark">{{ $mhs->mahasiswa->nama }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="text-left">
                        <p class="text-dark font-weight-bold">NIM:</p>
                    </td>
                    <td>
                        <p class="text-dark">{{ $mhs->mahasiswa->nim }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="text-left">
                        <p class="text-dark font-weight-bold">Kelas:</p>
                    </td>
                    <td>
                        <p class="text-dark">{{ $mhs->mahasiswa->kelas->nama_kelas }}</p>
                    </td>
                </tr>
            </thead>
        </table>
        <a style="width: 120px; height: 40px" href="{{ route('mahasiswa.cetak_nilai', $mhs->mahasiswa->nim) }}"
            class="mt-4 btn btn-success float-right">Cetak
            KHS</a>
    </div>
        <br>
        <table class="table table-bordered">
            <tr>
            <th>Matakuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
            </tr>
            @foreach ($mhs as $n)
            <tr>
            <td>{{ $n->matakuliah->nama_matkul }}</td>
            <td>{{ $n->matakuliah->sks }}</td>
            <td>{{ $n->matakuliah->semester }}</td>
            <td>{{ $n->nilai  }}</td>
            </tr>
            @endforeach
            </table>
    </div>
@endsection 