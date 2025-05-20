<form method="POST" action="{{ url('/registro-superadmin/' . $token) }}">
    @csrf
    <p>Email: <strong>{{ $email }}</strong></p>
    <input type="text" name="name" placeholder="Tu nombre" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
    <button type="submit">Crear cuenta</button>
</form>
