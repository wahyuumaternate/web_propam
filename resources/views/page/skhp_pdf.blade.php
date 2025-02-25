<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Surat Keterangan Hasil Penelitian Personel (SKHP)</title>
    {{-- \public\font\Roboto --}}
    <style>
        @font-face {
            font-family: 'PT Serif';
            src: url({{ public_path('fonts/pt-serif/PTSerif-Regular.ttf') }}) format('truetype');
        }


        body {
            font-family: 'PT Serif', serif;
            font-size: 14px;
            line-height: 1.4;
            /* Reduced line height */
            margin: 0;
            padding: 20px;
        }

        .content-wrapper {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            width: 50%;
            /* Lebar elemen tetap 50% dari halaman */
            text-align: center;
            /* Teks di dalam elemen rata tengah */
            font-weight: bold;
            margin-left: -25px;
            /* Geser elemen lebih ke kiri */
            margin-right: 0;
            /* Tidak ada margin kanan */
            padding-left: 0;
            /* Pastikan tidak ada padding */
            box-sizing: border-box;
            /* Tambahkan agar padding tidak memengaruhi layout */
        }

        .footer {
            text-align: left;
            font-weight: bold;
            margin: 5px 0;
            /* Reduced margin */
        }

        .logo-container {
            text-align: center;
            margin-bottom: 10px;
            /* Reduced margin */
        }

        .logo {
            width: 70px;
            /* Adjusted size */
            height: auto;
        }

        .confidential {
            text-align: center;
            font-weight: bold;
            color: #000000;
            margin: 10px 0;
            text-decoration: underline;
            /* Reduced margin */
        }

        .title {
            text-align: center;
            font-size: 14px;
            /* Reduced size */
            font-weight: bold;
            margin: 10px 0;
            /* Reduced margin */
        }

        .content {
            margin: 5px 5px;
            /* Reduced margin */
            font-size: 14px;
            /* Adjusted font size */
            text-align: justify;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            /* Reduced margin */
        }

        .info-table td {
            padding: 7px 3px;
            /* Reduced padding */
            vertical-align: top;
        }

        .info-label {
            width: 150px;
            /* Adjusted width */
            font-weight: normal;
        }

        .info-colon {
            width: 10px;
            text-align: center;
        }

        .info-value {
            font-weight: normal;

        }

        .footer-info {
            margin-top: 15px;
            /* Reduced margin */
            font-weight: bold;
        }

        .recipient {
            margin-top: 10px;
            /* Reduced margin */
        }

        .watermark {
            position: absolute;
            top: 46%;
            left: 50%;
            width: 85%;
            height: 85%;
            background-image: url({{ public_path('assets/img/LP.png') }});
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.2;
            transform: translate(-50%, -50%);
        }

        .signature-table {
            width: 95%;
            margin-top: 15px;
            /* Reduced margin */
        }

        .signature-table td {
            vertical-align: top;
        }

        .photo-placeholder {
            border: 1px solid black;
            width: 90px;
            /* Adjusted size */
            height: 135px;
            /* Adjusted size */
            text-align: center;
            font-size: 10px;
            margin-left: 80px;
            /* Reduced font size */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .signature-details {
            font-size: 12px;
            /* Reduced font size */
            text-align: right;
            padding-left: 10px;
            /* Reduced padding */
        }


        .official-title,
        .name,
        .rank {
            margin: 0 0;
            /* Reduced margins */
            margin-left: 25%;
        }

        .official-title {
            font-weight: bold;
            text-align: center;
        }

        .name {
            font-weight: bold;
            /* text-decoration: underline; */
            text-align: center;
        }

        .rank {
            text-align: center;
            font-weight: bold;
        }

        .location-date {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            margin-left: 180px;

        }

        .location-date .row {
            align-items: center;
            display: flex;
            margin: 2px 0;
            /* Space between rows */
        }

        .label {
            width: 150px;
            /* Adjust width as needed */
            text-align: left;
        }

        .colon {
            width: 10px;
            text-align: left;
        }

        .value {
            text-align: left;
            flex: 1;
            /* Ensures value spans the remaining space */
        }



        ol {
            margin: 0;
            /* Hapus margin */
            padding-left: 0;
            /* Hapus padding kiri */
            text-align: left;
            /* Pastikan teks rata kiri */
        }

        li {
            margin-top: 20px;
        }

        .info-table {
            text-transform: uppercase;
        }

        .signature {
            /* margin-top: 25px; */
            text-align: center;
            /* Memastikan semua elemen di dalamnya sejajar tengah */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .separator-container {
            margin-left: 35.5%;
            width: 100%;
            /* Pastikan lebar container penuh agar garis bisa sejajar */
            display: flex;
            justify-content: center;
        }

        .separator {
            width: 53%;
            /* Sesuaikan panjang garis */
            margin: 0 0;
            /* Beri jarak antara nama dan pangkat */
            border: 1px solid black;
            /* Sesuaikan ketebalan dan warna */
        }

        .page-break {
            page-break-before: always;
            /* Memastikan elemen ini mulai di halaman baru */
            display: block;
            /* Pastikan tampil sebagai elemen blok */
            margin-top: 20px;
            /* Beri sedikit jarak agar rapi */
        }

        .rank {
            display: inline-block;
            /* Agar border hanya sepanjang teks */
            border-top: 2px solid black;
            /* Atur ketebalan sesuai keinginan */

            /* Jarak antara teks dan garis */
            font-weight: bold;
        }

        /*  */
    </style>

</head>
{{-- .rank {
    display: inline-block;
    /* Agar border hanya sepanjang teks */
    border-top: 1px solid black;
    /* Atur ketebalan sesuai keinginan */
   
    /* Jarak antara teks dan garis */
    font-weight: bold;
}

.name {
    display: inline-block;
    /* Agar border hanya sepanjang teks */
    font-weight: bold;
    border-bottom: 1px solid black;
    /* Garis di bawah teks */
} --}}

<body style="font-family: 'Trebuchet MS', sans-serif;">
    <!-- Background watermark -->
    <div class="watermark"></div>

    <div class="confidential">RAHASIA</div>
    <div class="content-wrapper">
        <div class="header">
            KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>
            <span>DAERAH MALUKU UTARA</span> <br>
            <span style="text-decoration: underline;">BIDANG PROFESI DAN PENGAMANAN</span>
        </div>

        <div class="logo-container">
            <img src="{{ public_path('assets/img/logo-polri.png') }}" class="logo">
        </div>


        <div class="title"><span style="text-decoration: underline;">SURAT KETERANGAN HASIL PENELITIAN PERSONEL</span>
            <br>( S K H P )
        </div>

        <p style="text-align: center; margin: 10px 0; font-weight: bold">
            Nomor: SKHP - {{ $skhp->id }} / {{ $romanMonth }}
            / {{ date('Y') }} / LITPERS
        </p>

        <div class="content">
            <ol>
                <li>Berdasarkan Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 13 Tahun 2016 tentang
                    pengamanan internal di lingkungan Polri.</li>
                <li>Peraturan Kepala Divisi Profesi dan Pengamanan Kepolisian Negara Republik Indonesia Nomor 1 Tahun
                    2016
                    tentang Standar Operasional Prosedur Catatan Personel Bagi Pegawai Negeri Pada Kepolisian Negara
                    Republik Indonesia.</li>

                <p style="margin-bottom:-10px; padding-bottom:-10px;">Dengan ini menerangkan bahwa hasil Penelitian
                    terhadap:
                </p>

                <!-- Updated HTML Structure for .info-table -->
                <table class="info-table" style="margin-top:0; padding-top:0;">
                    <tr>
                        <td class="info-label">Nama</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->nama }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Tempat dan tgl. lahir</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">
                            {{ $skhp->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($skhp->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}
                        </td>

                    </tr>
                    <tr>
                        <td class="info-label">Jenis Kelamin</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Agama</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->agama }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Pangkat / Nrp / Nip</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">
                            @foreach ($pangkat as $p)
                                @if ($skhp->id_pangkat == $p->id)
                                    {{ $p->nama_pangkat }} /
                                @endif
                            @endforeach
                            {{ $skhp->nrp_nip }}
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">Jabatan</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->jabatan }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Kesatuan / Instansi</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->kesatuan_instansi }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Alamat Kantor</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->alamat_kantor }}</td>
                    </tr>
                </table>

                <p style="text-align: center; font-weight: bold; width: 85%; margin: 20px auto;">
                    {{ $status }} untuk {!! nl2br(e($skhp->peruntukan)) !!}
                </p>


                <li>Hasil penelitian ini berlaku selama 6 (enam) bulan sejak dikeluarkan. Apabila di kemudian hari
                    terdapat kekeliruan, surat keterangan hasil penelitian ini akan dicabut.</li>
            </ol>

            <br><br>
            <table class="signature-table">

                <tr>
                    <!-- Photo Placeholder on the Left -->
                    <td style="width: 120px;">
                        <div class="photo-placeholder">
                            FOTO<br>BERWARNA<br>4 X 6
                        </div>
                    </td>

                    <!-- Signature Details on the Right -->
                    <td class="signature-details">
                        <div class="location-date" style="text-align: left; margin-top: 0; margin-bottom: 0;">
                            <div class="row"
                                style="display: flex; justify-content: space-between; width: 100%; margin-top: 0; margin-bottom: 0;">
                                <span class="label" style="flex-grow: 1;">Di Keluarkan di</span>
                                <span class="colon" style="margin-left: 5px;">:</span>
                                <span class="value">{{ $tamplate->di_keluar_di }}</span>
                            </div>
                            <div class="row row2"
                                style="display: inline-flex; width: auto; border-bottom: 1px solid black; margin-top: 0; margin-bottom: 1px;">
                                <span class="label">Pada tanggal</span>
                                <span class="colon" style="margin-left: 16px;">:</span>
                                <span class="value">
                                    {{ \Carbon\Carbon::now('Asia/Jayapura')->locale('id')->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>



                        <div class="official-title">
                            @if ($ttd)
                                KEPALA BIDANG PROPAM POLDA MALUKU UTARA
                            @else
                                a.n KEPALA BIDANG PROPAM POLDA MALUKU UTARA
                                Ps. KASUBBID PAMINAL
                            @endif
                        </div>
                        <br><br><br>
                        @if ($ttd)
                            <div class="signature">
                                <div class="name">{{ $tamplate->kabid_nama }}</div>
                                {{-- <div class="separator-container">
                                    <hr class="separator">
                                </div> --}}
                                <div class="rank">{{ $tamplate->kabid_pangkat }} NRP {{ $tamplate->kabid_nrp }}
                                </div>
                            </div>
                        @else
                            <div class="signature">
                                <div class="name">{{ $tamplate->kasubid_nama }}</div>
                                {{-- <div class="separator-container">
                                    <hr class="separator">
                                </div> --}}
                                <div class="rank">{{ $tamplate->kasubid_pangkat }} NRP {{ $tamplate->kasubid_nrp }}
                                </div>
                            </div>
                        @endif


                    </td>
                </tr>
            </table>

            <div class="recipient">
                Kepada:<br>
                Yth. KARO SDM POLDA MALUKU UTARA
            </div>

            <div class="confidential">RAHASIA</div>
        </div>
    </div>
    {{-- break --}}
    <div class="page-break"></div>
    <!-- Background watermark -->
    <div class="watermark"></div>

    <div class="confidential">RAHASIA</div>
    <div class="content-wrapper">
        <div class="header">
            KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>
            <span>DAERAH MALUKU UTARA</span> <br>
            <span style="text-decoration: underline;">BIDANG PROFESI DAN PENGAMANAN</span>
        </div>

        <div class="logo-container">
            <img src="{{ public_path('assets/img/logo-polri.png') }}" class="logo">
        </div>


        <div class="title"><span style="text-decoration: underline;">SURAT KETERANGAN HASIL PENELITIAN PERSONEL</span>
            <br>( S K H P )
        </div>

        <p style="text-align: center; margin: 10px 0; font-weight: bold">
            Nomor: SKHP - {{ $skhp->id }} / {{ $romanMonth }}
            / {{ date('Y') }} / LITPERS
        </p>

        <div class="content">
            <ol>
                <li>Berdasarkan Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 13 Tahun 2016 tentang
                    pengamanan internal di lingkungan Polri.</li>
                <li>Peraturan Kepala Divisi Profesi dan Pengamanan Kepolisian Negara Republik Indonesia Nomor 1 Tahun
                    2016
                    tentang Standar Operasional Prosedur Catatan Personel Bagi Pegawai Negeri Pada Kepolisian Negara
                    Republik Indonesia.</li>

                <p style="margin-bottom:-10px; padding-bottom:-10px;">Dengan ini menerangkan bahwa hasil Penelitian
                    terhadap:
                </p>

                <!-- Updated HTML Structure for .info-table -->
                <table class="info-table" style="margin-top:0; padding-top:0;">
                    <tr>
                        <td class="info-label">Nama</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->nama }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Tempat dan tgl. lahir</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">
                            {{ $skhp->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($skhp->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}
                        </td>

                    </tr>
                    <tr>
                        <td class="info-label">Jenis Kelamin</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Agama</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->agama }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Pangkat / Nrp / Nip</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">
                            @foreach ($pangkat as $p)
                                @if ($skhp->id_pangkat == $p->id)
                                    {{ $p->nama_pangkat }} /
                                @endif
                            @endforeach
                            {{ $skhp->nrp_nip }}
                        </td>
                    </tr>
                    <tr>
                        <td class="info-label">Jabatan</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->jabatan }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Kesatuan / Instansi</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->kesatuan_instansi }}</td>
                    </tr>
                    <tr>
                        <td class="info-label">Alamat Kantor</td>
                        <td class="info-colon">:</td>
                        <td class="info-value">{{ $skhp->alamat_kantor }}</td>
                    </tr>
                </table>

                <p style="text-align: center; font-weight: bold; width: 85%; margin: 20px auto;">
                    {{ $status }} untuk {!! nl2br(e($skhp->peruntukan)) !!}
                </p>


                <li>Hasil penelitian ini berlaku selama 6 (enam) bulan sejak dikeluarkan. Apabila di kemudian hari
                    terdapat kekeliruan, surat keterangan hasil penelitian ini akan dicabut.</li>
            </ol>

            <br><br>
            <table class="signature-table">

                <tr>
                    <td
                        style="width: 110px; vertical-align: top; text-align: left; padding-right: 0; margin-right: 0;">
                        <strong>Kabid Propam</strong>
                        <br><br>
                        <strong>Paraf :</strong>
                        @if ($ttd)
                            <br>1. Konseptor :
                            <br>
                            <br>2. Kaur Litpers :
                            <br>
                            <br>3. Ksb Paminal :
                            <br>
                        @else
                            <br>1. Konseptor :
                            <br>
                            <br>2. Kaur Litpers :
                            <br>
                        @endif
                    </td>
                    <!-- Photo Placeholder on the Left -->
                    <td style="width: 50px;">
                        <div class="photo-placeholder">
                            FOTO<br>BERWARNA<br>4 X 6
                        </div>
                    </td>

                    <!-- Signature Details on the Right -->
                    <td class="signature-details ">
                        <div class="location-date" style="text-align: left; margin: 0 0 0 150px;">
                            <div class="row" style="display: flex; justify-content: space-between; width: 100%; ">
                                <span class="label" style="flex-grow: 1;">Dikeluarkan di</span>
                                <span class="colon">:</span>
                                <span class="value">{{ $tamplate->di_keluar_di }}</span>
                            </div>

                            <div class="row row2"
                                style="display: flex; width: 100%; border-bottom: 1px solid black; margin: 2px 0 0;">
                                <span class="label">Pada tanggal</span>
                                <span class="colon" style="margin-left: 10px;">:</span>
                                <span class="value">
                                    {{ \Carbon\Carbon::now('Asia/Jayapura')->locale('id')->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>



                        <div class="official-title">
                            @if ($ttd)
                                KEPALA BIDANG PROPAM POLDA MALUKU UTARA
                            @else
                                a.n KEPALA BIDANG PROPAM POLDA MALUKU UTARA
                                Ps. KASUBBID PAMINAL
                            @endif
                        </div>
                        <br><br><br>
                        @if ($ttd)
                            <div class="signature">
                                <div class="name">{{ $tamplate->kabid_nama }}</div>
                                {{-- <div class="separator-container">
                                    <hr class="separator">
                                </div> --}}
                                <div class="rank">{{ $tamplate->kabid_pangkat }} NRP {{ $tamplate->kabid_nrp }}
                                </div>
                            </div>
                        @else
                            <div class="signature">
                                <div class="name">{{ $tamplate->kasubid_nama }}</div>
                                {{-- <div class="separator-container">
                                    <hr class="separator">
                                </div> --}}
                                <div class="rank">
                                    {{ $tamplate->kasubid_pangkat }} NRP {{ $tamplate->kasubid_nrp }}
                                </div>

                            </div>
                        @endif


                    </td>
                </tr>
            </table>

            <div class="recipient">
                Kepada:<br>
                Yth. KARO SDM POLDA MALUKU UTARA
            </div>

            <div class="confidential">RAHASIA</div>
        </div>
    </div>
</body>

</html>
