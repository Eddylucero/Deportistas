@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Países</h1>

    <div class="text-end mb-3">
        <a href="{{ route('paises.create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Nuevo País
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="tablePaises">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre del País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paises as $pais)
                    <tr>
                        <td>{{ $pais->idpais }}</td>
                        <td>{{ $pais->nombrepais }}</td>
                        <td class="text-center">
                            <a href="{{ route('paises.edit', $pais->idpais) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('paises.destroy', $pais->idpais) }}" 
                                  method="POST" 
                                  style="display:inline;" 
                                  class="form-eliminar">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm btn-eliminar">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        new DataTable('#tablePaises', {
            language: { url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json' },
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Eliminar este país?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
});
</script>


@if(session('success'))
<script>
Swal.fire({
    title: "Éxito",
    text: "{{ session('success') }}",
    icon: "success",
    confirmButtonText: "Aceptar"
});
</script>
@endif


@if(session('error'))
<script>
Swal.fire({
    title: "Error",
    text: "{{ session('error') }}",
    icon: "error",
    confirmButtonText: "Aceptar"
});
</script>
@endif

@endsection
