<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use App\Models\Pengawasan;
use App\Models\Instansi;
use App\Models\Bidang;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printTemuan($id)
    {
        // Assuming you have a Pengawasan model and you want to fetch data based on $id
        $pengawasanData = Pengawasan::findOrFail($id);
        $instansiData = Instansi::first();
        // You can send the fetched data to the view
        $data = [
            'pengawasan' => $pengawasanData,
            'long_name' => $instansiData->long_name,
            'alamat' => $instansiData->alamat,
        ];

        return view('Print.temuan', $data);
    }
    
    public function printTindaklanjut($id)
    {
        // Assuming you have a Pengawasan model and you want to fetch data based on $id
        $pengawasanData = Pengawasan::findOrFail($id);
        $instansiData = Instansi::first();

        $data = [
            'pengawasan' => $pengawasanData,
            'long_name' => $instansiData->long_name,
            'alamat' => $instansiData->alamat,
        ];

        return view('Print.tindaklanjut', $data);
    }

    public function filterReport(Request $request)
    {
        // Proses filter laporan berdasarkan input tahun, triwulan, dan jenis laporan
        $year = $request->input('year');
        $quarter = $request->input('quarter');
        $reportType = $request->input('report_type');
        Carbon::setLocale('id');
        // Tentukan bulan awal dan bulan akhir berdasarkan triwulan
        $startMonth = ($quarter - 1) * 3 + 1;
        $endMonth = $quarter * 3;
    
        // Lakukan query untuk mendapatkan data pengawasan sesuai filter
        $pengawasanData = Pengawasan::whereYear('tanggal_pengawasan', $year)
            ->whereMonth('tanggal_pengawasan', '>=', $startMonth)
            ->whereMonth('tanggal_pengawasan', '<=', $endMonth)
            ->get();
    
        // Generate an array of month names in Indonesian
        $bulan = $this->getIndonesianMonths($startMonth, $endMonth);
        $latestPengawasan = $pengawasanData->last();

        if ($latestPengawasan) {
            $latestTanggalPengawasan = $latestPengawasan->tanggal_pengawasan;

            $carbonTanggal = Carbon::parse($latestTanggalPengawasan);

            // Ubah format tanggal
            $tanggalTerformat = $carbonTanggal->isoFormat('D MMMM Y', 'Do MMMM Y');
            
            $instansiData = Instansi::first();
            $bidang = Bidang::all();
            $triwulanrom = $this->convertToRoman($quarter);
        
            $data = [
                'title' => 'LHP',
                'bulan' => $bulan,
                'triwulanrom' => $triwulanrom,
                'tahun' => $year,
                'pengawasanData' => $pengawasanData,
                'bidangData' => $bidang,
                'long_name' => $instansiData->long_name,
                'logo' => $instansiData->logo,
                'alamat' => $instansiData->alamat,
                'tanggal' => $tanggalTerformat,
            ];
        
            // Menentukan view yang sesuai berdasarkan jenis laporan
            $viewName = ($reportType === 'LHP') ? 'Print.lhp' : 'Print.tlhp';
        
            // Mengirimkan data ke view yang dipilih
            return view($viewName, $data);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    
    private function getIndonesianMonths($startMonth, $endMonth)
    {

        $indonesianMonths = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $bulan = [];
        for ($i = $startMonth; $i <= $endMonth; $i++) {
            $bulan[] = mb_strtoupper($indonesianMonths[$i - 1], 'UTF-8');
        }

        return $bulan;
    }
  
    private function convertToRoman($num)
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
        ];
    
        return $romans[$num];
    }
    

    
}
