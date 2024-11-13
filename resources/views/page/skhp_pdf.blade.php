<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Hasil Penelitian Personel (SKHP)</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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

        .header,
        .footer {
            text-align: center;
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
            color: red;
            margin: 5px 0;
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
            font-size: 12px;
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
            padding: 1px 3px;
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
            margin: 2px 0;
            /* Reduced margins */
            margin-left: 30%;
        }

        .official-title {
            font-weight: bold;
            text-align: center;
        }

        .name {
            font-weight: bold;
            text-decoration: underline;
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
            margin-right: 70px;

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

        .row2 {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <!-- Background watermark -->
    <div class="watermark"></div>

    <div class="content-wrapper">
        <div class="header">
            KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>
            DAERAH MALUKU UTARA<br>
            BIDANG PROFESI DAN PENGAMANAN
        </div>

        <div class="logo-container">
            <img src="{{ public_path('assets/img/logo-polri.png') }}" class="logo">
        </div>

        <div class="confidential">RAHASIA</div>

        <div class="title">SURAT KETERANGAN HASIL PENELITIAN PERSONEL (SKHP)</div>

        <p style="text-align: center; margin: 10px 0; font-weight: bold">
            Nomor: SKHP - {{ $skhp->id }} / {{ date('m') }} / {{ date('Y') }} / LITPERS
        </p>

        <div class="content">
            <p>1. Berdasarkan Peraturan Kepala Kepolisian Negara Republik Indonesia Nomor 13 Tahun 2016 tentang
                pengamanan internal di lingkungan Polri.</p>
            <p>2. Peraturan Kepala Divisi Profesi dan Pengamanan Kepolisian Negara Republik Indonesia Nomor 1 Tahun 2016
                tentang Standar Operasional Prosedur Catatan Personel Bagi Pegawai Negeri Pada Kepolisian Negara
                Republik Indonesia.</p>
            <p>Dengan ini menerangkan bahwa hasil Penelitian terhadap:</p>

            <!-- Updated HTML Structure for .info-table -->
            <table class="info-table">
                <tr>
                    <td class="info-label">Nama</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">{{ $skhp->nama }}</td>
                </tr>
                <tr>
                    <td class="info-label">Tempat dan tgl. lahir</td>
                    <td class="info-colon">:</td>
                    <td class="info-value">{{ $skhp->tanggal_lahir }}</td>
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
                    <td class="info-value">{{ $skhp->pangkat_nrp_nip }}</td>
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

            <p style="text-align: center; font-weight: bold">
                MEMENUHI SYARAT untuk MENGIKUTI PENGUSULAN KENAIKAN PANGKAT<br>
                TMT PERIODE 01 JANUARI 2025
            </p>

            <p>3. Hasil penelitian ini berlaku selama 6 (enam) bulan sejak dikeluarkan. Apabila di kemudian hari
                terdapat kekeliruan, surat keterangan hasil penelitian ini akan dicabut.</p>

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
                        <div class="location-date">
                            <div class="row">
                                <span class="label">Di Keluarkan di</span>
                                <span class="colon">:</span>
                                <span class="value">Ternate</span>
                            </div>
                            <div class="row row2">
                                <span class="label">Pada tanggal</span>
                                <span class="colon">:</span>
                                <span class="value">{{ date('d F Y') }}</span>
                            </div>
                        </div>

                        <div class="official-title">
                            a.n KABID PROPAM POLDA MALUKU UTARA<br>
                            Ps. KASUBBID PAMINAL
                        </div>
                        <br><br><br><br>
                        <div class="name">ROY BERMAN S.H., S.I.K.</div>
                        <div class="rank">KOMPOL NRP 87121320</div>
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
