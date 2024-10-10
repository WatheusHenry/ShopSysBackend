<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalesService;

class SalesController extends Controller
{
    protected $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function index()
    {
        $sales = $this->salesService->getAllSales();
        return response()->json($sales);
    }

    public function show($id)
    {
        $sale = $this->salesService->getSaleById($id);

        if (!$sale) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }

        return response()->json($sale);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'seller_id' => 'required|integer|exists:users,id',
        ]);

        $sale = $this->salesService->createSale($validatedData);

        return response()->json(['message' => 'Venda criada com sucesso!', 'sale' => $sale], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'numeric',
            'seller_id' => 'integer|exists:users,id',
        ]);

        $sale = $this->salesService->updateSale($id, $validatedData);

        if (!$sale) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }

        return response()->json(['message' => 'Venda atualizada com sucesso!', 'sale' => $sale]);
    }

    public function destroy($id)
    {
        $deleted = $this->salesService->deleteSale($id);

        if (!$deleted) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }

        return response()->json(['message' => 'Venda deletada com sucesso!']);
    }
}
