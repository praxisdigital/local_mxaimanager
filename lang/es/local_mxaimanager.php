<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Spanish strings for the Moxis AI Manager plugin.
 *
 * Only contains the keys introduced by the TTS extension (ticket
 * tiny_courseaiaudio-2). The rest of the plugin was not translated to Spanish
 * prior to this change; that gap is preexisting and out of scope for this ticket.
 *
 * @package local_mxaimanager
 * @copyright Tresipunt
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['default_tts_format'] = 'Formato Text-to-Speech por defecto';
$string['default_tts_model'] = 'Modelo Text-to-Speech por defecto';
$string['default_tts_voice'] = 'Voz Text-to-Speech por defecto';
$string['openai_tts_format'] = 'Formato Text-to-Speech de OpenAI';
$string['openai_tts_format_help'] = 'Formato de contenedor de audio devuelto por OpenAI. <strong>mp3</strong> es la opción más segura para la etiqueta HTML5 audio; también se soportan <strong>opus</strong>, <strong>aac</strong>, <strong>flac</strong>, <strong>wav</strong> y <strong>pcm</strong>.';
$string['elevenlabs_api_key'] = 'Clave API de ElevenLabs';
$string['elevenlabs_api_key_help'] = 'Clave API de la cuenta de ElevenLabs (cabecera <strong>xi-api-key</strong>). Encuentra las claves en https://elevenlabs.io/app/settings/api-keys';
$string['elevenlabs_tts_voice'] = 'ID de voz de ElevenLabs';
$string['elevenlabs_tts_voice_help'] = 'El <strong>voice_id</strong> de ElevenLabs utilizado para text-to-speech y como voz por defecto para los agentes de Conversational AI. Encuentra las voces en https://elevenlabs.io/app/voice-lab';
$string['elevenlabs_tts_model'] = 'Modelo TTS de ElevenLabs';
$string['elevenlabs_tts_model_help'] = 'Identificador del modelo para la síntesis de voz, p. ej. <strong>eleven_multilingual_v2</strong> o <strong>eleven_turbo_v2_5</strong>.';
$string['elevenlabs_tts_format'] = 'Formato de salida TTS de ElevenLabs';
$string['elevenlabs_tts_format_help'] = 'Formato de salida de la API de speech, p. ej. <strong>mp3_44100_128</strong>. Consulta la documentación de ElevenLabs para ver los formatos disponibles.';
$string['openai_tts_model'] = 'Modelo Text-to-Speech de OpenAI';
$string['openai_tts_model_help'] = 'Aquí puedes especificar el modelo TTS (text-to-speech) a utilizar. Por ejemplo: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Consulta la documentación de OpenAI para ver los modelos disponibles.';
$string['openai_tts_voice'] = 'Voz Text-to-Speech de OpenAI';
$string['openai_tts_voice_help'] = 'Voz utilizada para sintetizar el audio. OpenAI soporta actualmente: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
$string['supports_tts'] = 'Soporta Text-to-Speech';
$string['uses_tts'] = 'Text-to-Speech';
