<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
            justify-content: center;
        }

        .garis1 {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
        }

        /* #logo {
            margin: auto;
            margin-left: 50%;
            margin-right: auto;
        } */
    </style>

</head>

<body>

    <div style="max-width:900px">
        <header>
            <div style="max-width: 900px">
                <table width="100%">
                    <tr>
                        <td width="120" style="max-width: 120px;">
                            <img src="https://polsub.ac.id/wp-content/uploads/2021/12/logoPOLSUB-HD.png" width="120"
                                height="120">
                        </td>
                        <td align="center">
                            <h5 class="text-center p-0"
                                style="font-family: 'Times New Roman', Times, serif; font-size: 18px; font-weight: 0px">
                                KEMENTERIAN PENDIDIKAN, KEBUDAYAAN<br />
                                RISET, DAN TEKNOLOGI
                            </h5>
                            <h6 class="text-center p-0"
                                style="font-family: 'Times New Roman', Times, serif; font-size: 18px">
                                <strong>POLITEKNIK NEGERI SUBANG</strong>
                            </h6>
                            <p class="text-center p-0"
                                style="font-family: 'Times New Roman', Times, serif; font-size: 12px">
                                Jl. Brigjen Katamso No. 37(Belakang RSUD), Dangder, Subang, Jawa Barat 41211<br />
                                Telp.(0260)417648 Laman: <a
                                    href="https://www.polsub.ac.id"><u>https://www.polsub.ac.id</u></a>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </header>

        <div style="max-width:900px">
            <hr class="garis1" />
            <h5 class="text-left">{{ $title }}</h5>
            <br />

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>School</th>
                    <th>PIC 1</th>
                    <th>PIC 2</th>
                    <th>status</th>
                    <th>Date</th>
                </tr>
                @foreach ($schedule as $s)
                    @php
                        $i = 0;
                        
                        if ($s->status == '1') {
                            $status = 'Terlaksana';
                        } elseif ($s->status == '2') {
                            $status = 'Terlewati/Batal';
                        } elseif ($s->status == '0') {
                            $status = 'Belum Terlaksana';
                        }
                        
                        if (!empty($s->pic1->name)) {
                            $pic1Name = $s->pic1->name;
                        } else {
                            $pic1Name = 'N/A';
                        }
                        if (!empty($s->pic2->name)) {
                            $pic2Name = $s->pic2->name;
                        } else {
                            $pic2Name = 'N/A';
                        }
                        
                    @endphp
                    <tr>


                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->school->name }}</td>
                        <td>{{ $pic1Name }}</td>
                        <td>{{ $pic2Name }}</td>
                        <td>{{ $status }}</td>
                        <td>{{ $s->date }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <br />

        <div style="max-width:900px; right:1rem" align="right">
            Tanggal, {{ $date }}
            Bagian Umum
            <br />
            <br />
            <br />
            <br />
            (....................................)
        </div>
    </div>




</body>

</html>
