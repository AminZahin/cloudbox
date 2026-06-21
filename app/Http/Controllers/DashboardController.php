<?php

namespace App\Http\Controllers;

use App\Models\StoredFile;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tenantId = Auth::user()->tenant_id;

        $totalFiles = StoredFile::where('tenant_id', $tenantId)->count();

        $storageUsed = StoredFile::where('tenant_id', $tenantId)->sum('size');

        $recentFiles = StoredFile::where('tenant_id', $tenantId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalFiles',
            'storageUsed',
            'recentFiles'
        ));
    }
}
