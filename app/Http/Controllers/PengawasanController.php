<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Pengawasan;
use App\Models\Instansi; 
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PengawasanController extends Controller
{
    public function index($triwulan = null, $year = null)
    {
        // Cek jika triwulan atau tahun kosong, maka gunakan nilai saat ini
        $triwulan       = $triwulan ?? ceil(date('n') / 3);
        $year           = $year ?? date('Y');
        $bidangs        = Bidang::all();
        $instansi       = Instansi::first();
        $hakims         = User::where('role', 2)->get();
        $pengawas       = User::where('role', 3)->orWhere('role', 4)->get();
        $today          = Carbon::now()->format('Y-m-d');
        $pengawasans    = Pengawasan::all();
 
        $startMonth = ($triwulan - 1) * 3 + 1;
        $endMonth = $startMonth + 2;
    
        // Query untuk mengambil data pengawasan berdasarkan rentang waktu
        $pengawasanData = Pengawasan::whereYear('tanggal_pengawasan', $year)
            ->whereMonth('tanggal_pengawasan', '>=', $startMonth)
            ->whereMonth('tanggal_pengawasan', '<=', $endMonth)
            ->get();

        $jumlahPengawasan = Pengawasan::whereYear('tanggal_pengawasan', $year)
            ->whereMonth('tanggal_pengawasan', '>=', $startMonth)
            ->whereMonth('tanggal_pengawasan', '<=', $endMonth)
            ->count();
        
            $jumlahTindakLanjut = Pengawasan::whereYear('tanggal_pengawasan', $year)
            ->whereMonth('tanggal_pengawasan', '>=', $startMonth)
            ->whereMonth('tanggal_pengawasan', '<=', $endMonth)
            ->whereNotNull('kondisiafter')
            ->whereNotNull('evidenafter')
            ->count();
            
   
        $data = [
            'title'             => 'Wasbid',
            'subtitle'          => 'Pengawasan Bidang',
            'triwulan'          => $triwulan,
            'year'              => $year,
            'bidangs'           => $bidangs, 
            'hakims'            => $hakims, 
            'pengawas'          => $pengawas, 
            'today'             => $today, 
            'pengawasanData'    => $pengawasanData,
            'jumlahPengawasan'  => $jumlahPengawasan,
            'jumlahTL'          => $jumlahTindakLanjut,
            'pengawasans'       => $pengawasans,
            'instansi'          => $instansi,         
        ];

        return view('Konten/Pengawasan', $data);
    }

    public function tambahPengawasan(Request $request)
    {
        try {
            // Validasi data yang diterima dari formulir
            $request->validate([
                'tanggal_pengawasan' => 'required|date',
                'bidang' => 'required|exists:bidangs,id',
                'subbidang' => 'required|string',
                'tajuk' => 'required|string',
                'kondisi' => 'required|string',
                'kriteria' => 'required|string',
                'sebab' => 'required|string',
                'akibat' => 'required|string',
                'rekomendasi' => 'required|string',
                'pengawas' => 'required|exists:users,id',
                'penanggung_jawab' => 'required|exists:users,id',
                'eviden' => 'required|file|mimes:jpeg,png,jpg,gif,svg,heic|max:2048',
            ]);

            // Menyimpan data pengawasan ke dalam database
            $pengawasan = new Pengawasan();
            $pengawasan->tanggal_pengawasan = $request->input('tanggal_pengawasan');
            $pengawasan->bidang = $request->input('bidang');
            $pengawasan->subbidang = $request->input('subbidang');
            $pengawasan->tajuk = $request->input('tajuk');
            $pengawasan->kondisi = $request->input('kondisi');
            $pengawasan->kriteria = $request->input('kriteria');
            $pengawasan->sebab = $request->input('sebab');
            $pengawasan->akibat = $request->input('akibat');
            $pengawasan->rekomendasi = $request->input('rekomendasi');
            $pengawasan->pengawas = $request->input('pengawas');
            $pengawasan->penanggung_jawab = $request->input('penanggung_jawab');

            // Menyimpan file eviden
            if ($request->hasFile('eviden')) {
                $eviden = $request->file('eviden');
                $fileName = time() . '_' . $eviden->getClientOriginalName();
                $eviden->move(public_path('eviden'), $fileName);
                $pengawasan->eviden = $fileName;
            }

            // Simpan data pengawasan
            $pengawasan->save();

            // Redirect atau berikan respons sesuai kebutuhan
            session()->flash('success', 'Pengawasan berhasil ditambahkan.');
            return back();
        } catch (\Exception $e) {
            // Tangani kesalahan, misalnya dengan menampilkan pesan kesalahan
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return back();
        }
    }

    public function editPengawasan(Request $request)
    {
        // Validasi form edit sesuai kebutuhan Anda
        $request->validate([
            'tanggal_pengawasan' => 'required|date',
            'bidang' => 'required',
            'subbidang' => 'required',
            'tajuk' => 'required',
            'kondisi' => 'required',
            'kriteria' => 'required',
            'sebab' => 'required',
            'akibat' => 'required',
            'rekomendasi' => 'required',
            'pengawas' => 'required',
            'penanggung_jawab' => 'required',
            'eviden' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Menggunakan Eloquent untuk menemukan dan memperbarui data pengawasan
        $pengawasan = Pengawasan::findOrFail($request->id);
    
        // Update atribut data pengawasan
        $pengawasan->tanggal_pengawasan = $request->input('tanggal_pengawasan');
        $pengawasan->bidang = $request->input('bidang');
        $pengawasan->subbidang = $request->input('subbidang');
        $pengawasan->tajuk = $request->input('tajuk');
        $pengawasan->kondisi = $request->input('kondisi');
        $pengawasan->kriteria = $request->input('kriteria');
        $pengawasan->sebab = $request->input('sebab');
        $pengawasan->akibat = $request->input('akibat');
        $pengawasan->rekomendasi = $request->input('rekomendasi');
        $pengawasan->pengawas = $request->input('pengawas');
        $pengawasan->penanggung_jawab = $request->input('penanggung_jawab');
    
        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('eviden')) {
            // Hapus gambar lama jika ada
            if ($pengawasan->eviden) {
                Storage::delete('path_to_old_image/' . $pengawasan->eviden);
            }
    
            // Upload gambar baru
            $evidenFileName = time() . '.' . $request->file('eviden')->getClientOriginalExtension();
            $request->file('eviden')->storeAs('path_to_store_image', $evidenFileName);
    
            // Simpan nama gambar baru ke dalam atribut 'eviden'
            $pengawasan->eviden = $evidenFileName;
        }
    
        // Simpan perubahan
        $pengawasan->save();
    
        $successMessage = 'Temuan Berhasil Diperbaharui';
        session()->flash('success', $successMessage);
    
        // Check if 'year' and 'triwulan' exist in the request
        if ($request->has(['year', 'triwulan'])) {
            return redirect()->route('index.page', [
                'triwulan' => $request->input('triwulan'),
                'year' => $request->input('year'),
            ])->with('success', $successMessage);
        } else {
            return redirect()->route('index.page')->with('success', $successMessage);
        }
    }

    public function deletewas($id)
    {
        try {
            // Lakukan operasi penghapusan berdasarkan $id
            $pengawasan = Pengawasan::findOrFail($id);

            // Hapus gambar eviden jika ada
            $this->deleteFileIfExists($pengawasan->eviden);
            $this->deleteFileIfExists($pengawasan->evidenafter);

            // Hapus data dari database
            $pengawasan->delete();

            // Jika berhasil dihapus, bisa juga menambahkan pesan sukses atau redirect ke halaman tertentu
            // return redirect()->route('your.route.name')->with('success', 'Data berhasil dihapus');
            session()->flash('success', 'Data berhasil dihapus');
            return back();       
        } catch (\Exception $e) {
            // Tangani kesalahan, bisa menampilkan pesan error atau melakukan hal lain sesuai kebutuhan
            session()->flash('error', 'Pengawasan Gagal');
            return back();         
        }
    }
    
    private function deleteFileIfExists($filename)
    {
        if ($filename && File::exists(public_path('eviden/' . $filename))) {
            File::delete(public_path('eviden/' . $filename));
        }
    }

    public function tindaklanjut(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'kondisiafter' => 'required',
            'evidenafter' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id' => 'required|exists:pengawasan,id',
        ]);

        // Simpan data tindak lanjut
        $pengawasan = Pengawasan::find($request->id);
        $pengawasan->kondisiafter = $request->kondisiafter;

        // Ambil nama file eviden
        $evidenFile = $request->file('evidenafter');
        $evidenFileName = time() . '_' . $evidenFile->getClientOriginalName();

        // Simpan hanya nama file eviden
        $pengawasan->evidenafter = $evidenFileName;

        // Pindahkan file ke direktori yang diinginkan
        $evidenFile->move(public_path('eviden'), $evidenFileName);

        $pengawasan->save();

        session()->flash('success', 'Temuan Berhasil Ditindaklanjuti');
        return back();
    }



    public function lihatdata(Request $request)
    {
        // Validasi input form
        $request->validate([
            'triwulan' => 'required|numeric|between:1,4',
            'tahun' => 'required|numeric',
        ]);

        // Ambil data input dari form
        $triwulan = $request->input('triwulan');
        $tahun = $request->input('tahun');
        session()->flash('success', 'Data berhasil ditampilkan.');
        return redirect()->route('index.page', ['triwulan' => $triwulan, 'year' => $tahun]);
    }
}
