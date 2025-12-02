@extends('layout.admin')

@section('content')

<section class="ftco-section d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 p-3 py-5 ftco-animate">
        <div class="bg-light p-4 rounded shadow" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 16px;">
          
          <h2 class="mb-4 text-center text-dark">
            <span class="text-warning me-2"></span> Registrar Nueva Disciplina
          </h2>

          <form action="{{ route('disciplinas.store') }}" id="FormDisciplina" method="post">
            @csrf

            <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label><b>Nombre de la Disciplina:</b></label>
                  <input type="text" name="nombredisciplina" id="nombredisciplina" 
                         class="form-control rounded"
                         placeholder="Ejemplo: Atletismo, Natación, Ciclismo">
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <a href="{{ route('disciplinas.index') }}" class="btn btn-outline-danger me-3 rounded">
                  <i class="fa fa-times"></i> Cancelar
                </a>

                <button type="submit" class="btn btn-outline-success rounded">
                  <i class="fa fa-save"></i> Guardar Disciplina
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
$("#FormDisciplina").validate({
  rules: {
    nombredisciplina: {
      required: true,
      minlength: 2,
      maxlength: 100,
      pattern: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    }
  },
  messages: {
    nombredisciplina: {
      required: "La disciplina es obligatoria",
      minlength: "Debe tener al menos 2 caracteres",
      maxlength: "Máximo 100 caracteres",
      pattern: "Solo se permiten letras y espacios"
    }
  }
});
</script>

@if ($errors->has('nombredisciplina'))
<script>
Swal.fire({
    title: "Error",
    text: "{{ $errors->first('nombredisciplina') }}",
    icon: "error",
    confirmButtonText: "Aceptar"
});
</script>
@endif

@endsection
