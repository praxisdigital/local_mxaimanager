<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Disse innstillingene gjør det mulig for deg å definere hvilke AI-leverandører (OpenAI, Mistral m.fl.) som er tilgjengelige på nettstedet ditt.</p><p>Du kan også konfigurere:</p><ul><li>Hvilken leverandørinstans som skal brukes som standard.</li><li>Hvilken modell en leverandørinstans skal bruke som standard.</li><li>Hvilken modell og/eller hvilken leverandørinstans som skal brukes for en spesifikk AI-funksjon i AI-pluginen din.</li></ul>";
$string['manage_providers:title'] = 'AI-leverandørinstanser';
$string['manage_providers:table:name'] = "Instansnavn";
$string['manage_providers:table:classname'] = "Leverandørtype";
$string['manage_providers:table:supported_actions'] = "Støttede handlinger";
$string['manage_providers:table:actions'] = "Handlinger";
$string['manage_providers:form:name'] = 'Navn';
$string['manage_providers:form:type'] = 'Type';
$string['manage_providers:add_provider'] = 'Legg til AI-leverandørinstans';
$string['manage_providers:edit_provider'] = 'Rediger AI-leverandørinstans';
$string['manage_providers:delete_provider'] = 'Slett AI-leverandørinstans: "{$a}"';
$string['manage_providers:delete_confirm'] = 'Er du sikker på at du vil slette denne leverandørinstansen? Denne handlingen kan ikke angres.';
$string['here_you_define_providers'] = 'Her definerer du AI-leverandørinstansene som skal være tilgjengelige på nettstedet ditt.';
$string['set_as_default'] = 'Sett som standard?';
$string['in_use'] = 'Allerede i bruk';

// Provider options help texts
$string['openai_chat_model'] = 'OpenAI-chatmodell';
$string['openai_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukes. For eksempel: <strong>gpt-4</strong>, <strong>gpt-3.5-turbo</strong> osv. Se OpenAIs dokumentasjon for tilgjengelige modeller.';
$string['mistral_chat_model'] = 'Mistral-chatmodell';
$string['mistral_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukes. For eksempel: <strong>mistral-large</strong>, <strong>mistral-small</strong> osv. Se Mistrals dokumentasjon for tilgjengelige modeller.';
$string['ollama_chat_model'] = 'Ollama-chatmodell';
$string['ollama_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukes. For eksempel: <strong>llama2</strong>, <strong>vicuna</strong> osv. Se din Ollama-leverandør for tilgjengelige modeller.';
$string['nebius_chat_model'] = 'Nebius-chatmodell';
$string['nebius_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukes. For eksempel: <strong>Qwen/Qwen3-32B-fast</strong>, <strong>Qwen/Qwen3-30B-A3B-Instruct-2507</strong> osv. Se Nebius\' dokumentasjon for tilgjengelige modeller.';
$string['openai_embedding_model'] = 'OpenAI-embeddingmodell';
$string['openai_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukes. For eksempel: <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong> osv. Se OpenAIs dokumentasjon for tilgjengelige embeddingmodeller.';
$string['mistral_embedding_model'] = 'Mistral-embeddingmodell';
$string['mistral_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukes. For eksempel: <strong>mistral-embed</strong> osv. Se Mistrals dokumentasjon for tilgjengelige embeddingmodeller.';
$string['ollama_embedding_model'] = 'Ollama-embeddingmodell';
$string['ollama_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukes. For eksempel: <strong>nomic-embed-text</strong> osv. Se din Ollama-leverandør for tilgjengelige embeddingmodeller.';
$string['nebius_embedding_model'] = 'Nebius-embeddingmodell';
$string['nebius_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukes. For eksempel: <strong>Qwen/Qwen3-Embedding-8B</strong> osv. Se Nebius\' dokumentasjon for tilgjengelige embeddingmodeller.';
$string['openai_image_model'] = 'OpenAI-bildemodell';
$string['openai_image_model_help'] = 'Her kan du angi bildgenereringsmodellen som skal brukes. For eksempel: <strong>dall-e-3</strong>, <strong>dall-e-2</strong> osv. Se OpenAIs dokumentasjon for tilgjengelige bildgenereringsmodeller.';
$string['nebius_image_model'] = 'Nebius-bildemodell';
$string['nebius_image_model_help'] = 'Her kan du angi bildgenereringsmodellen som skal brukes. For eksempel: <strong>black-forest-labs/flux-dev</strong>. Se Nebius\' dokumentasjon for tilgjengelige bildgenereringsmodeller.';
$string['openai_transcription_model'] = 'OpenAI-transkripsjonsmodell';
$string['openai_transcription_model_help'] = 'Her kan du angi transkripsjonsmodellen som skal brukes. For eksempel: <strong>whisper-1</strong>. Se OpenAIs dokumentasjon for tilgjengelige transkripsjonsmodeller.';
$string['mistral_transcription_model'] = 'Mistral-transkripsjonsmodell';
$string['mistral_transcription_model_help'] = 'Her kan du angi transkripsjonsmodellen som skal brukes. For eksempel: <strong>mistral-whisper</strong>. Se Mistrals dokumentasjon for tilgjengelige transkripsjonsmodeller.';
$string['openai_tts_model'] = 'OpenAI tekst-til-tale-modell';
$string['openai_tts_model_help'] = 'Her kan du angi TTS-modellen (tekst-til-tale) som skal brukes. For eksempel: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Se OpenAIs dokumentasjon for tilgjengelige TTS-modeller.';
$string['openai_tts_voice'] = 'OpenAI tekst-til-tale-stemme';
$string['openai_tts_voice_help'] = 'Stemme som brukes til å syntetisere lyden. OpenAI støtter for øyeblikket: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
$string['openai_tts_format'] = 'OpenAI tekst-til-tale-format';
$string['openai_tts_format_help'] = 'Lydcontainerformat returnert av OpenAI. <strong>mp3</strong> er det sikreste valget for HTML5 audio-taggen; <strong>opus</strong>, <strong>aac</strong>, <strong>flac</strong>, <strong>wav</strong> og <strong>pcm</strong> støttes også.';
$string['elevenlabs_api_key'] = 'ElevenLabs API-nøkkel';
$string['elevenlabs_api_key_help'] = 'API-nøkkel fra ElevenLabs-kontoen (header <strong>xi-api-key</strong>). Finn nøkler på https://elevenlabs.io/app/settings/api-keys';
$string['elevenlabs_tts_voice'] = 'ElevenLabs stemme-ID';
$string['elevenlabs_tts_voice_help'] = 'ElevenLabs <strong>voice_id</strong> som brukes til tekst-til-tale og som standardstemme for Conversational AI-agenter. Finn stemmer på https://elevenlabs.io/app/voice-lab';
$string['elevenlabs_tts_model'] = 'ElevenLabs TTS-modell';
$string['elevenlabs_tts_model_help'] = 'Modell-id for talesyntese, f.eks. <strong>eleven_multilingual_v2</strong> eller <strong>eleven_turbo_v2_5</strong>.';
$string['elevenlabs_tts_format'] = 'ElevenLabs TTS-utdataformat';
$string['elevenlabs_tts_format_help'] = 'Utdataformat for speech-API-et, f.eks. <strong>mp3_44100_128</strong>. Se ElevenLabs-dokumentasjonen for tilgjengelige formater.';

// Manage Features
$string['manage_features:title'] = 'AI-funksjoner';
$string['manage_features:table:component'] = 'Komponent';
$string['manage_features:table:name'] = 'Navn';
$string['manage_features:table:description'] = 'Beskrivelse';
$string['manage_features:table:ai_actions'] = 'Påkrevde AI-handlinger';
$string['manage_features:table:actions'] = 'Handlinger';
$string['manage_features:edit_feature_settings'] = 'Rediger AI-funksjonsinnstillinger: "{$a}"';
$string['manage_features:form:provider_id'] = 'Leverandørinstans';
$string['here_you_can_see_all_components_ai_features'] = 'Her kan du se alle komponentenes AI-funksjoner som er tilgjengelige på nettstedet ditt. Du kan overstyre standard leverandørinstans og/eller innstillinger for hver funksjon.';
$string['uses_chat'] = 'Chat';
$string['uses_embedding'] = 'Embeddings';
$string['uses_image'] = 'Bilde';
$string['uses_audio_transcriptions'] = 'Lydtranskripsjoner';
$string['uses_tts'] = 'Tekst-til-tale';

$string['base_url'] = 'Base-URL';
$string['api_key'] = 'API-nøkkel';
$string['default_chat_model'] = 'Standard chatmodell';
$string['default_embedding_model'] = 'Standard embeddingmodell';
$string['default_image_model'] = 'Standard bildemodell';
$string['default_transcription_model'] = 'Standard transkripsjonsmodell';
$string['default_tts_model'] = 'Standard tekst-til-tale-modell';
$string['default_tts_voice'] = 'Standard tekst-til-tale-stemme';
$string['default_tts_format'] = 'Standard tekst-til-tale-format';
$string['provider_settings'] = 'Leverandørinnstillinger';
$string['supports_chat'] = 'Støtter chat';
$string['supports_embedding'] = 'Støtter embedding';
$string['supports_image'] = 'Støtter bilde';
$string['supports_audio_transcriptions'] = 'Støtter lydtranskripsjoner';
$string['supports_tts'] = 'Støtter tekst-til-tale';
$string['provider_supports'] = 'Leverandørkapasiteter';
$string['default_action_providers'] = 'Standard handlingsleverandørinstanser';
$string['here_you_define_default_action_providers'] = 'Her definerer du hvilke leverandørinstanser som skal brukes som standard for hver handling.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Du har konfigurert en leverandørinstans og satt standard leverandørinstans for alle handlinger. Du er nå klar til å bruke AI-funksjoner i AI-pluginene dine! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Du har ennå ikke konfigurert noen AI-leverandørinstanser. Legg til minst én leverandør <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">her</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Du har ennå ikke konfigurert standard leverandørinstanser for alle handlinger. Konfigurer standard leverandørinstanser <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">her</a>.';
$string['no_available_providers'] = 'Ingen tilgjengelige leverandørinstanser';
$string['this_provider_is_preconfigured_no_modify'] = 'Denne leverandørinstansen er forhåndskonfigurert og kan ikke endres.';

// Settings
$string['settings:manage_page'] = 'Administrer AI-innstillinger';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Administrer konfigurasjonen for Moxis AI Manager';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Denne tabellen lagrer logger over bruk av funksjonshandlinger for Moxis AI Manager-pluginen.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'ID';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'ID-en til AI-funksjonen som ble brukt.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'JSON-forespørselen som ble sendt til AI-leverandøren.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'JSON-svaret som ble mottatt fra AI-leverandøren.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'Antall inndatatokener brukt i forespørselen.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'Antall utdatatokener mottatt i svaret.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'Sesjons-ID knyttet til forespørselen.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'ID-en til brukeren som gjorde forespørselen.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'Tidsstempelet da loggoppføringen ble opprettet.';
