<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        private TransactionService $service
    )
    {}

    public function index(Request $request): View
    {
        $misTransacciones = $request->user()->transactions()->get();

        return view('transactions.list', compact('misTransacciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $categorias = $request->user()->categories()->get();

        return view('transactions.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {

        $this->service->store($request->validated(),Auth::id());

        return redirect()->route('transactions.index');
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
    public function edit(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);

        $categories = $request->user()->categories()->get();

        return view('transactions.edit', compact( 'transaction', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);

        $this->service->update($transaction, $request->validated());

        return redirect()->route('transactions.index')->with('success', 'Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);

        $this->service->destroy($transaction);

        return redirect()->route('transactions.index');
    }
}
