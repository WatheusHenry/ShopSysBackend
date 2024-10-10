<?php

namespace App\Repositories\Implementations;

use App\Models\Sales;
use App\Repositories\Contracts\SalesRepositoryInterface;

class SalesRepository implements SalesRepositoryInterface
{
  public function getAll()
  {

    return Sales::with('user:id,name,email')->get();
  }

  public function getById($id)
  {
    return Sales::with('user:id,name,email')->find($id);
  }

  public function getByUser($id)
  {
    return Sales::with('user:id,name,email')->where('seller_id', $id)->get();
  }

  public function create(array $data)
  {
    return Sales::create($data);
  }

  public function update($id, array $data)
  {
    $sale = Sales::find($id);
    if ($sale) {
      $sale->update($data);
      return $sale;
    }
    return null;
  }

  public function delete($id)
  {
    $sale = Sales::find($id);
    if ($sale) {
      $sale->delete();
      return true;
    }
    return false;
  }
}
