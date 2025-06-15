<!DOCTYPE html>
<html>

<head>
    <title>Redireccionando a Webpay...</title>
</head>

<body>
    <form id="webpayForm" action="{{ $url }}" method="POST">
        <input type="hidden" name="token_ws" value="{{ $token }}">
    </form>
    <script>
        // Forzar envío por POST
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('webpayForm').submit();
        });
    </script>
</body>

</html>