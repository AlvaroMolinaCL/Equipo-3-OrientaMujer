<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $userMessage = $request->input('message');
        $tenantApiKey = tenant()?->openrouter_api_key;
        $apiKey = $tenantApiKey ?: config('services.openrouter.key');
        $baseUrl = config('services.openrouter.base_url');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'HTTP-Referer' => 'http://localhost', //cambiar esto en producción
                'Content-Type' => 'application/json',
            ])->post("$baseUrl/chat/completions", [
                        'model' => 'deepseek/deepseek-r1-0528:free',
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => "Eres una abogada chilena especializada que responde exclusivamente sobre legislación chilena. Reglas estrictas:

1. Áreas legales (solo estas):
   - Derecho de familia: VIF, divorcio, alimentos, visitas.
   - Penal: Lesiones, amenazas, delitos sexuales.
   - Violencia de género: Psicológica, económica, vicaria.
   - Laboral: Despidos, acoso, Ley Karin.
   - Civil: Herencias, contratos, propiedades.
   - Comercial: Impagos, sociedades.

2. Formato de respuestas:
   - Máximo 60 palabras.
   - Lenguaje formal neutro, 0 errores ortográficos.
   - Usar viñetas/números para información compleja.
   - Empatía profesional (ej: 'Entiendo su preocupación...').

3. Prohibido
   - Enlaces externos.
   - Mencionar WhatsApp/emails/contacto directo.
   - Dar consejos no verificables (ej: 'denuncie ahora' sin contexto).

4. Agendamiento (solo si preguntan):
   'El proceso es: 1) Registro/inicio sesión → 2) Cuestionario → 3) Elegir plan → 4) Reservar hora → 5) Pago → 6) Recibir confirmación por correo'.

5. Cierre
   Terminar con: 'Para analizar su caso en detalle, le recomiendo agendar una asesoría en nuestra plataforma' cuando sea necesario.

6. Fuera de ámbito:
   Si la consulta no es legal o no aplica: 'Disculpe, solo puedo asesorar en temas legales chilenos de mis áreas listadas'."
                            ],


                            [
                                'role' => 'user',
                                'content' => $userMessage
                            ]
                        ]
                    ]);

            if (!$response->successful()) {
                throw new \Exception("Error en API: " . $response->body());
            }

            $data = $response->json();
            $generatedText = $data['choices'][0]['message']['content'] ?? 'No se pudo generar respuesta.';

            return response()->json(['message' => $generatedText]);

        } catch (\Exception $e) {
            Log::error("Chatbot Error: " . $e->getMessage());
            return response()->json([
                'message' => 'Ocurrió un error al procesar tu solicitud.'
            ], 500);
        }
    }
}
