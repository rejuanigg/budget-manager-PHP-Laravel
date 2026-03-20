<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $misCategorias = $request->user()->categories()->get();

        return view('transactions.create', compact('misCategorias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('categories/create-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated=$request->validate([
            'name'=>[
                'min:3',
                'max:150',
                'required',
                'string',
                Rule::unique('categories')->where('user_id', $request->user()->id)
            ]
        ]);

        $request->user()->categories()->create($validated);
        return redirect()->route('transactions.create');

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
