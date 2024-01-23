<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    // Method untuk menampilkan halaman konfigurasi
    public function instansi()
    {
        // Mengambil data instansi dari model
        $instansi = Instansi::first();

        // Logika untuk halaman konfigurasi
        $data = [
            'title'     => 'Config', // Judul halaman
            'subtitle'  => 'Pengaturan', // Judul halaman
            'instansi'  => $instansi, // Mengirim data instansi ke view
        ];

        return view('Konten/Config', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
            'long_name' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'wa' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'phone_number' => 'required',
            'website' => 'required',
            'description' => 'required',
        ]);

        // Update the instansi data
        $instansi = Instansi::first(); // Assuming there is only one row in the instansi table

        if ($instansi) {
            $instansi->update([
                'name' => $request->input('name'),
                'short_name' => $request->input('short_name'),
                'long_name' => $request->input('long_name'),
                'alamat' => $request->input('alamat'),
                'email' => $request->input('email'),
                'wa' => $request->input('wa'),
                'zip_code' => $request->input('zip_code'),
                'country' => $request->input('country'),
                'phone_number' => $request->input('phone_number'),
                'website' => $request->input('website'),
                'description' => $request->input('description'),
            ]);

            // Optionally, you can add a success message
            session()->flash('success', 'Instansi data updated successfully');
        } else {
            // Optionally, you can add an error message
            session()->flash('error', 'Instansi data not found');
        }

        // Redirect back to the form
        return redirect()->back();
    }

    public function updateLogo(Request $request)
    {
        // Add validation as needed
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the uploaded file
        $uploadedFile = $request->file('logo');

        // Generate a unique filename for the uploaded file
        $filename = time() . '.' . $uploadedFile->getClientOriginalExtension();

        // Move the uploaded file to the desired folder
        
        $uploadedFile->move(public_path('assets/img/profile'), $filename);

        // Update the logo in the instansi table
        $instansi = Instansi::first(); // Assuming there is only one row in the instansi table
        $instansi->logo = $filename;
        $instansi->save();

        // Optionally, you can return a response or redirect to another page
        return redirect()->back()->with('success', 'Logo updated successfully');
    }
    
    public function updateKopSurat(Request $request)
    {
        // Validasi file yang diunggah jika diperlukan
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:800',
        ]);

        // Proses penyimpanan gambar ke lokasi yang diinginkan
        $uploadedFile = $request->file('logo');
        $filename = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move(public_path('assets/img/profile'), $filename);

        // Sekarang, Anda dapat menyimpan nama file atau path ke database atau melakukan operasi lainnya

        // Contoh: Simpan nama file ke dalam database
        $instansi = Instansi::first();
        $instansi->kop_surat = $filename;
        $instansi->save();

        // Berikan respons atau redirect sesuai kebutuhan
        return redirect()->back()->with('success', 'Kop Surat updated successfully');
    }

    public function wasbid()
    {
        // Mengambil data instansi dari model
        $instansi   = Instansi::first();
        $users      = User::all();
        $bidangs    = Bidang::all();
        $hakims     = User::where('role', 2)->get();
        $penanggungJawabs    = User::whereIn('role', [3, 4])->get(); 

        // Logika untuk halaman konfigurasi
        $data = [
            'title'     => 'Config', // Judul halaman
            'subtitle'  => 'Pengawasan Bidang', // Judul halaman
            'instansi'  => $instansi, 
            'hakims'    => $hakims, 
            'users'     => $users, 
            'bidangs'   => $bidangs,  
            'penanggungJawabs'   => $penanggungJawabs,  
        ];

        return view('Konten/configWasbid', $data);
    }

    public function tambahBidang(Request $request)
    {
        try {
            // Validasi form input jika diperlukan
            $request->validate([
                'namaBidang' => 'required|string|max:255|unique:bidangs,nama',
                // Tambahkan validasi sesuai kebutuhan
            ]);

            // Buat bidang baru
            $bidang = Bidang::create([
                'nama' => $request->input('namaBidang'),
                // Tambahkan kolom lain sesuai kebutuhan
            ]);

            // Berikan respons sukses
            session()->flash('success', 'Bidang berhasil ditambahkan.');
            return back();
        } catch (\Exception $e) {
            // Berikan respons kesalahan
            session()->flash('error', 'Gagal menambahkan bidang. ' . $e->getMessage());
            return back();
        }
    }

    public function editBidang(Request $request)
    {
        try {
            // Validasi form input jika diperlukan
            $request->validate([
                'id' => 'required|exists:bidangs,id', // Validasi bahwa bidang_id ada dalam tabel bidangs
                'nama' => 'required|string|max:255', // Sesuaikan validasi dengan data yang akan diubah
            ]);

            // Ambil bidang berdasarkan bidang_id
            $bidang = Bidang::findOrFail($request->input('id'));

            // Lakukan perubahan pada data bidang
            $bidang->nama = $request->input('nama'); // Ganti ini sesuai dengan field yang ingin diubah
            $bidang->save();

            // Berikan respons sukses
            session()->flash('success', 'Data bidang berhasil diubah.');
            return back();
        } catch (\Exception $e) {
            // Berikan respons kesalahan
            session()->flash('error', 'Gagal mengubah data bidang. ' . $e->getMessage());
            return back();
        }
    }

    public function hapusBidang($id)
    {
        try {
            // Cari bidang berdasarkan ID dan hapus
            $bidang = Bidang::findOrFail($id);
            $bidang->delete();

            // Berikan respons sukses
            session()->flash('success', 'Bidang berhasil dihapus.');
            return back();
        } catch (\Exception $e) {
            // Berikan respons kesalahan
            session()->flash('error', 'Gagal menghapus bidang. ' . $e->getMessage());
            return back();
        }
    }

    public function saveConfig(Request $request)
    {
        // Logika untuk menyimpan konfigurasi
        // Ambil data dari $request->input()
        // Lakukan penyimpanan atau perubahan konfigurasi

        // Redirect atau berikan respons sesuai kebutuhan
    }
}
