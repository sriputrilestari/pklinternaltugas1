<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
   
    
        private $arr = [

            ['id'=>1,'nama'=>'faza','kelas'=>'xii rpl 1'],
            ['id'=>2,'nama'=>'uned','kelas'=>'xii rpl 2'],
            ['id'=>3,'nama'=>'cemen','kelas'=>'xii rpl 3'],
        ];

        public function index ()
    {    
        $siswa = session('siswa_data', $this->arr);
        return view('siswa.siswa', ['siswa'=>$siswa]);
    }

    public function show($id){
        $data = session('siswa_data', $this->arr);
        $siswa = collect($data)->firstWhere('id',$id);
        //
        //jika data tidak ada
        if(! $siswa) {
            abort(404);
        }
        //dd($siswa); untuk cek data
        return view('siswa.show',['siswa' => $siswa]);
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request) 
    {
        $siswa = session('siswa_data',$this->arr);

        //
        $newId = collect($siswa)->max('id') + 1;

        //
        $siswa[] = [
            'id'=>$newId,
            'kelas'=>$request->kelas,
            'nama'=>$request->nama,
        ];

        //
        session(['siswa_data'=>$siswa]);

        //
        return redirect('/siswa');
    }

    public function edit($id){
        //ambil data dari file session
        $data = session('siswa_data', $this->arr);

        //cari data berdasarkan id
        $siswa = collect($this->arr)->firstWhere('id',$id);

        //jika data tidak ada
        if(! $siswa) {
            abort(404);
        }
        //dd($siswa); untuk cek data
        return view('siswa.edit',compact('siswa'));
    }

    public function update(Request $request,$id){
        //ambil data dari file session siswa_data
        $data = session('siswa_data', $this->arr);

         //cari data siswa berdasarkan id
         foreach($data as &$item) {
            if($item['id'] == $id) {
                //mengubah isi data nama dan kelas
                $item['nama'] = $request->nama;
                $item['kelas'] = $request->kelas;
                break;
            }
         }
         //mengembalikan nilai ke session melalui variable data 
         session(['siswa_data' => $data]);
         return redirect('siswa');
    }  
    
    public function destroy($id)
    {
        $siswa = session('siswa_data', $this->arr);
        //mencari array yg sama dari column id
        $index = array_search($id, array_column($siswa, 'id'));

        //hapus data berdasarkan id dari index array 
        array_splice($siswa, $index, 1);

        session(['siswa_data' => $siswa]);

        return redirect('siswa');
    }
}