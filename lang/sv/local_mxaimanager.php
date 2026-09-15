<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Dessa inställningar gör det möjligt för dig att definiera vilka AI-leverantörer (OpenAI, Mistral m.fl.) som är tillgängliga på din webbplats.</p><p>Du kan också konfigurera:</p><ul><li>Vilken leverantörsinstans som ska användas som standard.</li><li>Vilken modell en leverantörsinstans ska använda som standard.</li><li>Vilken modell och/eller vilken leverantörsinstans som ska användas för en specifik AI-funktion i ditt AI-plugin.</li></ul>";
$string['manage_providers:title'] = 'AI-leverantörsinstanser';
$string['manage_providers:table:name'] = "Instansnamn";
$string['manage_providers:table:classname'] = "Leverantörstyp";
$string['manage_providers:table:supported_actions'] = "Stödda åtgärder";
$string['manage_providers:table:actions'] = "Åtgärder";
$string['manage_providers:form:name'] = 'Namn';
$string['manage_providers:form:type'] = 'Typ';
$string['manage_providers:add_provider'] = 'Lägg till AI-leverantörsinstans';
$string['manage_providers:edit_provider'] = 'Redigera AI-leverantörsinstans';
$string['manage_providers:delete_provider'] = 'Ta bort AI-leverantörsinstans: "{$a}"';
$string['manage_providers:delete_confirm'] = 'Är du säker på att du vill ta bort den här leverantörsinstansen? Den här åtgärden kan inte ångras.';
$string['here_you_define_providers'] = 'Här definierar du de AI-leverantörsinstanser som ska vara tillgängliga på din webbplats.';
$string['set_as_default'] = 'Ange som standard?';
$string['in_use'] = 'Redan i bruk';

// Provider options help texts
$string['openai_chat_model'] = 'OpenAI-chatmodell';
$string['openai_chat_model_help'] = 'Här kan du ange vilken chatmodell som ska användas. Till exempel: <strong>gpt-4</strong>, <strong>gpt-3.5-turbo</strong> osv. Se OpenAIs dokumentation för tillgängliga modeller.';
$string['mistral_chat_model'] = 'Mistral-chatmodell';
$string['mistral_chat_model_help'] = 'Här kan du ange vilken chatmodell som ska användas. Till exempel: <strong>mistral-large</strong>, <strong>mistral-small</strong> osv. Se Mistrals dokumentation för tillgängliga modeller.';
$string['ollama_chat_model'] = 'Ollama-chatmodell';
$string['ollama_chat_model_help'] = 'Här kan du ange vilken chatmodell som ska användas. Till exempel: <strong>llama2</strong>, <strong>vicuna</strong> osv. Se din Ollama-leverantör för tillgängliga modeller.';
$string['nebius_chat_model'] = 'Nebius-chatmodell';
$string['nebius_chat_model_help'] = 'Här kan du ange vilken chatmodell som ska användas. Till exempel: <strong>Qwen/Qwen3-32B-fast</strong>, <strong>Qwen/Qwen3-30B-A3B-Instruct-2507</strong> osv. Se Nebius dokumentation för tillgängliga modeller.';
$string['openai_embedding_model'] = 'OpenAI-embeddingmodell';
$string['openai_embedding_model_help'] = 'Här kan du ange vilken embeddingmodell som ska användas. Till exempel: <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong> osv. Se OpenAIs dokumentation för tillgängliga embeddingmodeller.';
$string['mistral_embedding_model'] = 'Mistral-embeddingmodell';
$string['mistral_embedding_model_help'] = 'Här kan du ange vilken embeddingmodell som ska användas. Till exempel: <strong>mistral-embed</strong> osv. Se Mistrals dokumentation för tillgängliga embeddingmodeller.';
$string['ollama_embedding_model'] = 'Ollama-embeddingmodell';
$string['ollama_embedding_model_help'] = 'Här kan du ange vilken embeddingmodell som ska användas. Till exempel: <strong>nomic-embed-text</strong> osv. Se din Ollama-leverantör för tillgängliga embeddingmodeller.';
$string['nebius_embedding_model'] = 'Nebius-embeddingmodell';
$string['nebius_embedding_model_help'] = 'Här kan du ange vilken embeddingmodell som ska användas. Till exempel: <strong>Qwen/Qwen3-Embedding-8B</strong> osv. Se Nebius dokumentation för tillgängliga embeddingmodeller.';
$string['openai_image_model'] = 'OpenAI-bildmodell';
$string['openai_image_model_help'] = 'Här kan du ange vilken bildgenereringsmodell som ska användas. Till exempel: <strong>dall-e-3</strong>, <strong>dall-e-2</strong> osv. Se OpenAIs dokumentation för tillgängliga bildgenereringsmodeller.';
$string['nebius_image_model'] = 'Nebius-bildmodell';
$string['nebius_image_model_help'] = 'Här kan du ange vilken bildgenereringsmodell som ska användas. Till exempel: <strong>black-forest-labs/flux-dev</strong>. Se Nebius dokumentation för tillgängliga bildgenereringsmodeller.';
$string['openai_transcription_model'] = 'OpenAI-transkriptionsmodell';
$string['openai_transcription_model_help'] = 'Här kan du ange vilken transkriptionsmodell som ska användas. Till exempel: <strong>whisper-1</strong>. Se OpenAIs dokumentation för tillgängliga transkriptionsmodeller.';
$string['mistral_transcription_model'] = 'Mistral-transkriptionsmodell';
$string['mistral_transcription_model_help'] = 'Här kan du ange vilken transkriptionsmodell som ska användas. Till exempel: <strong>mistral-whisper</strong>. Se Mistrals dokumentation för tillgängliga transkriptionsmodeller.';
$string['openai_tts_model'] = 'OpenAI text-till-tal-modell';
$string['openai_tts_model_help'] = 'Här kan du ange vilken TTS-modell (text-till-tal) som ska användas. Till exempel: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Se OpenAIs dokumentation för tillgängliga TTS-modeller.';
$string['openai_tts_voice'] = 'OpenAI text-till-tal-röst';
$string['openai_tts_voice_help'] = 'Röst som används för att syntetisera ljudet. OpenAI stöder för närvarande: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
$string['openai_tts_format'] = 'OpenAI text-till-tal-format';
$string['openai_tts_format_help'] = 'Ljudcontainerformat som returneras av OpenAI. <strong>mp3</strong> är det säkraste valet för HTML5 audio-taggen; <strong>opus</strong>, <strong>aac</strong>, <strong>flac</strong>, <strong>wav</strong> och <strong>pcm</strong> stöds också.';
$string['elevenlabs_api_key'] = 'ElevenLabs API-nyckel';
$string['elevenlabs_api_key_help'] = 'API-nyckel från ElevenLabs-kontot (header <strong>xi-api-key</strong>). Hitta nycklar på https://elevenlabs.io/app/settings/api-keys';
$string['elevenlabs_tts_voice'] = 'ElevenLabs röst-ID';
$string['elevenlabs_tts_voice_help'] = 'ElevenLabs <strong>voice_id</strong> som används för text-till-tal och som standardröst för Conversational AI-agenter. Hitta röster på https://elevenlabs.io/app/voice-lab';
$string['elevenlabs_tts_model'] = 'ElevenLabs TTS-modell';
$string['elevenlabs_tts_model_help'] = 'Modell-id för talsyntes, t.ex. <strong>eleven_multilingual_v2</strong> eller <strong>eleven_turbo_v2_5</strong>.';
$string['elevenlabs_tts_format'] = 'ElevenLabs TTS-utdataformat';
$string['elevenlabs_tts_format_help'] = 'Utdataformat för speech-API:t, t.ex. <strong>mp3_44100_128</strong>. Se ElevenLabs dokumentation för tillgängliga format.';

// Manage Features
$string['manage_features:title'] = 'AI-funktioner';
$string['manage_features:table:component'] = 'Komponent';
$string['manage_features:table:name'] = 'Namn';
$string['manage_features:table:description'] = 'Beskrivning';
$string['manage_features:table:ai_actions'] = 'Nödvändiga AI-åtgärder';
$string['manage_features:table:actions'] = 'Åtgärder';
$string['manage_features:edit_feature_settings'] = 'Redigera AI-funktionsinställningar: "{$a}"';
$string['manage_features:form:provider_id'] = 'Leverantörsinstans';
$string['here_you_can_see_all_components_ai_features'] = 'Här kan du se alla komponenters AI-funktioner som är tillgängliga på din webbplats. Du kan åsidosätta standardleverantörsinstansen och/eller inställningarna för varje funktion.';
$string['uses_chat'] = 'Chatt';
$string['uses_embedding'] = 'Embeddings';
$string['uses_image'] = 'Bild';
$string['uses_audio_transcriptions'] = 'Ljudtranskriptioner';
$string['uses_tts'] = 'Text-till-tal';

$string['base_url'] = 'Bas-URL';
$string['api_key'] = 'API-nyckel';
$string['default_chat_model'] = 'Standardchatmodell';
$string['default_embedding_model'] = 'Standardembeddingmodell';
$string['default_image_model'] = 'Standardbildmodell';
$string['default_transcription_model'] = 'Standardtranskriptionsmodell';
$string['default_tts_model'] = 'Standard text-till-tal-modell';
$string['default_tts_voice'] = 'Standard text-till-tal-röst';
$string['default_tts_format'] = 'Standard text-till-tal-format';
$string['provider_settings'] = 'Leverantörsinställningar';
$string['supports_chat'] = 'Stöder chatt';
$string['supports_embedding'] = 'Stöder embedding';
$string['supports_image'] = 'Stöder bild';
$string['supports_audio_transcriptions'] = 'Stöder ljudtranskriptioner';
$string['supports_tts'] = 'Stöder text-till-tal';
$string['provider_supports'] = 'Leverantörskapaciteter';
$string['default_action_providers'] = 'Standardåtgärdsleverantörsinstanser';
$string['here_you_define_default_action_providers'] = 'Här definierar du vilka leverantörsinstanser som ska användas som standard för varje åtgärd.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Du har konfigurerat en leverantörsinstans och angett standardleverantörsinstansen för alla åtgärder. Du är nu redo att använda AI-funktioner i dina AI-plugins! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Du har ännu inte konfigurerat några AI-leverantörsinstanser. Lägg till minst en leverantör <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">här</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Du har ännu inte konfigurerat standardleverantörsinstanser för alla åtgärder. Konfigurera standardleverantörsinstanser <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">här</a>.';
$string['no_available_providers'] = 'Inga tillgängliga leverantörsinstanser';
$string['this_provider_is_preconfigured_no_modify'] = 'Denna leverantörsinstans är förkonfigurerad och kan inte ändras.';

// Settings
$string['settings:manage_page'] = 'Hantera AI-inställningar';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Hantera konfigurationen för Moxis AI Manager';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Denna tabell lagrar loggar över användning av funktionsåtgärder för tillägget Moxis AI Manager.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'ID';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'ID för den AI-funktion som användes.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'JSON-förfrågan som skickades till AI-leverantören.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'JSON-svar som mottogs från AI-leverantören.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'Antalet indatatokens som användes i förfrågan.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'Antalet utdatatokens som mottogs i svaret.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'Sessions-ID som är kopplat till förfrågan.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'ID för användaren som gjorde förfrågan.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'Tidsstämpeln när loggposten skapades.';
