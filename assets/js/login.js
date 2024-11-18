const passwordField = document.getElementById('contrasena');
const togglePassword = document.getElementById('togglePassword');
const icon = togglePassword.querySelector('i');

togglePassword.addEventListener('click', function () {
    // Cambiar entre 'text' y 'password' para mostrar/ocultar la contraseña
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Cambiar el ícono dependiendo del estado
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
});