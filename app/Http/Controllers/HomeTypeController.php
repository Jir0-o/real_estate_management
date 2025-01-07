<?php

namespace App\Http\Controllers;

use App\Models\HomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.property.home_type');
    }

    public function getHome()
    {        
        try {
            $homeType = HomeType::all();

            return response()->json([
                'status' => true,
                'message' => 'Home type data retrieved successfully',
                'data' => [
                    'homeType'=> $homeType
                ],
            ], 201); 

        } catch (\Exception $e) {
            Log::error('Error retrieving home type data: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve home type data',
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
        // Validate the incoming request
        $request->validate([
            'name'=> 'required',
        ]);

        try {
            // Create a new home type
            $homeType = new HomeType();
            $homeType->name = $request->name;
            $homeType->status = 1;
            $homeType->is_active = 1;
            $homeType->save();

            return response()->json([
                'status' => true,
                'message' => 'Property data stored successfully',
                'data' => [
                    'homeType'=> $homeType
                ],
            ], 201); 

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to store property data',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            // Find the home type by ID
            $homeType = HomeType::find($id);

            return response()->json([
                'status' => true,
                'message' => 'Property data retrieved successfully',
                'data' => [
                    'homeType'=> $homeType
                    ],
                ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieved property data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'name'=> 'required',
        ]);

        try {
            $homeType = HomeType::find($id);
            $homeType->name = $request->name;
            $homeType->save();

            return response()->json([
                'status' => true,
                'message' => 'Property data updated successfully',
                'data' => [
                    'homeType'=> $homeType
                    ],
                ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update property data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $homeType = HomeType::find($id);
            $homeType->delete();

            return response()->json([
                'status' => true,
                'message' => 'Property data deleted successfully',
                'data' => [
                    'homeType'=> $homeType
                    ],
                ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete property data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
