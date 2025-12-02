<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar Contraseña | Sistema Deportivo</title>

  <link rel="stylesheet" href="{{ asset('spike/src/assets/css/styles.min.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('spike/src/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      background: linear-gradient(135deg, #2196f3, #43a047);
      font-family: 'Montserrat', sans-serif;
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

    h3 {
      color: #1976d2;
      font-weight: bold;
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

    label.error {
      color: #d32f2f;
      font-size: 13px;
      margin-top: 4px;
    }
    input.error {
      border: 1px solid #d32f2f !important;
    }

    .btn-primary {
      background: linear-gradient(90deg, #1976d2, #43a047);
      border: none;
      border-radius: 50px;
      font-weight: bold;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(90deg, #1565c0, #2e7d32);
      box-shadow: 0 4px 12px rgba(25,118,210,0.3);
    }

    .sport-icon {
      color: #1976d2;
    }

    /* Spinner */
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
  </style>
</head>

<body>

<div id="loading-overlay">
    <div class="spinner"></div>
</div>

@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Correcto',
  text: '{{ session("success") }}'
});
$("#loading-overlay").removeClass("d-flex").fadeOut();
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Error',
  text: '{{ session("error") }}'
});
$("#loading-overlay").removeClass("d-flex").fadeOut();
</script>
@endif

<div class="min-vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow-lg p-5" style="width: 500px;">
    <div class="text-center mb-4">
      <h3>Recuperar Contraseña</h3>
      <p class="text-muted">Ingresa tu correo para enviarte un código.</p>
    </div>

    <form id="ForgotForm" method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-bold">Correo</label>
        <input type="email" name="email" class="form-control" placeholder="tuemail@ejemplo.com">
      </div>

      <button class="btn btn-primary w-100 py-2">
        Enviar Código
      </button>

      <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-primary fw-bold">Volver al Login</a>
      </div>
    </form>
  </div>
</div>

<script>
$("#ForgotForm").validate({
  rules: { 
    email: { required: true, email: true }
  },
  messages: {
    email: {
      required: "El correo es obligatorio",
      email: "Formato no válido"
    }
  },
  submitHandler: function(form) {
      $("#loading-overlay").addClass("d-flex").fadeIn();
      form.submit();
  }
});
</script>

</body>
</html>
