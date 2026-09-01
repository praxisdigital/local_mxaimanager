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
 * Catalan strings for the Moxis AI Manager plugin.
 *
 * Only contains the keys introduced by the TTS extension (ticket
 * tiny_courseaiaudio-2). The rest of the plugin was not translated to Catalan
 * prior to this change; that gap is preexisting and out of scope for this ticket.
 *
 * @package local_mxaimanager
 * @copyright Tresipunt
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['default_tts_format'] = 'Format Text-to-Speech per defecte';
$string['default_tts_model'] = 'Model Text-to-Speech per defecte';
$string['default_tts_voice'] = 'Veu Text-to-Speech per defecte';
$string['openai_tts_format'] = 'Format Text-to-Speech d\'OpenAI';
$string['openai_tts_format_help'] = 'Format de contenidor d\'àudio retornat per OpenAI. <strong>mp3</strong> és l\'opció més segura per a l\'etiqueta HTML5 audio; també es suporten <strong>opus</strong>, <strong>aac</strong>, <strong>flac</strong>, <strong>wav</strong> i <strong>pcm</strong>.';
$string['elevenlabs_api_key'] = 'Clau API d\'ElevenLabs';
$string['elevenlabs_api_key_help'] = 'Clau API del compte d\'ElevenLabs (capçalera <strong>xi-api-key</strong>). Troba les claus a https://elevenlabs.io/app/settings/api-keys';
$string['elevenlabs_tts_voice'] = 'ID de veu d\'ElevenLabs';
$string['elevenlabs_tts_voice_help'] = 'L\'<strong>voice_id</strong> d\'ElevenLabs utilitzat per a text-to-speech i com a veu per defecte per als agents de Conversational AI. Troba les veus a https://elevenlabs.io/app/voice-lab';
$string['elevenlabs_tts_model'] = 'Model TTS d\'ElevenLabs';
$string['elevenlabs_tts_model_help'] = 'Identificador del model per a la síntesi de veu, p. ex. <strong>eleven_multilingual_v2</strong> o <strong>eleven_turbo_v2_5</strong>.';
$string['elevenlabs_tts_format'] = 'Format de sortida TTS d\'ElevenLabs';
$string['elevenlabs_tts_format_help'] = 'Format de sortida de l\'API de speech, p. ex. <strong>mp3_44100_128</strong>. Consulta la documentació d\'ElevenLabs per veure els formats disponibles.';
$string['openai_tts_model'] = 'Model Text-to-Speech d\'OpenAI';
$string['openai_tts_model_help'] = 'Aquí pots especificar el model TTS (text-to-speech) que s\'ha d\'utilitzar. Per exemple: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Consulta la documentació d\'OpenAI per veure els models disponibles.';
$string['openai_tts_voice'] = 'Veu Text-to-Speech d\'OpenAI';
$string['openai_tts_voice_help'] = 'Veu utilitzada per sintetitzar l\'àudio. OpenAI suporta actualment: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
$string['supports_tts'] = 'Suporta Text-to-Speech';
$string['uses_tts'] = 'Text-to-Speech';
