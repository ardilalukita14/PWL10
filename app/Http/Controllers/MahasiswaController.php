<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mahasiswa;
use App\Models\Kelas; 
use App\Models\MataKuliah; 
use App\Models\Mahasiswa_MataKuliah; 
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian nama
            $mahasiswas = Mahasiswa::where('Nama', 'like', "%".$request->search."%")
            ->with('kelas')->paginate(3); //yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        } else { // Pemilihan jika tidak melakukan pencarian nama
            //fungsi eloquent menampilkan data menggunakan pagination
            $mahasiswas = Mahasiswa::with('kelas')->paginate(3); // Pagination menampilkan 3 data
        }
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'image' => 'required',
            'Tanggal_Lahir' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'No_Handphone' => 'required',
            ]);

            if ($request->file('image')) 
            {
                $image_name = $request->file('image')->store('images', 'public');
            }

            $kelas = Kelas::find($request->get('kelas'));

            $Mahasiswa = new Mahasiswa;
            $Mahasiswa->Nim = $request->get('Nim');
            $Mahasiswa->Nama = $request->get('Nama');
            $Mahasiswa->image = $image_name;
            $Mahasiswa->Tanggal_Lahir = $request->get('Tanggal_Lahir');
            $Mahasiswa->Jurusan = $request->get('Jurusan');
            $Mahasiswa->Email = $request->get('Email');
            $Mahasiswa->No_Handphone = $request->get('No_Handphone');

            //fungsi eloquent untuk menambah data dengan relasi belongsTo
            $Mahasiswa->kelas()->associate($kelas);
            $Mahasiswa->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //code sebelum dibuat relasi --> $Mahasiswa = Mahasiswa::find($Nim);
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'image' => 'required',
            'Tanggal_Lahir' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'No_Handphone' => 'required',
        ]);

        $mahasiswas = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();

        // jika file image tersebut telah tersedia, maka file yang lama akan dihapus
        if ( $mahasiswas->image && file_exists(storage_path('app/public/' . $mahasiswas->image))) 
        {
            \Storage::delete(['public/' .$mahasiswas->image]);
        }
        // namun, jika file image masih belum ada, maka file baru yang diupload akan disimpan
        $image_name = $request->file('image')->store('images', 'public');
        $mahasiswas->image = $image_name;

        $mahasiswas->Nim = $request->get('Nim');
        $mahasiswas->Nama = $request->get('Nama');
        $mahasiswas->Tanggal_Lahir = $request->get('Tanggal_Lahir');
        $mahasiswas->Jurusan = $request->get('Jurusan');
        $mahasiswas->Email = $request->get('Email');
        $mahasiswas->No_Handphone = $request->get('No_Handphone');

        $kelas = Kelas::find($request->get('kelas'));

        //fungsi eloquent untuk mengupdate data dengan relasi belongsTo
        $mahasiswas->kelas()->associate($kelas);
        $mahasiswas->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas', 'matakuliah')->find($Nim);
        return view('mahasiswas.nilai', compact('Mahasiswa'));
    }

    public function cetak_khs($Nim) 
    {
        $Mahasiswa = Mahasiswa::findOrFail($Nim);
        $pdf = PDF::loadview('mahasiswas.khs_pdf',['Mahasiswa'=>$Mahasiswa]);
        return $pdf->stream();
    }
}