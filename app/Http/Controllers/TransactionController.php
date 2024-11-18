<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // List all transactions for the authenticated user
        $query = Transaction::where('user_id', auth()->id());

        // Filter by transaction type (optional)
        if ($request->has('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        // Filter by status (optional)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $transactions = $query->get();

        return response()->json($transactions);
    }

    public function show($id)
    {
        // View a specific transaction
        $transaction = Transaction::findOrFail($id);
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        // Create a new transaction
        $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'item_id' => 'nullable|uuid|exists:items,id',
            'amount' => 'required|numeric',
            'transaction_type' => 'required|in:Storage Fee,Rebuy Fee,Marketplace Sale',
            'status' => 'required|in:Pending,Completed,Failed',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        // Update a specific transaction's status
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Completed,Failed',
        ]);

        $transaction->update($request->only(['status']));

        return response()->json($transaction);
    }
}
