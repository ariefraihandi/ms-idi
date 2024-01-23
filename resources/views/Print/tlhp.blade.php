<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title}}</title>
          <style>
    @page {
      margin-top: 2.54cm;
      margin-left: 2.23cm;
      margin-bottom: 2cm;
      margin-right: 2.23cm;
    }

    body {
      font-family: Arial, sans-serif;
      font-size: 12pt;
      text-align: left;
    }

    h1, h2 {
      text-align: center;
      font-family: Arial, sans-serif;
      font-size: 12pt;
    }

    p {
      text-align: justify;
      text-indent: 2.9em;
    }

    h5 {
      text-align: justify;
      font-size: 12pt;
      text-indent: 2.9em;
    }

    .subtitle {
      text-align: justify;
      text-indent: 1.6em;
    }
    
    .subsubtitle {
      text-align: justify;
      text-indent: 2.9em;
    }
    
    .subsubsubtitle {
      text-align: justify;
      text-indent: 3.9em;
    }

    .subsubsu {
      text-align: justify;
      padding-left: 6em;
      text-indent: -2.5em;
    }

    ol {
      text-align: justify;
      padding-left: 45px; 
    }

    .page-break {
      page-break-after: always;
    }

    table {
      border-collapse: collapse;
      width: 600px;
      margin-left: 65px;
    }

    table th,
    table td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      text-align: center;
      padding: 0.5cm;
      font-size: 10pt;
      background-color: #f0f0f0;
      border-top: 1px solid #ccc;
    }

 
  </style>
        
    </head>
      
    <body>
    <div>
        <br>
        <br>
        <br>
        <h1>LAPORAN</h1>
        <h1>TINDAK LANJUT PENGAWASAN BIDANG</h1>
        <h1>{{ strtoupper($long_name) }}</h1>
        <h1>BULAN <?= $monthString = implode(', ', $bulan); ?> (TRIWULAN <?=$triwulanrom;?>) TAHUN <?=$tahun;?></h1>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div style="display: flex; justify-content: center;">
          <img src="{{ asset('assets') }}/img/profile/{{$logo}}" alt="Image" style="max-width: 100%; height: auto;">
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1>HAWASBID</h1>
        <h1>{{ strtoupper($long_name) }}</h1>

        <h1>TAHUN <?=$tahun;?></h1>
    </div>
     <div class="page-break"></div>
    <div>
        <h1>BAB I</h1>
        <h2>PENDAHULUAN</h2>
        <p class="subtitle"><strong>A. PENDAHULUAN</strong></p>
        <p>Pembinaan dan Pengawasan merupakan salah satu fungsi pokok manajemen untuk menjaga dan mengendalikan agar tugas-tugas yang harus dilaksanakan dapat berjalan sebagaimana mestinya sesuai dengan program kerja, standar operasional prosedur (SOP), dan aturan yang berlaku. Oleh karenanya, pembinaan dan pengawasan dari lembaga yang lebih tinggi kepada lembaga bawahannya adalah merupakan suatu keharusan dalam sebuah organisasi/lembaga. Salah satu tujuannya adalah untuk melihat sejauh mana dinamika implementasi, visi dan misi serta pelaksanaan tugas pokok dan fungsi lembaga tersebut.</p>
        <p>Dalam rangka memenuhi maksud tersebut {{$long_name}} mempunyai tugas untuk melaksanakan pengawasan terhadap penyelenggaraan tugas pokok peradilan dan juga pembinaan terhadap tingkah laku dan perbuatan aparat peradilan di satuan kerja {{$long_name}} secara terus menerus dan berkesinambungan.</p>
        <p>Bahwa agar pembinaan dan pengawasan berjalan efektif dan berdayaguna, maka {{$long_name}} telah membentuk Tim Hawasbid yang akan melaksanakan pemeriksaan di {{$long_name}} untuk tahun <?=$tahun;?>.</p>
        <p class="subtitle"><strong>B. DASAR PELAKSANAAN</strong></p>
        <ol>
            <li>Undang-Undang No. 3 Tahun 2009 Tentang Mahkamah Agung.</li>
            <li>Undang-Undang No. 48 Tahun 2009 Tentang Kekuasaan Kehakiman.</li>
            <li>Undang-Undang No. 50 Tahun 2009 Tentang Perubahan Kedua Atas Undang-Undang No. 7 Tahun 1989 Tentang Peradilan Agama.</li>
            <li>Undang-Undang No. 37 Tahun 2008 Tentang Ombudsman.</li>
            <li>Peraturan Presiden No. 19 Tahun 2008 Tentang Tunjangan Khusus Kinerja Hakim Dan Pegawai Negeri di Lingkungan Mahkamah Agung dan Badan Peradilan dibawahnya.</li>
            <li>Keputusan Ketua Mahkamah Agung RI. No. KMA/080/SK/VIII/2006 Tentang Pedoman Pelaksanaan Pengawasan di Lembaga Peradilan.</li>
            <li>Keputusan Bersama antara Mahkamah Agung dengan Komisi Yudisial No. 047/KMA/SKB/IV/2009 dan No. 02/SKB/O.KY/IV/2009 Tentang Kode Etik dan Pedoman Perilaku Hakim.</li>
            <li>Keputusan Ketua Mahkamah Agung RI. No. 145/KMA/SK/VIII/2007 Tentang Pemberlakuan Buku IV, Pedoman Pelaksanaan Pengawasan di lingkungan Badan-Badan Peradilan.</li>
            <li>Keputusan Ketua Mahkamah Agung No. 070/KMA/SK/V/2008 Tentang Tunjangan Khusus Kinerja Pegawai Negeri di Lingkungan Mahkamah Agung dan Badan Peradilan yang berada di bawahnya.</li>
            <li>Keputusan Ketua Mahkamah Agung No. 076/KMA/SK/VI/2009 Tentang Pedoman Pelaksanaan Penanganan Pengaduan di lingkungan Peradilan.</li>
            <li>Surat Keputusan Ketua {{$long_name}} Nomor : W1-A21/107/PS.01/01/2022 tanggal 3 Januari 2022 tentang Penunjukan Hakim Pengawas Bidang pada {{$long_name}} 2022 ;</li>
            <li>Surat Keputusan Ketua {{$long_name}} Nomor : W1-A21/..../PS.01/06/2022 tanggal  Juni 2022 tentang Perubahan SK Penunjukan Hakim Pengawas Bidang pada {{$long_name}} 2022 ;</li>
            <li>Surat Tugas Koordinator Hakim Pengawas Bidang {{$long_name}} Nomor : W1-A21/..../PS.01/06/2022 tanggal  Juni 2022.</li>
        </ol>
       <p class="subtitle"><strong>C. OBJEK DAN RUANG LINGKUP</strong></p>
        <ol>
            <li>Manajemen Peradilan: Merupakan tugas dan kegiatan yang berkaitan dengan pengelolaan dan pengaturan berbagai aspek dalam sistem peradilan, termasuk pengaturan organisasi, penanganan perkara, penjadwalan sidang, manajemen sumber daya, dan peningkatan efisiensi serta efektivitas proses peradilan;</li>
            <li>Administrasi Perkara: Meliputi proses administratif dalam penanganan perkara di sistem peradilan, seperti penerimaan berkas perkara, pencatatan data, pengarsipan, penomoran, dan pengelolaan informasi terkait perkara. Tujuan dari administrasi perkara adalah untuk memastikan kelancaran dan keberlanjutan proses peradilan;</li>
            <li>Administrasi Persidangan: Merupakan kegiatan administratif yang berkaitan dengan penyelenggaraan persidangan di pengadilan. Hal ini meliputi penjadwalan sidang, persiapan ruang sidang, koordinasi dengan pihak terkait (hakim, jaksa, pengacara, saksi), pengelolaan bukti, dan penyediaan dokumentasi persidangan;</li>
            <li>Pelayanan Publik: Merupakan rangkaian kegiatan yang dilakukan oleh lembaga peradilan untuk memberikan pelayanan yang berkualitas kepada masyarakat. Pelayanan publik dalam konteks peradilan mencakup penyediaan informasi, bantuan hukum, penyelesaian sengketa secara adil, cepat, dan transparan, serta upaya untuk memenuhi kebutuhan dan harapan masyarakat terhadap sistem peradilan;</li>
            <li>Administrasi Umum: Merupakan tugas dan kegiatan administratif yang meliputi berbagai aspek dalam pengelolaan lembaga peradilan secara keseluruhan. Administrasi umum mencakup bidang kepegawaian (manajemen pegawai, rekrutmen, dan pengembangan sumber daya manusia), organisasi dan tatalaksana (pengaturan struktur organisasi, pembagian tugas, dan koordinasi), keuangan (pengelolaan anggaran dan keuangan lembaga), perencanaan (pengembangan program dan kegiatan), teknologi informasi (pengelolaan sistem informasi dan teknologi), pelaporan, serta pengaduan masyarakat dan pelayanan publik;</li>
        </ol>
        <p class="subtitle"><strong>D. METODE PENGAWASAN</strong></p>
        <ol>
            <li>Telusur dokumen: Merupakan proses penelusuran, pengumpulan, dan analisis dokumen yang relevan dalam suatu konteks tertentu. Biasanya dilakukan dalam rangka memperoleh informasi atau bukti yang diperlukan untuk keperluan investigasi, penelitian, atau penyelesaian masalah. Telusur dokumen melibatkan pencarian dan penelaahan dokumen secara sistematis guna memahami isinya, mengidentifikasi pola atau kecenderungan, dan memperoleh pemahaman yang lebih mendalam terhadap suatu topik atau peristiwa;</li>
            <li>Pengawasan langsung: Merupakan kegiatan pengawasan yang dilakukan secara langsung oleh seorang individu atau tim terhadap aktivitas, proses, atau orang lain. Pengawasan langsung dilakukan dengan mengamati, memantau, dan mengevaluasi secara langsung kegiatan yang sedang berlangsung. Tujuannya adalah untuk memastikan bahwa kegiatan tersebut sesuai dengan standar, peraturan, atau prosedur yang berlaku, serta untuk mendeteksi dan mencegah terjadinya kesalahan, penyalahgunaan, atau pelanggaran;</li>
            <li>Wawancara: Merupakan metode komunikasi yang melibatkan interaksi antara pewawancara dan responden. Wawancara biasanya dilakukan untuk tujuan pengumpulan informasi, evaluasi, atau pemahaman yang lebih mendalam tentang suatu topik atau masalah. Dalam wawancara, pewawancara mengajukan pertanyaan kepada responden dan mendengarkan jawaban serta tanggapan mereka. Wawancara dapat dilakukan secara terstruktur dengan pertanyaan yang telah disusun sebelumnya, maupun secara tidak terstruktur yang memungkinkan respons yang lebih bebas dan spontan. Tujuan dari wawancara adalah untuk memperoleh data kualitatif, pemahaman konteks, persepsi, dan pengalaman yang relevan dari responden.</li>
        </ol>
    </div>
    <div class="page-break"></div>
    <div>
        <h1>BAB II</h1>
        <h2>HASIL PEMBINAAN DAN PENGAWASAN</h2>
        @foreach ($bidangData as $index => $bidang)
            <p class="subtitle"><strong>{{ chr(65 + $index) }}. {{ $bidang->nama }}</strong></p>
            @php
                // Saring data pengawasan berdasarkan ID bidang
                $pengawasanBidang = $pengawasanData->where('bidang', $bidang->id);
            @endphp

            @if ($pengawasanBidang->isEmpty())
                <p>Tidak ditemukan temuan</p>
            @else
                @foreach ($pengawasanBidang as $pengawasan)
                    <table>
                        <tr>
                            <h5><strong>{{ $loop->iteration }}. {{ $pengawasan->subbidang }}</strong></h5>
                        </tr>
                        <tr>
                            <th style="width: 20%;">Kondisi:</th>
                            <td style="width: 80%;" colspan="2">{{ $pengawasan->kondisi }}</td>                           
                        </tr>
                            
                        <tr>
                            <th style="width: 20%;">Kriteria:</th>
                            <td style="width: 80%;" colspan="2">{{ $pengawasan->kriteria }}</td>
                        
                        </tr>
                        
                        <tr>
                            <th style="width: 20%;">Sebab:</th>
                            <td style="width: 80%;" colspan="2">{{ $pengawasan->sebab }}</td>
                     
                        </tr>
                        
                        <tr>
                            <th style="width: 20%;">Akibat:</th>
                            <td style="width: 80%;" colspan="2">{{ $pengawasan->akibat }}</td>
                            
                        </tr>
                        
                        <tr>
                            <th style="width: 20%;">Rekomendasi:</th>
                            <td style="width: 80%;" colspan="2">{{ $pengawasan->rekomendasi }}</td>
                         
                        </tr>
                        <tr>
                            <th style="width: 20%;">Tinda Lanjut:</th>
                            <td style="width: 80%;" colspan="2">{{ $pengawasan->kondisiafter}}</td>
                        </tr>
                        
                        <tr>
                            <th style="width: 20%;">Eviden:</th>
                            <td style="width: 40%;">Sebelum:<br><img src="{{ asset('eviden/' . $pengawasan->eviden) }}" alt="Eviden Image" width="150"></td>
                            <td style="width: 40%;">Sesudah:<br><img src="{{ asset('eviden/' . $pengawasan->evidenafter) }}" alt="Eviden Image" width="150"></td>
                        </tr>
                    </table>
                    <br>
                @endforeach
            @endif
        @endforeach

    </div>
    
    <div class="page-break"></div>
    <div>
        <h1>BAB III</h1>
        <h2>PENUTUP</h2>
        <p class="subtitle"><strong>A. Kesimpulan</strong></p>
        <p>Bahwa pelaksanaan tugas pokok dan fungsi, wewenang dan tanggung jawab {{$long_name}} sudah berjalan, namun masih perlu disempurnakan dan penanganan yang lebih serius untuk seluruh aspek kegiatan pelayanan dari Mahkamah Syar’iyah kepada Masyarakat;</p>
        <p class="subtitle"><strong>B. Saran</strong></p>
        <p>Perlu ditingkatkan pelaksanaan pengawasan internal baik yang dilakukan oleh atasan langsung dan hakim pengawas bidang, sehingga kekurangan dan kesalahan dalam pelaksanaan tugas pokok dan fungsi dapat terpantau dan dapat segera diperbaiki.</p>
        <p>Demikian Laporan Hasil Pemeriksaan dalam rangka Pengawasan ini dibuat dan ditanda tangani oleh hakim Pengawas Bidang {{$long_name}}.</p>
        <table>
            <tr>
                <td style="width: 30%; border: none;"></td>
                <td style="width: 25%; border: none;"></td>
                <td style="width: 45%; border: none;">
                    {{$alamat}}, {{$tanggal}}<br>
                    KOORDINATOR HAWASBID<br><br><br><br><br>
                    (..............)
                </td>
            </tr>
        </table>  
    </div>
    
   
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
    
</body>


</html>
