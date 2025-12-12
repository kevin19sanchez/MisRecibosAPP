<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recibos = Recibo::all();
        return view(compact('recibos'));
    }

    public function downloadPDF($id){
        $recibo = Recibo::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

        $pdf = Pdf::loadView('pdf.receipt_pdf', compact('recibo'));

        return $pdf->download('recibo_' . $recibo->reference_code . '.pdf');
    }

}
