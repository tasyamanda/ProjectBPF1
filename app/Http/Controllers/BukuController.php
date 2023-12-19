<?php

namespace App\Http\Controllers;


use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::latest()->paginate(10);
        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengambil file foto dari request
        $foto = $request->file('foto');

        // Menyimpan foto ke dalam folder 'public/buku' dengan nama yang di-generate oleh hashName
        $foto->storeAs('public/buku', $foto->hashName());

        // Membuat record baru di tabel Buku
        $buku = Buku::create([
            'nama' => $request->nama,
            'foto' => $foto->hashName(),
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
        ]);

        // Memeriksa apakah pembuatan record berhasil
        if ($buku) {
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('buku.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data buku berdasarkan ID
        $buku = Buku::find($id);

        // Memeriksa apakah data buku ditemukan
        if (!$buku) {
            return redirect()->route('buku.index')->with(['error' => 'Data Buku tidak ditemukan!']);
        }

        // Menampilkan view untuk edit dengan membawa data buku
        return view('buku.update', compact('buku'));
    }

    // Fungsi untuk memproses update data
    public function update(Request $request, $id)
    {
        // Mengambil data buku berdasarkan ID
        $buku = Buku::find($id);

        // Memeriksa apakah data buku ditemukan
        if (!$buku) {
            return redirect()->route('buku.index')->with(['error' => 'Data Buku tidak ditemukan!']);
        }

        // Mengambil file foto dari request
        $foto = $request->file('foto');

        // Memeriksa apakah ada file foto yang diunggah
        if ($foto) {
            // Menghapus file foto lama dari penyimpanan
            Storage::delete('public/buku/' . $buku->foto);

            // Menyimpan foto baru ke dalam folder 'public/buku' dengan nama yang di-generate oleh hashName
            $foto->storeAs('public/buku', $foto->hashName());

            // Mengganti nama file foto dalam model buku dengan nama yang baru
            $buku->foto = $foto->hashName();
        }

        // Mengupdate data buku dengan data baru
        $buku->update([
            'nama' => $request->nama,
            'penerbit' => $request->penerbit,
            'pengarang' => $request->pengarang,
        ]);

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('buku.index')->with(['success' => 'Data Buku berhasil diupdate!']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mengambil data buku berdasarkan ID
        $buku = Buku::find($id);

        // Memeriksa apakah data buku ditemukan
        if (!$buku) {
            return redirect()->route('buku.index')->with(['error' => 'Data Buku tidak ditemukan!']);
        }

        // Menghapus file foto dari penyimpanan
        Storage::delete('public/buku/' . $buku->foto);

        // Menghapus data buku dari database
        $buku->delete();

        // Mengembalikan redirect dengan pesan sukses
        return redirect()->route('buku.index')->with(['success' => 'Data Buku berhasil dihapus!']);
    }
}
