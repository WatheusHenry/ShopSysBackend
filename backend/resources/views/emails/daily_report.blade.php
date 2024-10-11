<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório Diário de Vendas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    p {
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
      text-align: left;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Relatório Diário de Vendas</h1>
    <p>Olá {{ $userName }},</p>
    <p>Abaixo estão os detalhes das vendas:</p>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Valor</th>
          <th>Vendedor</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sales as $sale)
        <tr>
          <td>{{ $sale->id }}</td>
          <td>{{ number_format($sale->amount, 2, ',', '.') }}</td>
          <td>{{ $sale->seller->name ?? 'Desconhecido' }}</td> <!-- Se você tiver um relacionamento -->
          <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <p>Atenciosamente,</p>
    <p>Sua Equipe</p>
  </div>

  <footer>
    <p>&copy; {{ date('Y') }} SysShop. Todos os direitos reservados.</p>
  </footer>
</body>

</html>