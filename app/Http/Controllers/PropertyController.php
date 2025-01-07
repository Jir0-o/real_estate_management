<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.property.property_view');
    }
    public function getProperty()
    {        
        try {
            $property = Property::all();

            return response()->json([
                'status' => true,
                'message' => 'Property data retrieved successfully',
                'data' => [
                    'property'=> $property
                ],
            ], 201); 

        } catch (\Exception $e) {
            Log::error('Error retrieving property data: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve property data',
                'error' => $e->getMessage()
            ], 500); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
