<?php

namespace App\Http\Controllers;

use App\Models\ServiceCenter;
use Illuminate\Http\Request;

class ServiceCenterController extends Controller
{
    /**
     * Display the main locator page with all centers.
     */
    public function index(Request $request)
    {
        // 1. Fetch all centers ordered alphabetically by name
        // This ensures a professional, predictable list for the user
        $centers = ServiceCenter::orderBy('name', 'asc')->get();

        // 2. Return the view with the data
        return view('centers.index', compact('centers'));
    }

    /**
     * API Endpoint for dynamic searching/filtering.
     * Useful if you decide to implement server-side AJAX searching later.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        if (empty($query)) {
            return response()->json([
                'status' => 'success',
                'data' => ServiceCenter::all()
            ]);
        }

        // Search by Name, Address, or even Pastor in Charge
        $centers = ServiceCenter::where('name', 'LIKE', "%$query%")
            ->orWhere('address', 'LIKE', "%$query%")
            ->orWhere('pastor_in_charge', 'LIKE', "%$query%")
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $centers
        ]);
    }
}
