@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" 
         style="min-height: 100vh; background-color: #f8f9fa;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5">
        <div class="bg-light p-4 rounded shadow">

          <h2 class="mb-4 text-center text-dark">
            Registrar Nuevo Deportista
          </h2>

          <form action="{{ route('deportistas.store') }}" id="FormDeportista" method="post">
            @csrf

            <div class="row">

              <div class="col-md-12 mb-3">
                <label><b>Nombre Completo:</b></label>
                <input type="text" name="nombre" id="nombre" 
                       class="form-control rounded" 
                       placeholder="Ejemplo: Lionel Messi"
                       value="{{ old('nombre') }}">
              </div>

              <div class="col-md-6 mb-3">
                <label><b>Fecha de Nacimiento:</b></label>
                <input type="date" name="fechanacimiento" class="form-control rounded"
                       value="{{ old('fechanacimiento') }}">
              </div>

              <div class="col-md-3 mb-3">
                <label><b>Estatura (cm):</b></label>
                <input type="number" name="estatura" class="form-control rounded"
                       value="{{ old('estatura') }}">
              </div>

              <div class="col-md-3 mb-3">
                <label><b>Peso (kg):</b></label>
                <input type="number" name="peso" class="form-control rounded"
                       value="{{ old('peso') }}">
              </div>

              <div class="col-md-6 mb-3">
                <label><b>País:</b></label>
                <select name="idpais" class="form-control rounded">
                  <option value="">Seleccione un país</option>
                  @foreach($paises as $pais)
                    <option value="{{ $pais->idpais }}">
                      {{ $pais->nombrepais }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label><b>Disciplina:</b></label>
                <select name="iddisciplina" class="form-control rounded">
                  <option value="">Seleccione una disciplina</option>
                  @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina->iddisciplina }}">
                      {{ $disciplina->nombredisciplina }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('deportistas.index') }}" class="btn btn-outline-danger me-3 rounded">
                  Cancelar
                </a>

                <button type="submit" class="btn btn-outline-success rounded">
                  Guardar Deportista
                </button>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</section>

<style>
.btn:hover {
    transform: scale(1.03);
}
</style>

<script>
$("#FormDeportista").validate({
  rules: {
    nombre: {
      required: true,
      minlength: 3,
      maxlength: 150,
      pattern: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    },
    fechanacimiento: "required",
    estatura: { required: true, number: true, min: 50, max: 300 },
    peso: { required: true, number: true, min: 20, max: 300 },
    idpais: { required: true },
    iddisciplina: { required: true }
  },

  messages: {
    nombre: {
      required: "El nombre es obligatorio",
      minlength: "Debe tener al menos 3 caracteres",
      pattern: "Solo letras y espacios"
    }
  }
});
</script>

@if ($errors->has('nombre'))
<script>
Swal.fire({
    title: "Error",
    text: "{{ $errors->first('nombre') }}",
    icon: "error",
    confirmButtonText: "Aceptar"
});
</script>
@endif

@endsection
