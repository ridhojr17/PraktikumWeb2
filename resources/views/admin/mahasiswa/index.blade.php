@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Mahasiswa</h5>
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <form action="{{route('mahasiswa.index')}}">
                        <input type="text" name="keyword" class="form-control w-50" placeholder="cari berdasarkan nama dan jurusan..." value="{{old('keyword')}}">
                            </form>
                    </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="float-end">
                    <a href="{{ route('mahasiswa.print') }}" class="btn btn-success">Cetak Data </a>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jurusan</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->jurusan}}</td>
                        <td>{{$data->npm}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{Carbon\carbon::parse($data->tanggal_lahir)->format('d-m-Y')}}</td>
                        <td>
                            <img src="{{asset('storage/mahasiswa/'.$data->foto)}}" alt="" width="60" height="60">
                        </td>
                        <td>
                            <form action="{{route('mahasiswa.delete', $data->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('mahasiswa.edit',$data->id)}}" class="btn btn-warning btn-sm">edit</a>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>

                                @csrf
                                @method('DELETE')
                                
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
@endsection