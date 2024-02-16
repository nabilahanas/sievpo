@extends('layouts.main')

@section('title', 'Rekap Bulanan')

@section('content')
    <title>Rekap Bulanan</title>

    <div class="card">
        <div class="card-body">
            <a class="btn btn-outline-success" href="">Download
                Excel</a>

            <div class="card-body table-responsive">
                <table id="bulanan" class="table table-sm text-nowrap text-hover" style="width=100%">
                    <thead class="thead-successv2">
                        <tr>
                            <th colspan="42">Tanggal 1 s.d. 31</th>
                        </tr>
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Jabatan</th>
                            <th colspan="9" style="text-align: center">Tanaman / Pemeliharaan / Persemaian</th>
                            <th colspan="9" style="text-align: center">Keamanan / Patroli</th>
                            <th colspan="9" style="text-align: center">Sosialisasi / Rapat / Apel</th>
                            <th colspan="9" style="text-align: center">Produksi / Agroforestry / Wisata</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>Jml</th>

                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>Jml</th>

                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>Jml</th>

                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>Jml</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th scope="row">.</th>

                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
