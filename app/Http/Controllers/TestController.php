<?php

namespace App\Http\Controllers;

use App\Exports\AreaSalesExport;
use App\Models\AreaSales;
use App\Models\History;
use App\Models\MasterSales;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoryExport;
use App\Exports\MasterSalesExport;
use App\Exports\PenjualanExport;
use App\Imports\AreaSalesImport;
use App\Imports\HistoryImport;
use App\Imports\MasterSalesImport;
use App\Imports\PenjualanImport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    public function index(){
        $listHistory = History::all();
        $listPenjualan = Penjualan::all();
        $listAreaSales = AreaSales::all();
        $listMasterSales = MasterSales::all();

        return view('index', [
            'listHistory' => $listHistory,
            'listPenjualan' => $listPenjualan,
            'listAreaSales' => $listAreaSales,
            'listMasterSales' => $listMasterSales,
        ]);
    }

    public function insertHistory(Request $request) {
        $request->validate([
            'kode_toko_baru' => 'unique:table_a,kode_toko_baru',
        ], [
            'kode_toko_baru.unique' => 'Kode toko baru sudah ada.',
        ]);

        $History = new History();
        $result = $History->tambahHistori($request);
        if ($result) {
            Session::flash('success', 'Data berhasil disimpan.');
        } else{
            Session::flash('error', 'Data gagal disimpan.');
        }
        return redirect()->back();
    }

    public function updateHistory(Request $request, $id) {
        $History = new History();
        $result = $History->ubahHistori($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil diubah.');
            return redirect()->back();
        }
    }

    public function deleteHistory(Request $request, $id) {
        $History = new History();
        $result = $History->hapusHistori($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil dihapus.');
            return redirect()->back();
        }
    }

    public function insertPenjualan(Request $request) {
        $request->validate([
            'kode_toko' => 'unique:table_b,kode_toko',
        ], [
            'kode_toko.unique' => 'Kode toko sudah ada.',
        ]);

        $Penjualan = new Penjualan();
        $result = $Penjualan->tambahPenjualan($request);
        if ($result) {
            Session::flash('success', 'Data berhasil disimpan.');
        } else{
            Session::flash('error', 'Data gagal disimpan.');
        }
        return redirect()->back();
    }

    public function updatePenjualan(Request $request, $id) {
        $Penjualan = new Penjualan();
        $result = $Penjualan->ubahPenjualan($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil diubah.');
            return redirect()->back();
        }
    }

    public function deletePenjualan(Request $request, $id) {
        $Penjualan = new Penjualan();
        $result = $Penjualan->hapusPenjualan($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil dihapus.');
            return redirect()->back();
        }
    }

    public function insertAreaSales(Request $request) {
        $request->validate([
            'kode_toko' => 'unique:table_c,kode_toko',
        ], [
            'kode_toko.unique' => 'Kode toko sudah ada.',
        ]);

        $AreaSales = new AreaSales();
        $result = $AreaSales->tambahAreaSales($request);
        if ($result) {
            Session::flash('success', 'Data berhasil disimpan.');
        } else{
            Session::flash('error', 'Data gagal disimpan.');
        }
        return redirect()->back();
    }

    public function updateAreaSales(Request $request, $id) {
        $AreaSales = new AreaSales();
        $result = $AreaSales->ubahAreaSales($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil diubah.');
            return redirect()->back();
        }
    }

    public function deleteAreaSales(Request $request, $id) {
        $AreaSales = new AreaSales();
        $result = $AreaSales->hapusAreaSales($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil dihapus.');
            return redirect()->back();
        }
    }

    public function insertMasterSales(Request $request) {
        $request->validate([
            'kode_sales' => 'unique:table_d,kode_sales',
        ], [
            'kode_sales.unique' => 'Kode sales sudah ada.',
        ]);

        $MasterSales = new MasterSales();
        $result = $MasterSales->tambahMasterSales($request);
        if ($result) {
            Session::flash('success', 'Data berhasil disimpan.');
        } else{
            Session::flash('error', 'Data gagal disimpan.');
        }
        return redirect()->back();
    }

    public function updateMasterSales(Request $request, $id) {
        $MasterSales = new MasterSales();
        $result = $MasterSales->ubahMasterSales($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil diubah.');
            return redirect()->back();
        }
    }

    public function deleteMasterSales(Request $request, $id) {
        $MasterSales = new MasterSales();
        $result = $MasterSales->hapusMasterSales($request, $id);
        if ($result) {
            Session::flash('success', 'Data berhasil dihapus.');
            return redirect()->back();
        }
    }

    public function exportHistoryExcel()
    {
        return Excel::download(new HistoryExport, 'History.xlsx');
    }

    public function exportHistoryPdf()
    {
        // $listHistory = History::all();
        // $listPenjualan = Penjualan::all();
        // $listAreaSales = AreaSales::all();
        // $listMasterSales = MasterSales::all();
        // $pdf = FacadePdf::loadView('index', compact('listHistory', 'listPenjualan', 'listAreaSales', 'listMasterSales'));
        // return $pdf->download('history_table.pdf');
        // Membuat objek Dompdf
        $dompdf = new Dompdf();

        // Load view dengan section yang ditentukan
        $view = View::make('index');
        $view->with('history');

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($view->render());

        // Render PDF (opsional jika ingin langsung men-downloadnya)
        $dompdf->render();

        // Download file PDF
        return $dompdf->stream('history_table.pdf');
    }

    public function importHistory(Request $request)
    {
        $request->validate([
            'fileHistory' => 'required|mimes:xls,xlsx'
        ]);
        $result = Excel::import(new HistoryImport, $request->file('fileHistory'));
        if ($result) {
            return redirect()->back()->with('success', 'Data imported successfully!');
        } else{
            return redirect()->back()->with('error', 'Data failed imported!');
        }
    }

    public function importPenjualan(Request $request)
    {
        $request->validate([
            'filePenjualan' => 'required|mimes:xls,xlsx'
        ]);
        $result = Excel::import(new PenjualanImport, $request->file('filePenjualan'));
        if ($result) {
            return redirect()->back()->with('success', 'Data imported successfully!');
        } else{
            return redirect()->back()->with('error', 'Data failed imported!');
        }
    }

    public function exportPenjualanExcel()
    {
        return Excel::download(new PenjualanExport, 'Penjualan.xlsx');
    }

    public function importAreaSales(Request $request)
    {
        $request->validate([
            'fileAreaSales' => 'required|mimes:xls,xlsx'
        ]);
        $result = Excel::import(new AreaSalesImport, $request->file('fileAreaSales'));
        if ($result) {
            return redirect()->back()->with('success', 'Data imported successfully!');
        } else{
            return redirect()->back()->with('error', 'Data failed imported!');
        }
    }

    public function exportAreaSalesExcel()
    {
        return Excel::download(new AreaSalesExport, 'AreaSales.xlsx');
    }

    public function importMasterSales(Request $request)
    {
        $request->validate([
            'fileMasterSales' => 'required|mimes:xls,xlsx'
        ]);
        $result = Excel::import(new MasterSalesImport, $request->file('fileMasterSales'));
        if ($result) {
            return redirect()->back()->with('success', 'Data imported successfully!');
        } else{
            return redirect()->back()->with('error', 'Data failed imported!');
        }
    }

    public function exportMasterSalesExcel()
    {
        return Excel::download(new MasterSalesExport, 'MasterSales.xlsx');
    }
}
