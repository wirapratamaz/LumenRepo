<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    private $dosens = [];

    public function index()
    {
        return response()->json([
            'data' => $this->dosens
        ], 200);
    }

    public function show($id)
    {
        $dosen = $this->findDosen($id);

        if (!$dosen) {
            return response()->json([
                'message' => 'Dosen not found'
            ], 404);
        }

        return response()->json([
            'data' => $dosen
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $dosen = [
            'id' => uniqid(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        $this->dosens[] = $dosen;

        return response()->json([
            'message' => 'Dosen created successfully',
            'data' => $dosen
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $dosen = $this->findDosen($id);

        if (!$dosen) {
            return response()->json([
                'message' => 'Dosen not found'
            ], 404);
        }

        $dosen['name'] = $request->input('name');
        $dosen['email'] = $request->input('email');

        return response()->json([
            'message' => 'Dosen updated successfully',
            'data' => $dosen
        ], 200);
    }

    public function destroy($id)
    {
        $index = $this->findDosenIndex($id);

        if ($index === false) {
            return response()->json([
                'message' => 'Dosen not found'
            ], 404);
        }

        $dosen = $this->dosens[$index];
        array_splice($this->dosens, $index, 1);

        return response()->json([
            'message' => 'Dosen deleted successfully',
            'data' => $dosen
        ], 200);
    }

    private function findDosen($id)
    {
        foreach ($this->dosens as $dosen) {
            if ($dosen['id'] === $id) {
                return $dosen;
            }
        }

        return null;
    }

    private function findDosenIndex($id)
    {
        foreach ($this->dosens as $index => $dosen) {
            if ($dosen['id'] === $id) {
                return $index;
            }
        }

        return false;
    }
}
