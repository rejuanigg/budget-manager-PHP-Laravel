<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

        return view('categories.list-category', compact('misCategorias'));

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
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated=$request->validated();

        $request->user()->categories()->create($validated);

        return redirect()->route('categories.index');

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
    public function edit(Category $category)
    {
        abort_if($category->user_id !== Auth::id(), 403);

        return view('categories.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        abort_if($category->user_id !== Auth::id(), 403);

        $validated=$request->validated();

        $category->update($validated);

        return redirect()->route('categories.index')->with('exito', 'Modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        abort_if($category->user_id !== Auth::id(), 403);

        try{
            $category->delete();

            return redirect()->route('categories.index');
        }
        catch(QueryException $qe){
            return redirect()->route('categories.index')->with('error', 'No puedes borrar una categoria que tiene transacciones asignadas.');
        };

    }
}
