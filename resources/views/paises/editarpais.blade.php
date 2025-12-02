@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5 ftco-animate">
        <div class="bg-light p-4 rounded shadow" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 16px;">
          
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning me-2"></span> Editar País
          </h2>

          <form action="{{ route('paises.update', $pais->idpais) }}" id="FormPais" method="post">
            @csrf
            @method('PUT')

            <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Nombre del País:</b></label>
                  <input type="text" name="nombrepais" id="nombrepais"
                         value="{{ old('nombrepais', $pais->nombrepais) }}"
                         class="form-control rounded"
                         placeholder="Ejemplo: Ecuador, Perú, Colombia">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('paises.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>

                <button type="submit" class="btn btn-outline-success rounded">
                  <i class="fa fa-save"></i> Actualizar País
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
$("#FormPais").validate({
  rules: {
    nombrepais: {
      required: true,
      minlength: 2,
      maxlength: 100,
      pattern: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    }
  },
  messages: {
    nombrepais: {
      required: "El nombre del país es obligatorio",
      minlength: "Debe tener al menos 2 caracteres",
      maxlength: "Máximo 100 caracteres",
      pattern: "Solo se permiten letras y espacios"
    }
  }
});
</script>


@if ($errors->has('nombrepais'))
<script>
Swal.fire({
    title: "Error",
    text: "{{ $errors->first('nombrepais') }}",
    icon: "error",
    confirmButtonText: "Aceptar"
});
</script>
@endif

@endsection
