<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireSeeder extends Seeder
{
    public function run()
    {
        // Limpia tablas
        DB::table('questionnaire_questions')->delete();
        DB::table('questionnaire_sections')->delete();

        // Secciones
        $sections = [
            [
                'title' => 'Tu situación actual',
                'icon' => 'bi-exclamation-circle',
                'order' => 1,
            ],
            [
                'title' => 'Información legal',
                'icon' => 'bi-file-earmark-text',
                'order' => 2,
            ],
            [
                'title' => 'Contexto de tu situación',
                'icon' => 'bi-chat-square-text',
                'order' => 3,
            ],
        ];

        $sectionIds = [];
        foreach ($sections as $section) {
            $sectionIds[] = DB::table('questionnaire_sections')->insertGetId($section);
        }

        // Preguntas
        $questions = [
            // Sección 1
            [
                'section_id' => $sectionIds[0],
                'question' => '¿Te encuentras actualmente en una situación de riesgo o peligro?',
                'type' => 'radio',
                'options' => json_encode([
                    'riesgo_seguridad' => 'Sí, temo por mi seguridad o la de mis hijos/as.',
                    'compleja' => 'No, pero la situación es compleja o tensa.',
                    'urgente' => 'No, pero necesito orientación urgente.',
                    'no_segura' => 'No estoy segura / Prefiero comentarlo en la sesión.',
                ]),
                'is_required' => true,
                'name' => 'q1',
                'order' => 1,
                'help_text' => '<strong>Importante:</strong> Si estás en una situación de riesgo, acude a hacer una denuncia cuanto antes a Carabineros, Policía de Investigaciones, Fiscalía o Tribunales de Familia, señalando que necesitas protección y por qué.',
            ],
            [
                'section_id' => $sectionIds[0],
                'question' => '¿Qué tan pronto necesitas la asesoría?',
                'type' => 'radio',
                'options' => json_encode([
                    'lo_antes_posible' => 'Lo antes posible.',
                    'esta_semana' => 'Esta semana.',
                    'proxima_semana' => 'La próxima semana.',
                    'este_mes' => 'Dentro de este mes.',
                ]),
                'is_required' => true,
                'name' => 'q2',
                'order' => 2,
            ],

            // Sección 2
            [
                'section_id' => $sectionIds[1],
                'question' => '¿Tienes actualmente una causa judicial en curso?',
                'type' => 'radio',
                'options' => json_encode([
                    'si_orientacion' => 'Sí, y necesito orientación específica.',
                    'no_quiero_iniciar' => 'No, pero quiero iniciar una acción legal.',
                    'no_segura' => 'No estoy segura.',
                    'no_aplica' => 'No aplica a mi caso.',
                ]),
                'is_required' => true,
                'name' => 'q3',
                'order' => 3,
            ],
            [
                'section_id' => $sectionIds[1],
                'question' => '¿Cuál es la materia principal de tu consulta?',
                'type' => 'radio',
                'options' => json_encode([
                    'familia' => 'Derecho de familia (VIF, alimentos, visitas, divorcio, etc.)',
                    'penal' => 'Derecho penal (lesiones, amenazas, delitos sexuales, etc.)',
                    'genero' => 'Violencia de género (psicológica, económica, vicaria, etc.)',
                    'laboral' => 'Derecho laboral (acoso, despido, ley Karin, etc.)',
                    'civil' => 'Derecho civil (herencias, contratos, propiedades, etc.)',
                    'comercial' => 'Derecho comercial.',
                    'no_se' => 'No lo sé, necesito orientación desde cero.',
                ]),
                'is_required' => true,
                'name' => 'q4',
                'order' => 4,
            ],
            [
                'section_id' => $sectionIds[1],
                'question' => 'Si sabes el trámite o procedimiento que necesitas, indícalo:',
                'type' => 'text',
                'options' => null,
                'is_required' => false,
                'name' => 'q5',
                'order' => 5,
                'placeholder' => 'Ej: Demanda por VIF, Ley Karin, etc.',
            ],

            // Sección 3
            [
                'section_id' => $sectionIds[2],
                'question' => '¿La situación que te afecta ocurre actualmente?',
                'type' => 'radio',
                'options' => json_encode([
                    'actual' => 'Sí, está ocurriendo ahora.',
                    'reciente' => 'Ocurrió recientemente (últimos 6 meses).',
                    'mas_6_meses' => 'Hace más de 6 meses.',
                    'solo_info' => 'Solo quiero información general.',
                ]),
                'is_required' => true,
                'name' => 'q6',
                'order' => 6,
            ],
            [
                'section_id' => $sectionIds[2],
                'question' => '¿Has recibido asesoría legal anteriormente por esta situación?',
                'type' => 'radio',
                'options' => json_encode([
                    'si_cual' => 'Sí, con otra abogada o institución.',
                    'no_primera' => 'No, esta es mi primera vez.',
                    'busque_info' => 'Solo he buscado información por mi cuenta.',
                ]),
                'is_required' => true,
                'name' => 'q7',
                'order' => 7,
            ],
            [
                'section_id' => $sectionIds[2],
                'question' => '¿Cuál institución o profesional? (opcional)',
                'type' => 'text',
                'options' => null,
                'is_required' => false,
                'name' => 'q7_detail',
                'order' => 8,
                'placeholder' => '¿Cuál institución o profesional?',
            ],
            [
                'section_id' => $sectionIds[2],
                'question' => '¿Qué tipo de asesoría prefieres?',
                'type' => 'radio',
                'options' => json_encode([
                    'informativa' => 'Informativa (conocer mis derechos y opciones).',
                    'especifica' => 'Específica (actuar legalmente).',
                    'acompanamiento' => 'Acompañamiento y seguimiento del proceso.',
                    'no_se' => 'No lo sé / necesito orientación para decidir.',
                ]),
                'is_required' => true,
                'name' => 'q8',
                'order' => 9,
            ],
        ];

        foreach ($questions as $q) {
            DB::table('questionnaire_questions')->insert($q);
        }
    }
}
