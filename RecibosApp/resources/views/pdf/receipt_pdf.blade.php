<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo {{ $recibo->reference_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .row {
            display: flex;
            margin-bottom: 10px;
        }
        .col {
            width: 50%;
        }
        .label {
            font-weight: bold;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #000;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Recibo de Servicio</h2>
    <p>{{ $recibo->type }} – {{ $recibo->issue_date->format('F Y') }}</p>
</div>

<div class="row">
    <div class="col">
        <div><span class="label">Proveedor:</span> {{ $recibo->type }}</div>
        <div><span class="label">Periodo:</span> {{ $recibo->issue_date->format('F Y') }}</div>
        <div><span class="label">Emisión:</span> {{ $recibo->issue_date }}</div>
        <div><span class="label">Vencimiento:</span> {{ $recibo->due_date }}</div>
    </div>
    <div class="col">
        <div><span class="label">Referencia:</span> {{ $recibo->reference_code ?? '—' }}</div>
        <div><span class="label">Estado:</span>
            @if($recibo->status === 'pagado')
                <span class="badge badge-success">Pagado</span>
            @else
                <span class="badge badge-warning">Pendiente</span>
            @endif
        </div>
        <div class="amount">Monto: ${{ number_format($recibo->amount, 2) }}</div>
    </div>
</div>

<div class="section">
    <div><span class="label">Descripción:</span> {{ $recibo->description ?? 'No disponible' }}</div>
</div>

</body>
</html>
