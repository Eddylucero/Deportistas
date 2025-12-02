@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" 
         style="min-height: 100vh; background-color: #f8f9fa;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5">
        <div class="bg-light p-4 rounded shadow">

          <h2 class="mb-4 text-center text-dark">
            Editar Deportista
          </h2>

          <form action="{{ route('deportistas.update', $deportista->iddeportista) }}" 
                id="FormDeportista" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

              <div class="col-md-12 mb-3">
                <label><b>Nombre Completo:</b></label>
                <input type="text" name="nombre" id="nombre" 
                       class="form-control rounded" 
                       value="{{ old('nombre', $deportista->nombre) }}">
              </div>

              <div class="col-md-6 mb-3">
                <label><b>Fecha de Nacimiento:</b></label>
                <input type="date" name="fechanacimiento" class="form-control rounded"
                       value="{{ old('fechanacimiento', $deportista->fechanacimiento) }}">
              </div>

              <div class="col-md-3 mb-3">
                <label><b>Estatura (cm):</b></label>
                <input type="number" name="estatura" class="form-control rounded"
                       value="{{ old('estatura', $deportista->estatura) }}">
              </div>

              <div class="col-md-3 mb-3">
                <label><b>Peso (kg):</b></label>
                <input type="number" name="peso" class="form-control rounded"
                       value="{{ old('peso', $deportista->peso) }}">
              </div>

              <div class="col-md-6 mb-3">
                <label><b>País:</b></label>
                <select name="idpais" class="form-control rounded">
                  @foreach($paises as $pais)
                    <option value="{{ $pais->idpais }}" 
                      {{ $pais->idpais == $deportista->idpais ? 'selected' : '' }}>
                      {{ $pais->nombrepais }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label><b>Disciplina:</b></label>
                <select name="iddisciplina" class="form-control rounded">
                  @foreach($disciplinas as $disc)
                    <option value="{{ $disc->iddisciplina }}"
                      {{ $disc->iddisciplina == $deportista->iddisciplina ? 'selected' : '' }}>
                      {{ $disc->nombredisciplina }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('deportistas.index') }}" class="btn btn-outline-danger me-3 rounded">
                  Cancelar
                </a>

                <button type="submit" class="btn btn-outline-success rounded">
                  Actualizar Deportista
                </button>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</section>

@if ($errors->any())
<script>
Swal.fire({
    title: "Error",
    text: "{{ $errors->first() }}",
    icon: "error",
    confirmButtonText: "Aceptar"
});
</script>
@endif

@endsection
