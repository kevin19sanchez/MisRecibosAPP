@extends('template.app')

@section('title', 'Mis Recibos')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Mis Recibos</h2>

    @php
        $usuario = auth()->user();

        $total = $usuario->recibos()->count();
        $pagados = $usuario->recibos()->where('status', 'pagado')->count();
        $pendientes = $usuario->recibos()->where('status', 'pendiente')->count();
    @endphp


    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Total</h5>
                    <p class="display-6 mb-0">{{ $total }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Pagados</h5>
                    <p class="display-6 mb-0">{{ $pagados }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Pendientes</h5>
                    <p class="display-6 mb-0">{{ $pendientes }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de recibos -->
    <div class="card bg-secondary">
        <div class="card-body">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Emisión</th>
                        <th>Vencimiento</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de fila -->
                    @foreach (auth()->user()->recibos as $recibo)
                        <tr>
                            <td>{{ $recibo->reference_code }}</td>
                            <td>{{ $recibo->type }}</td>
                            <td>{{ \Carbon\Carbon::parse($recibo->issue_date)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($recibo->due_date)->format('Y-m-d') }}</td>
                            <td>{{ $recibo->amount }}</td>
                            <td>
                                @if($recibo->status === 'pagado')
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info me-1 btn-ver-recibo"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detalleModal"
                                        data-id="{{ $recibo->id }}"
                                        data-reference="{{ $recibo->reference_code }}"
                                        data-type="{{ $recibo->type }}"
                                        data-issue="{{ $recibo->issue_date }}"
                                        data-due="{{ $recibo->due_date }}"
                                        data-amount="{{ number_format($recibo->amount, 2) }}"
                                        data-status="{{ $recibo->status }}"
                                        data-description="{{ $recibo->description ?? 'No disponible' }}">
                                    <i class="fas fa-eye"></i> Ver
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Detalles del Recibo -->
<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalles del Recibo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Vista previa del PDF -->
                <div class="text-center mb-4">
                    <i class="far fa-file-pdf fa-3x text-muted mb-2"></i>
                    <p class="text-muted">Vista previa del PDF</p>
                    <p class="mb-0" id="modal-proveedor">—</p>
                </div>

                <!-- Detalles del recibo -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tipo de Servicio</label>
                            <p class="fw-bold" id="modal-type">—</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Periodo de Facturación</label>
                            <p class="fw-bold" id="modal-periodo">—</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Monto Total</label>
                            <p class="display-6 fw-bold" id="modal-amount">—</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Proveedor</label>
                            <p class="fw-bold" id="modal-proveedor2">—</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Vencimiento</label>
                            <p class="fw-bold" id="modal-due">—</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <span id="modal-status-badge">—</span>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="card bg-secondary mt-4">
                    <div class="card-header">
                        Información Adicional
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Referencia</strong><br><span id="modal-reference">—</span></p>
                                <p class="mb-0"><strong>Descripción</strong><br><span id="modal-description">—</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Emisión</strong><br><span id="modal-issue-full">{{ $recibo->issue_date ?? '—' }}</span></p>
                                <p class="mb-0"><strong>ID Interno</strong><br><span id="modal-id">—</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="btn-descargar-pdf" class="btn btn-primary w-100">
                    <i class="fas fa-download me-1"></i> Descargar PDF
                </a>
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('detalleModal');
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal

        // Extraer datos del botón
        const id = button.getAttribute('data-id');
        const reference = button.getAttribute('data-reference') || '—';
        const type = button.getAttribute('data-type') || '—';
        const periodo = button.getAttribute('data-issue') || '—';
        const due = button.getAttribute('data-due') || '—';
        const amount = button.getAttribute('data-amount') || '—';
        const status = button.getAttribute('data-status') || '—';
        const description = button.getAttribute('data-description') || '—';

        // Proveedor (usamos el tipo como proveedor por ahora, o puedes mejorar esto después)
        const proveedor = type;

        // Llenar campos del modal
        document.getElementById('modal-proveedor').textContent = proveedor;
        document.getElementById('modal-type').textContent = type;
        document.getElementById('modal-periodo').textContent = periodo;
        document.getElementById('modal-amount').textContent = '$' + amount;
        document.getElementById('modal-proveedor2').textContent = proveedor;
        document.getElementById('modal-due').textContent = due;
        document.getElementById('modal-reference').textContent = reference;
        document.getElementById('modal-description').textContent = description;
        document.getElementById('modal-id').textContent = id;

        // Estado con badge
        const badge = document.getElementById('modal-status-badge');
        if (status === 'pagado') {
            badge.innerHTML = '<span class="badge bg-success">Pagado</span>';
        } else {
            badge.innerHTML = '<span class="badge bg-warning text-dark">Pendiente</span>';
        }

        // Actualizar enlace de descarga
        document.getElementById('btn-descargar-pdf').href = '/recibos/' + id + '/pdf';
    });
});
</script>
@endpush
@endsection
