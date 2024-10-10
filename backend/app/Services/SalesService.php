<?php

namespace App\Services;

use App\Repositories\Contracts\SalesRepositoryInterface;

class SalesService
{
  protected $salesRepository;

  public function __construct(SalesRepositoryInterface $salesRepository)
  {
    $this->salesRepository = $salesRepository;
  }

  public function getAllSales()
  {
    return $this->salesRepository->getAll();
  }

  public function getSaleById($id)
  {
    return $this->salesRepository->getById($id);
  }

  public function createSale(array $data)
  {
    $commission = $data['amount'] * 0.08;
    $data['commission'] = $commission;
    
    return $this->salesRepository->create($data);
  }

  public function updateSale($id, array $data)
  {
    return $this->salesRepository->update($id, $data);
  }

  public function deleteSale($id)
  {
    return $this->salesRepository->delete($id);
  }
}
