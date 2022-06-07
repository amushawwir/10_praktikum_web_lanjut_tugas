@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="mt-5">
                <h1 class="text-center">Kartu HASIL STUDI (KHS)</h2>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="d-flex flex-row justify-content-between">
        <table class="mt-5 mr-auto" border="0" align="left">
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
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mhs as $khs)
                <tr>
                    <td>{{ $khs->mataKuliah->nama_matkul }}</td>
                    <td>{{ $khs->mataKuliah->sks }}</td>
                    <td>{{ $khs->mataKuliah->semester }}</td>
                    <td>{{ $khs->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection