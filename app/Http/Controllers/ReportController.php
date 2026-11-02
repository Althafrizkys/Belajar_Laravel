<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales()
    {
        $transactions = Transaction::with('user', 'details.product')
            ->latest()
            ->paginate(15);

        return view('reports.sales', compact('transactions'));
    }
}