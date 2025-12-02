@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Disciplinas</h1>

    <div class="text-end mb-3">
        <a href="{{ route('disciplinas.create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Nueva Disciplina
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="tableDisciplinas">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Disciplina</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($disciplinas as $disciplina)
                    <tr>
                        <td>{{ $disciplina->iddisciplina }}</td>
                        <td>{{ $disciplina->nombredisciplina }}</td>
                        <td class="text-center">

                            <a href="{{ route('disciplinas.edit', $disciplina->iddisciplina) }}" 
                               class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('disciplinas.destroy', $disciplina->iddisciplina) }}" 
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
    new DataTable('#tableDisciplinas', {
        language: { url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json' },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
</script>


<script>
document.addEventListener('click', function(e) {

    if (e.target.closest('.btn-eliminar')) {
        e.preventDefault();

        Swal.fire({
            title: '¿Eliminar esta disciplina?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.closest('form').submit();
            }
        });
    }

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
