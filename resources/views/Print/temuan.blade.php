<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="Generator" content="Microsoft Word 15 (filtered)">
    <title>Temuan Administrasi Umum</title>
    <style>
        <!--
        /* Font Definitions */
        @font-face {
            font-family: "Cambria Math";
            panose-1: 2 4 5 3 5 4 6 3 2 4;
        }

        /* Style Definitions */
        p.MsoNormal,
        li.MsoNormal,
        div.MsoNormal {
            margin: 0in;
            text-autospace: none;
            font-size: 11.0pt;
            font-family: "Times New Roman", serif;
        }

        p.MsoTitle,
        li.MsoTitle,
        div.MsoTitle {
            margin-top: 12.7pt;
            margin-right: 103.1pt;
            margin-bottom: 0in;
            margin-left: 109.45pt;
            text-align: center;
            text-autospace: none;
            font-size: 12.0pt;
            font-family: "Times New Roman", serif;
            font-weight: bold;
            text-decoration: underline;
        }

        p.MsoBodyText,
        li.MsoBodyText,
        div.MsoBodyText {
            margin: 0in;
            text-autospace: none;
            font-size: 12.0pt;
            font-family: "Times New Roman", serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: none; /* Remove borders */
        }

        th {
            width: 40%; /* Adjust width as needed */
        }

        td.colon {
            width: 5%; /* Adjust width as needed */
            text-align: center;
        }

        .MsoChpDefault {
            font-family: "Calibri", sans-serif;
        }

        .MsoPapDefault {
            text-autospace: none;
        }

        /* @page WordSection1 {
            size: 595.5pt 842.0pt;
            margin: 12.0pt 29.0pt 0in 27.0pt;
        }

        div.WordSection1 {
            page: WordSection1;
        } */
        -->
    </style>
</head>

<body lang="EN-US" style="word-wrap: break-word">

    <div class="WordSection1">

        <p class="MsoBodyText" style="margin-left: 5.35pt"><span lang="ms" style="font-size: 10.0pt"><img width="699"
                    height="149" id="image1.jpeg" src="{{ asset('assets') }}/img/profile/kop-surat.png"></span></p>

        <p class="MsoTitle"><span lang="ms">EVIDEN TEMUAN PENGAWASAN BIDANG</span></p>
        <table>
            <tr>
                <th>Hakim Pengawas</th>
                <td class="colon">:</td>
                <td>{{ \App\Models\User::find($pengawasan->pengawas)->name }}</td>
            </tr>
            <tr>
                <th>Bidang</th>
                <td class="colon">:</td>
                <td>{{ \App\Models\Bidang::find($pengawasan->bidang)->nama }}</td>
            </tr>
            <tr>
                <th>Bidang</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->subbidang }}</td>
            </tr>
            <tr>
                <th>Temuan</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->tajuk }}</td>
            </tr>
            <tr>
                <th>Kondisi</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->kondisi }}</td>
            </tr>
            <tr>
                <th>Kriteria</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->kriteria }}</td>
            </tr>
            <tr>
                <th>Sebab</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->sebab }}</td>
            </tr>
            <tr>
                <th>Akibat</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->akibat }}</td>
            </tr>
            <tr>
                <th>Rekomendasi</th>
                <td class="colon">:</td>
                <td>{{ $pengawasan->rekomendasi }}</td>
            </tr>
            <tr>
                <th>Eviden</th>
                <td class="colon">:</td>
                <td>
                    <img src="{{ asset('eviden/' . $pengawasan->eviden) }}" alt="Eviden Image" width="200">
                    
                </td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 20px;">
        <table>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <!-- Add an empty row for spacing with a height of 20 pixels -->
        </tr>
        
        <tr>

    <td style="width: 300px; padding-left: 20px;">
        
            <td >
            {{$alamat}}, 09 Oktober 2023<br>
            Hakim Pegawas Bidang {{$long_name}}<br><br><br><br>
            {{ \App\Models\User::find($pengawasan->pengawas)->name }}
        </td>
    </tr>
    <tr>
        <!-- Add an empty row for spacing -->
        <td colspan="2"></td>
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
