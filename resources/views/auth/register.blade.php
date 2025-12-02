<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro | Sistema Deportivo</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('spike/src/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('spike/src/assets/css/styles.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

  <style>
    body {
      /* Fondo deportivo consistente con las demás pantallas */
      background: linear-gradient(135deg, #2196f3, #43a047);
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h4 {
      color: #1976d2;
      font-weight: bold;
    }

    .btn-primary {
      background: linear-gradient(90deg, #1976d2, #43a047);
      border: none;
      font-weight: bold;
      border-radius: 50px;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(90deg, #1565c0, #2e7d32);
      box-shadow: 0 4px 12px rgba(25,118,210,0.3);
    }

    .form-control {
      border-radius: 12px;
      border: 1px solid #bbdefb;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control:focus {
      border-color: #43a047;
      box-shadow: 0 0 0 0.2rem rgba(67,160,71,0.25);
    }

    .error {
      color: #d32f2f;
      font-size: 14px;
    }
    .form-control.error {
      border: 1px solid #d32f2f;
    }

    #loading-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.3);
      z-index: 9999;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    #loading-overlay.d-flex {
      display: flex;
      opacity: 1;
    }

    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #1976d2;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .sport-icon {
      color: #1976d2;
    }
  </style>
</head>

<body>
  <div id="loading-overlay">
    <div class="spinner"></div>
  </div>

  <div class="card shadow p-5" style="width: 540px;">
    <div class="card-body">
      <div class="text-center mb-4">
        <i class="fas fa-medal fa-3x mb-3 sport-icon"></i>
        <h4 class="mt-2 fw-bold text-dark">Registro Deportivo</h4>
        <p class="text-muted">Únete a nuestro sistema deportivo</p>
      </div>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        <script>
          $(document).ready(function() {
            $("#loading-overlay").removeClass("d-flex").fadeOut();
          });
        </script>
      @endif

      <form id="RegisterForm" method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label fw-bold">Nombre completo</label>
          <input type="text" name="name" class="form-control" placeholder="Tu nombre completo">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Correo electrónico</label>
          <input type="email" name="email" class="form-control" placeholder="deportista@ejemplo.com">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Contraseña</label>
          <input type="password" name="password" class="form-control" placeholder="Mínimo 6 caracteres">
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Confirmar contraseña</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Repite tu contraseña">
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
          <i class="fa-solid fa-user-plus me-2"></i>Registrarse
        </button>

        <div class="text-center">
          <p class="mb-0">¿Ya tienes cuenta?
            <a class="text-primary fw-bold" href="{{ route('login') }}">Inicia sesión</a>
          </p>
        </div>
      </form>
    </div>
  </div>

  <script>
    $.validator.addMethod("soloLetras", function(value, element) {
      return this.optional(element) || /^[a-zA-ZÀ-ÿ\s]+$/.test(value);
    }, "Solo se permiten letras y espacios");

    $("#RegisterForm").validate({
      rules: {
        name: { required: true, minlength: 3, maxlength: 25, soloLetras: true },
        email: { required: true, email: true },
        password: { required: true, minlength: 6 },
        password_confirmation: { required: true, equalTo: "[name='password']" }
      },
      messages: {
        name: {
          required: "El nombre es obligatorio",
          minlength: "Debe tener al menos 3 caracteres",
          maxlength: "No más de 25 caracteres",
          soloLetras: "Solo se permiten letras y espacios"
        },
        email: { required: "El correo es obligatorio", email: "Ingrese un correo válido" },
        password: { required: "La contraseña es obligatoria", minlength: "Debe tener al menos 6 caracteres" },
        password_confirmation: { required: "Debe confirmar la contraseña", equalTo: "Las contraseñas no coinciden" }
      },
      submitHandler: function(form) {
        $("#loading-overlay").addClass("d-flex").fadeIn();
        form.submit();
      }
    });
  </script>
</body>
</html>
