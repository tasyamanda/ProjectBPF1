<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::latest()->paginate(10);
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengambil file foto dari request
        $foto = $request->file('foto');

        // Menyimpan foto ke dalam folder 'public/pegawai' dengan nama yang di-generate oleh hashName
        $foto->storeAs('public/storage/pegawai', $foto->hashName());

        // Membuat record baru di tabel pegawai
        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'foto' => $foto->hashName(),
            'perkerjaan' => $request->perkerjaan
        ]);

        // Memeriksa apakah pembuatan record berhasil
        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = pegawai::find($id);
        return view('pegawai.update', compact('pegawai'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
    
        if ($request->file('foto') == "") {
            $pegawai->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'perkerjaan' => $request->perkerjaan,
            ]);
        } else {
            Storage::disk('local')->delete('public/storage/pegawai/' . $pegawai->foto);
    
            $foto = $request->file('foto');
            $foto->storeAs('public/storage/pegawai', $foto->hashName());
    
            $pegawai->update([
                'nama' => $request->nama,
                'foto' => $foto->hashName(),
                'nip' => $request->nip,
                'perkerjaan' => $request->perkerjaan,
            ]);
        }
    
        if ($pegawai) {
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Diubah!']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
{
    // Menghapus foto dari storage
    $fotoPath = 'public/storage/pegawai/' . $pegawai->foto;
    if (Storage::exists($fotoPath)) {
        Storage::delete($fotoPath);
    }

    // Menghapus record dari database
    if ($pegawai->delete()) {
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    } else {
        return redirect()->route('pegawai.index')->with(['error' => 'Data Gagal Dihapus!']);
    }
}

}
