<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $books = Books::withTrashed()->get();

        return response()->json([
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'genre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $book = Books::create($request->only('title', 'author', 'description', 'price', 'genre'));

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $book
     * @return \Illuminate\Http\Response
     */
    public function show(string $book): JsonResponse
    {
        $book = Books::find($book);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        return response()->json([
            'data' => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $book): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'price' => 'required',
            'genre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $book = Books::find($book);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        $book->update($request->only('title', 'author', 'description', 'price', 'genre'));

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $book): JsonResponse
    {
        $book = Books::find($book);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }

    //softdelete
    public function softdestroy(string $book): JsonResponse
    {
        try {
            $book = Books::findOrFail($book);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ], 200);
    }
}
