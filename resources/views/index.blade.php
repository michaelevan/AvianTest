<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Avian Test</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    body {
        padding: 5%;
    }
    .card {
        margin: 3%;
        padding: 3%;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            {{-- HISTORY --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="m-0">Ini Tabel History</h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertHistory">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            {{-- modal insert --}}
                            <div class="modal fade" id="insertHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('history.insert') }}" method="POST">
                                            @csrf
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="kode_toko_baru">Kode Toko Baru</label>
                                                    <input type="number" class="form-control @error('kode_toko_baru') is-invalid @enderror" id="kode_toko_baru" name="kode_toko_baru" required">
                                                    @error('kode_toko_baru')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="kode_toko_lama">Kode Toko Lama</label>
                                                    <input type="number" class="form-control" id="kode_toko_lama" name="kode_toko_lama" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="historyTable" class="table table-bordered">
                            <thead class="table-light">
                                <th>Kode Toko Baru</th>
                                <th>Kode Toko Lama</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($listHistory as $LH)
                                    <tr>
                                        <td>{{ $LH->kode_toko_baru }}</td>
                                        <td>{{ $LH->kode_toko_lama }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateHistory{{$LH->kode_toko_baru}}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>&nbsp;&nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHistory{{$LH->kode_toko_baru}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                        {{-- ini modal update --}}
                                        <div class="modal fade" id="updateHistory{{$LH->kode_toko_baru}}" tabindex="-1" role="dialog" aria-labelledby="updateHistoryLabel{{$LH->kode_toko_baru}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('history.update', ['id' => $LH->kode_toko_baru]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="updateHistoryLabel{{$LH->kode_toko_baru}}">Update Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="kode_toko_baru">Kode Toko Baru</label>
                                                                <input type="number" class="form-control" id="kode_toko_baru" name="kode_toko_baru" value="{{ $LH->kode_toko_baru }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kode_toko_lama">Kode Toko Lama</label>
                                                                <input type="number" class="form-control" id="kode_toko_lama" name="kode_toko_lama" value="{{ $LH->kode_toko_lama }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ini modal delete --}}
                                        <div class="modal fade" id="deleteHistory{{$LH->kode_toko_baru}}" tabindex="-1" role="dialog" aria-labelledby="deleteHistoryLabel{{$LH->kode_toko_baru}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('history.delete',  ['id' => $LH->kode_toko_baru]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="deleteHistoryLabel{{$LH->kode_toko_baru}}">Delete Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda ingin menghapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="flex: 1;">
                                <form action="{{ route('import.history') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="fileHistory" accept=".xls,.xlsx" class="form-control-file">
                                    <button type="submit" class="btn btn-secondary mt-2">
                                        <i class="fa-solid fa-upload"></i> Import
                                    </button>
                                </form>
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <a href="{{ route('export.history.excel') }}" class="btn btn-success">
                                    <i class="fa-solid fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('export.history.pdf') }}" class="btn btn-danger ml-2">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PENJUALAN --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="m-0">Ini Tabel Penjualan</h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertPenjualan">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            {{-- modal insert --}}
                            <div class="modal fade" id="insertPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('penjualan.insert') }}" method="POST">
                                            @csrf
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="kode_toko">Kode Toko</label>
                                                    <input type="number" class="form-control @error('kode_toko') is-invalid @enderror" id="kode_toko" name="kode_toko" required">
                                                    @error('kode_toko')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nominal_transaksi">Nominal Transaksi</label>
                                                    <input type="number" class="form-control" id="nominal_transaksi" name="nominal_transaksi" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <th>Kode Toko</th>
                                <th>Nominal Transaksi</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($listPenjualan as $LP)
                                    <tr>
                                        <td>{{ $LP->kode_toko }}</td>
                                        <td>{{ $LP->nominal_transaksi }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updatePenjualan{{$LP->kode_toko}}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>&nbsp;&nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePenjualan{{$LP->kode_toko}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                        {{-- ini modal update --}}
                                        <div class="modal fade" id="updatePenjualan{{$LP->kode_toko}}" tabindex="-1" role="dialog" aria-labelledby="updatePenjualanLabel{{$LP->kode_toko}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('penjualan.update', ['id' => $LP->kode_toko]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="updatePenjualanLabel{{$LP->kode_toko}}">Update Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="kode_toko">Kode Toko</label>
                                                                <input type="number" class="form-control" id="kode_toko" name="kode_toko" value="{{ $LP->kode_toko }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nominal_transaksi">Nominal Transaksi</label>
                                                                <input type="number" class="form-control" id="nominal_transaksi" name="nominal_transaksi" value="{{ $LP->nominal_transaksi }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ini modal delete --}}
                                        <div class="modal fade" id="deletePenjualan{{$LP->kode_toko}}" tabindex="-1" role="dialog" aria-labelledby="deletePenjualanLabel{{$LP->kode_toko}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('penjualan.delete',  ['id' => $LP->kode_toko]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="deletePenjualanLabel{{$LP->kode_toko}}">Delete Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda ingin menghapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="flex: 1;">
                                <form action="{{ route('import.penjualan') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="filePenjualan" accept=".xls,.xlsx" class="form-control-file">
                                    <button type="submit" class="btn btn-secondary mt-2">
                                        <i class="fa-solid fa-upload"></i> Import
                                    </button>
                                </form>
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <a href="{{ route('export.penjualan.excel') }}" class="btn btn-success">
                                    <i class="fa-solid fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('export.penjualan.pdf') }}" class="btn btn-danger ml-2">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- AREA SALES --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="m-0">Ini Tabel Area Sales</h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertAreaSales">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            {{-- modal insert --}}
                            <div class="modal fade" id="insertAreaSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('areaSales.insert') }}" method="POST">
                                            @csrf
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="kode_toko">Kode Toko</label>
                                                    <input type="number" class="form-control @error('kode_toko') is-invalid @enderror" id="kode_toko" name="kode_toko" required">
                                                    @error('kode_toko')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="area_sales">Area Sales</label>
                                                    <input type="text" class="form-control" id="area_sales" name="area_sales" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <th>Kode Toko</th>
                                <th>Area Sales</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($listAreaSales as $LAS)
                                    <tr>
                                        <td>{{ $LAS->kode_toko }}</td>
                                        <td>{{ $LAS->area_sales }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateAreaSales{{$LAS->kode_toko}}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>&nbsp;&nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAreaSales{{$LAS->kode_toko}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                        {{-- ini modal update --}}
                                        <div class="modal fade" id="updateAreaSales{{$LAS->kode_toko}}" tabindex="-1" role="dialog" aria-labelledby="updateAreaSalesLabel{{$LAS->kode_toko}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('areaSales.update', ['id' => $LAS->kode_toko]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="updateAreaSalesLabel{{$LAS->kode_toko}}">Update Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="kode_toko">Kode Toko</label>
                                                                <input type="number" class="form-control" id="kode_toko" name="kode_toko" value="{{ $LAS->kode_toko }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="area_sales">Area Sales</label>
                                                                <input type="text" class="form-control" id="area_sales" name="area_sales" value="{{ $LAS->area_sales }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ini modal delete --}}
                                        <div class="modal fade" id="deleteAreaSales{{$LAS->kode_toko}}" tabindex="-1" role="dialog" aria-labelledby="deleteAreaSalesLabel{{$LAS->kode_toko}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('areaSales.delete',  ['id' => $LAS->kode_toko]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="deleteAreaSalesLabel{{$LAS->kode_toko}}">Delete Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda ingin menghapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="flex: 1;">
                                <form action="{{ route('import.areaSales') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="fileAreaSales" accept=".xls,.xlsx" class="form-control-file">
                                    <button type="submit" class="btn btn-secondary mt-2">
                                        <i class="fa-solid fa-upload"></i> Import
                                    </button>
                                </form>
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <a href="{{ route('export.areaSales.excel') }}" class="btn btn-success">
                                    <i class="fa-solid fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('export.areaSales.pdf') }}" class="btn btn-danger ml-2">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MASTER SALES --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="m-0">Ini Tabel Master Sales</h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertMasterSales">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            {{-- modal insert --}}
                            <div class="modal fade" id="insertMasterSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('masterSales.insert') }}" method="POST">
                                            @csrf
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Insert Data</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="kode_sales">Kode Sales</label>
                                                    <input type="text" class="form-control @error('kode_sales') is-invalid @enderror" id="kode_sales" name="kode_sales" required">
                                                    @error('kode_sales')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_sales">Nama Sales</label>
                                                    <input type="text" class="form-control" id="nama_sales" name="nama_sales" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <th>Kode Sales</th>
                                <th>Nama Sales</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($listMasterSales as $LMS)
                                    <tr>
                                        <td>{{ $LMS->kode_sales }}</td>
                                        <td>{{ $LMS->nama_sales }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateMasterSales{{$LMS->kode_sales}}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>&nbsp;&nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMasterSales{{$LMS->kode_sales}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                        {{-- ini modal update --}}
                                        <div class="modal fade" id="updateMasterSales{{$LMS->kode_sales}}" tabindex="-1" role="dialog" aria-labelledby="updateMasterSalesLabel{{$LMS->kode_sales}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('masterSales.update', ['id' => $LMS->kode_sales]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="updateMasterSalesLabel{{$LMS->kode_sales}}">Update Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="kode_sales">Kode Sales</label>
                                                                <input type="text" class="form-control" id="kode_sales" name="kode_sales" value="{{ $LMS->kode_sales }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_sales">Nama Sales</label>
                                                                <input type="text" class="form-control" id="nama_sales" name="nama_sales" value="{{ $LMS->nama_sales }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ini modal delete --}}
                                        <div class="modal fade" id="deleteMasterSales{{$LMS->kode_sales}}" tabindex="-1" role="dialog" aria-labelledby="deleteMasterSalesLabel{{$LMS->kode_sales}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('masterSales.delete',  ['id' => $LMS->kode_sales]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="deleteMasterSalesLabel{{$LMS->kode_sales}}">Delete Data</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda ingin menghapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="flex: 1;">
                                <form action="{{ route('import.masterSales') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="fileMasterSales" accept=".xls,.xlsx" class="form-control-file">
                                    <button type="submit" class="btn btn-secondary mt-2">
                                        <i class="fa-solid fa-upload"></i> Import
                                    </button>
                                </form>
                            </div>
                            <div style="flex: 1; text-align: right;">
                                <a href="{{ route('export.masterSales.excel') }}" class="btn btn-success">
                                    <i class="fa-solid fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('export.masterSales.pdf') }}" class="btn btn-danger ml-2">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
