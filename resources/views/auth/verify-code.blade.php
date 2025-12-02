<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Validar Código</title>

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
      border-radius: 18px;
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

    .code-inputs {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .code-input {
      width: 45px;
      height: 55px;
      text-align: center;
      font-size: 22px;
      border-radius: 10px;
      border: 1px solid #bbdefb;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .code-input:focus {
      border-color: #43a047;
      box-shadow: 0 0 0 0.2rem rgba(67,160,71,0.25);
      outline: none;
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

    .error {
      color: #d32f2f;
      font-size: 13px;
      margin-top: 4px;
      text-align: center;
    }
  </style>
</head>

<body>

@if(session('error'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Código Incorrecto',
  text: '{{ session("error") }}'
});
</script>
@endif

<div class="min-vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow-lg p-5" style="width: 460px;">
    <div class="text-center mb-4">
      <h3>Validar Código</h3>
      <p class="text-muted">Revisa tu correo e ingresa el código enviado.</p>
    </div>

    <form id="VerifyForm" method="POST" action="{{ route('password.verify.post') }}">
      @csrf

      <input type="hidden" name="email" value="{{ session('email') }}">
      <input type="hidden" name="code" id="hiddenCode" required>

      <div class="mb-3">
        <label class="form-label fw-bold">Código</label>
        <div class="code-inputs">
          <input type="text" maxlength="1" class="code-input" data-index="1" autocomplete="off">
          <input type="text" maxlength="1" class="code-input" data-index="2" autocomplete="off">
          <input type="text" maxlength="1" class="code-input" data-index="3" autocomplete="off">
          <input type="text" maxlength="1" class="code-input" data-index="4" autocomplete="off">
          <input type="text" maxlength="1" class="code-input" data-index="5" autocomplete="off">
          <input type="text" maxlength="1" class="code-input" data-index="6" autocomplete="off">
        </div>
        <div id="code-error" class="error"></div>
      </div>

      <button class="btn btn-primary w-100 py-2">
        Verificar
      </button>
      <div class="text-center mt-3">
        <a href="{{ route('password.resend', ['email' => session('email')]) }}" class="text-primary fw-bold">
            Volver a enviar el código
        </a>
      </div>
    </form>
  </div>
</div>

<script>
  const inputs = document.querySelectorAll(".code-input");
  const hiddenCode = document.getElementById("hiddenCode");

  inputs.forEach((input, index) => {
    input.addEventListener("input", () => {
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
      updateHiddenCode();
    });

    input.addEventListener("keydown", (e) => {
      if (e.key === "Backspace" && input.value === "" && index > 0) {
        inputs[index - 1].focus();
      }
    });
  });

  function updateHiddenCode() {
    let code = "";
    inputs.forEach(input => code += input.value);
    hiddenCode.value = code;
  }

  $("#VerifyForm").validate({
    rules: { code: { required: true, minlength: 6, maxlength: 6 }},
    messages: {
      code: {
        required: "Ingresa el código",
        minlength: "Debe ser de 6 dígitos",
        maxlength: "Debe ser de 6 dígitos"
      }
    },
    errorPlacement: function(error, element) {
      if (element.attr("name") === "code") {
        error.appendTo("#code-error");
      } else {
        error.insertAfter(element);
      }
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

</body>
</html>
