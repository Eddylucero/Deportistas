@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Listado de Deportistas</h1>

    <div class="text-end mb-3">
        <a href="{{ route('deportistas.create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Nuevo Deportista
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" id="tableDeportistas">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha Nac.</th>
                    <th>Estatura (cm)</th>
                    <th>Peso (kg)</th>
                    <th>País</th>
                    <th>Disciplina</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deportistas as $dep)
                    <tr>
                        <td>{{ $dep->iddeportista }}</td>
                        <td>{{ $dep->nombre }}</td>
                        <td>{{ $dep->fechanacimiento }}</td>
                        <td>{{ $dep->estatura }}</td>
                        <td>{{ $dep->peso }}</td>
                        <td>{{ $dep->pais->nombrepais ?? 'Sin país' }}</td>
                        <td>{{ $dep->disciplina->nombredisciplina ?? 'Sin disciplina' }}</td>

                        <td class="text-center">
                            <a href="{{ route('deportistas.edit', $dep->iddeportista) }}"
                               class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-pen"></i>
                            </a>

                            <form action="{{ route('deportistas.destroy', $dep->iddeportista) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm btn-eliminar">
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
document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#tableDeportistas', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.1/i18n/es-ES.json'
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>


<script>
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-eliminar');
    if (!btn) return;

    e.preventDefault();

    Swal.fire({
        title: 'Confirmar eliminación',
        html: `
            <p>Para eliminar este deportista, escriba <b>ELIMINAR</b> en el campo de abajo.</p>
            <input id="confirmText" class="swal2-input" placeholder="Escriba ELIMINAR">
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            const value = document.getElementById('confirmText').value;
            if (value !== "ELIMINAR") {
                Swal.showValidationMessage("Debe escribir exactamente: ELIMINAR");
                return false;
            }
            return true;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
});
</script>



@if(session('success'))
<script>
Swal.fire({
    title: "Éxito",
    text: "{{ session('success') }}",
    icon: "success"
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    title: "Error",
    text: "{{ session('error') }}",
    icon: "error"
});
</script>
@endif

@endsection
