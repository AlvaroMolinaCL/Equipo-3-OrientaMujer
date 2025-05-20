<form action="{{ url('/solicitar-superadmin') }}" method="POST">
    @csrf

    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <textarea name="reason"></textarea>

    <button type="submit">Enviar</button>
</form>
