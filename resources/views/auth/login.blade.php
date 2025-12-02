<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Sistema Deportivo</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('spike/src/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('spike/src/assets/css/styles.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

  <style>
    body {
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
      padding-right: 40px; /* espacio para el ojito */
    }
    .form-control:focus {
      border-color: #43a047;
      box-shadow: 0 0 0 0.2rem rgba(67,160,71,0.25);
    }

    .password-wrapper {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #1976d2;
    }

    .error {
      color: #d32f2f;
      font-size: 13px;
      margin-top: 4px;
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
  </style>
</head>

<body>
  <div id="loading-overlay">
    <div class="spinner"></div>
  </div>

  <div class="card shadow p-5" style="width: 520px;">
    <div class="card-body">
      <div class="text-center mb-4">
        <h4 class="mt-2">Iniciar Sesión</h4>
        <p class="text-muted">Bienvenido al <span style="color:#43a047;font-weight:bold;">Sistema Deportivo</span></p>
      </div>

      <form id="LoginForm" method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label fw-bold">Correo electrónico</label>
          <input type="email" name="email" class="form-control" placeholder="deportista@ejemplo.com">
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Contraseña</label>
          <div class="password-wrapper">
            <input type="password" name="password" id="password" class="form-control" placeholder="Tu contraseña">
            <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Ingresar al Sistema
        </button>

        <div class="text-center mt-3">
            <a class="text-primary fw-bold" href="{{ route('password.request') }}">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        <div class="text-center mt-4">
            <p class="mb-0">¿No tienes cuenta?
              <a class="text-primary fw-bold" href="{{ route('register') }}">Regístrate aquí</a>
            </p>
        </div>
      </form>
    </div>
  </div>

  <script>
    $("#LoginForm").validate({
      rules: {
        email: { required: true, email: true },
        password: { required: true, minlength: 6 }
      },
      messages: {
        email: { required: "El correo es obligatorio", email: "Ingrese un correo válido" },
        password: { required: "La contraseña es obligatoria", minlength: "Debe tener al menos 6 caracteres" }
      },
      submitHandler: function(form) {
        $("#loading-overlay").addClass("d-flex").fadeIn();
        form.submit();
      }
    });
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  </script>
</body>
</html>
