<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mahasiswaw;

class MahasiswaController extends Controller
{
    //halaman data mahasiswa
    public function index(Request $request)
    {
        $request->flash();
        $mahasiswa = mahasiswaw::query();

        if(isset($request->keyword))
        {
             $mahasiswa = $mahasiswa->where('nama','LIKE',"%{$request->keyword}%")
                    ->orWhere('npm','LIKE',"%{$request->keyword}%")
                    ->orWhere('jurusan','LIKE',"%{$request->keyword}%");
        }
        $mahasiswa = $mahasiswa->get();

        return view('admin.mahasiswa.index',compact('mahasiswa'));
    }

    //halaman tambah mahasiswa
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    //halaman simpan data  mahasiswa
    public function store(Request $request)
    { 
        $input = $request->all();
        //proses upload foto
        if($request->foto)
        {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa',$input['foto']);
        }
        //proses simpan data
         Mahasiswaw::create($input);
        return redirect()->route('mahasiswa.index');
    }

    //halaman edit mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswaw::findOrFail($id);
        return view('admin.mahasiswa.edit',compact('mahasiswa'));
    }

    //fungsi update data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswaw::findOrFail($id);
        $input = $request->all();
        //proses upload foto
        if($request->foto)
        {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa',$input['foto']);
        }
        //proses simpan data
         $mahasiswa->update($input);
        return redirect()->route('mahasiswa.index');
    }

    //fungsi hapus data mahasiswa
    public function delete($id)
    {   
        $mahasiswa = mahasiswaw::find($id);
        $mahasiswa -> delete();
        return redirect()->route('mahasiswa.index');
    }

    public function print()
    {
        $mahasiswa = Mahasiswaw::all();
        return view('admin.mahasiswa.print',compact('mahasiswa'));
    }
}
