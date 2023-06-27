@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="my-3 col-12 col-sm-7 col-md-5">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search">
                        <button class="input-group-text btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="float-right my-2">
                <a class="btn btnsuccess" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>Email</th>
            <th>Tanggal_Lahir</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($mahasiswa as $Mahasiswa)
            <tr>

                <td>{{ $Mahasiswa->Nim }}</td>
                <td>{{ $Mahasiswa->Nama }}</td>
                <td>{{ optional($Mahasiswa->kelas)->nama_kelas }}</td>
                <td>{{ $Mahasiswa->Jurusan }}</td>
                <td>{{ $Mahasiswa->No_Handphone }}</td>
                <td>{{ $Mahasiswa->Email}}</td>
                <td>{{ $Mahasiswa->Tanggal_Lahir }}</td>
                <td>
                    <form action="{{ route('mahasiswa.destroy', $Mahasiswa->Nim) }}" method="POST">

                        

                        <a class="btn btninfo" href="{{ route('mahasiswa.show', $Mahasiswa->Nim) }}">Show</a>
                        <a class="btn btnprimary" href="{{ route('mahasiswa.edit', $Mahasiswa->Nim) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </table>
@endsection
