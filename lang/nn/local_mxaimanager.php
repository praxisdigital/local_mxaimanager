<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Desse innstillingane gjer det mogleg for deg å definere kva AI-leverandørar (OpenAI, Mistral m.fl.) som er tilgjengelege på nettstaden din.</p><p>Du kan også konfigurere:</p><ul><li>Kva leverandørinstans som skal brukast som standard.</li><li>Kva modell ein leverandørinstans skal bruke som standard.</li><li>Kva modell og/eller kva leverandørinstans som skal brukast for ein spesifikk AI-funksjon i AI-tillegget ditt.</li></ul>";
$string['manage_providers:title'] = 'AI-leverandørinstansar';
$string['manage_providers:table:name'] = "Instansnamn";
$string['manage_providers:table:classname'] = "Leverandørtype";
$string['manage_providers:table:supported_actions'] = "Støtta handlingar";
$string['manage_providers:table:actions'] = "Handlingar";
$string['manage_providers:form:name'] = 'Namn';
$string['manage_providers:form:type'] = 'Type';
$string['manage_providers:add_provider'] = 'Legg til AI-leverandørinstans';
$string['manage_providers:edit_provider'] = 'Rediger AI-leverandørinstans';
$string['manage_providers:delete_provider'] = 'Slett AI-leverandørinstans: "{$a}"';
$string['manage_providers:delete_confirm'] = 'Er du sikker på at du vil slette denne leverandørinstansen? Denne handlinga kan ikkje angrast.';
$string['here_you_define_providers'] = 'Her definerer du AI-leverandørinstansane som skal vere tilgjengelege på nettstaden din.';
$string['set_as_default'] = 'Set som standard?';
$string['in_use'] = 'Allereie i bruk';

// Provider options help texts
$string['openai_chat_model'] = 'OpenAI-chatmodell';
$string['openai_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukast. Til dømes: <strong>gpt-4</strong>, <strong>gpt-3.5-turbo</strong> osb. Sjå dokumentasjonen til OpenAI for tilgjengelege modellar.';
$string['mistral_chat_model'] = 'Mistral-chatmodell';
$string['mistral_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukast. Til dømes: <strong>mistral-large</strong>, <strong>mistral-small</strong> osb. Sjå dokumentasjonen til Mistral for tilgjengelege modellar.';
$string['ollama_chat_model'] = 'Ollama-chatmodell';
$string['ollama_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukast. Til dømes: <strong>llama2</strong>, <strong>vicuna</strong> osb. Sjå Ollama-leverandøren din for tilgjengelege modellar.';
$string['nebius_chat_model'] = 'Nebius-chatmodell';
$string['nebius_chat_model_help'] = 'Her kan du angi chatmodellen som skal brukast. Til dømes: <strong>Qwen/Qwen3-32B-fast</strong>, <strong>Qwen/Qwen3-30B-A3B-Instruct-2507</strong> osb. Sjå dokumentasjonen til Nebius for tilgjengelege modellar.';
$string['openai_embedding_model'] = 'OpenAI-embeddingmodell';
$string['openai_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukast. Til dømes: <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong> osb. Sjå dokumentasjonen til OpenAI for tilgjengelege embeddingmodellar.';
$string['mistral_embedding_model'] = 'Mistral-embeddingmodell';
$string['mistral_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukast. Til dømes: <strong>mistral-embed</strong> osb. Sjå dokumentasjonen til Mistral for tilgjengelege embeddingmodellar.';
$string['ollama_embedding_model'] = 'Ollama-embeddingmodell';
$string['ollama_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukast. Til dømes: <strong>nomic-embed-text</strong> osb. Sjå Ollama-leverandøren din for tilgjengelege embeddingmodellar.';
$string['nebius_embedding_model'] = 'Nebius-embeddingmodell';
$string['nebius_embedding_model_help'] = 'Her kan du angi embeddingmodellen som skal brukast. Til dømes: <strong>Qwen/Qwen3-Embedding-8B</strong> osb. Sjå dokumentasjonen til Nebius for tilgjengelege embeddingmodellar.';
$string['openai_image_model'] = 'OpenAI-biletemodell';
$string['openai_image_model_help'] = 'Her kan du angi biletegenereringsmodellen som skal brukast. Til dømes: <strong>dall-e-3</strong>, <strong>dall-e-2</strong> osb. Sjå dokumentasjonen til OpenAI for tilgjengelege biletegenereringsmodellar.';
$string['nebius_image_model'] = 'Nebius-biletemodell';
$string['nebius_image_model_help'] = 'Her kan du angi biletegenereringsmodellen som skal brukast. Til dømes: <strong>black-forest-labs/flux-dev</strong>. Sjå dokumentasjonen til Nebius for tilgjengelege biletegenereringsmodellar.';
$string['openai_transcription_model'] = 'OpenAI-transkripsjonsmodell';
$string['openai_transcription_model_help'] = 'Her kan du angi transkripsjonsmodellen som skal brukast. Til dømes: <strong>whisper-1</strong>. Sjå dokumentasjonen til OpenAI for tilgjengelege transkripsjonsmodellar.';
$string['mistral_transcription_model'] = 'Mistral-transkripsjonsmodell';
$string['mistral_transcription_model_help'] = 'Her kan du angi transkripsjonsmodellen som skal brukast. Til dømes: <strong>mistral-whisper</strong>. Sjå dokumentasjonen til Mistral for tilgjengelege transkripsjonsmodellar.';
$string['openai_tts_model'] = 'OpenAI tekst-til-tale-modell';
$string['openai_tts_model_help'] = 'Her kan du angi TTS-modellen (tekst-til-tale) som skal brukast. Til dømes: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Sjå dokumentasjonen til OpenAI for tilgjengelege TTS-modellar.';
$string['openai_tts_voice'] = 'OpenAI tekst-til-tale-stemme';
$string['openai_tts_voice_help'] = 'Stemme som blir brukt til å syntetisere lyden. OpenAI støttar for tida: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
$string['openai_tts_format'] = 'OpenAI tekst-til-tale-format';
$string['openai_tts_format_help'] = 'Lydcontainerformat returnert av OpenAI. <strong>mp3</strong> er det sikreaste valet for HTML5 audio-taggen; <strong>opus</strong>, <strong>aac</strong>, <strong>flac</strong>, <strong>wav</strong> og <strong>pcm</strong> er òg støtta.';
$string['elevenlabs_api_key'] = 'ElevenLabs API-nøkkel';
$string['elevenlabs_api_key_help'] = 'API-nøkkel frå ElevenLabs-kontoen (header <strong>xi-api-key</strong>). Finn nøklar på https://elevenlabs.io/app/settings/api-keys';
$string['elevenlabs_tts_voice'] = 'ElevenLabs stemme-ID';
$string['elevenlabs_tts_voice_help'] = 'ElevenLabs <strong>voice_id</strong> som blir brukt til tekst-til-tale og som standardstemme for Conversational AI-agentar. Finn stemmer på https://elevenlabs.io/app/voice-lab';
$string['elevenlabs_tts_model'] = 'ElevenLabs TTS-modell';
$string['elevenlabs_tts_model_help'] = 'Modell-id for talesyntese, t.d. <strong>eleven_multilingual_v2</strong> eller <strong>eleven_turbo_v2_5</strong>.';
$string['elevenlabs_tts_format'] = 'ElevenLabs TTS-utdataformat';
$string['elevenlabs_tts_format_help'] = 'Utdataformat for speech-API-et, t.d. <strong>mp3_44100_128</strong>. Sjå dokumentasjonen til ElevenLabs for tilgjengelege format.';

// Manage Features
$string['manage_features:title'] = 'AI-funksjonar';
$string['manage_features:table:component'] = 'Komponent';
$string['manage_features:table:name'] = 'Namn';
$string['manage_features:table:description'] = 'Skildring';
$string['manage_features:table:ai_actions'] = 'Påkravde AI-handlingar';
$string['manage_features:table:actions'] = 'Handlingar';
$string['manage_features:edit_feature_settings'] = 'Rediger AI-funksjonsinnstillingar: "{$a}"';
$string['manage_features:form:provider_id'] = 'Leverandørinstans';
$string['here_you_can_see_all_components_ai_features'] = 'Her kan du sjå alle komponentane sine AI-funksjonar som er tilgjengelege på nettstaden din. Du kan overstyre standard leverandørinstans og/eller innstillingar for kvar funksjon.';
$string['uses_chat'] = 'Chat';
$string['uses_embedding'] = 'Embeddings';
$string['uses_image'] = 'Bilete';
$string['uses_audio_transcriptions'] = 'Lydtranskripsjonar';
$string['uses_tts'] = 'Tekst-til-tale';

$string['base_url'] = 'Base-URL';
$string['api_key'] = 'API-nøkkel';
$string['default_chat_model'] = 'Standard chatmodell';
$string['default_embedding_model'] = 'Standard embeddingmodell';
$string['default_image_model'] = 'Standard biletemodell';
$string['default_transcription_model'] = 'Standard transkripsjonsmodell';
$string['default_tts_model'] = 'Standard tekst-til-tale-modell';
$string['default_tts_voice'] = 'Standard tekst-til-tale-stemme';
$string['default_tts_format'] = 'Standard tekst-til-tale-format';
$string['provider_settings'] = 'Leverandørinnstillingar';
$string['supports_chat'] = 'Støttar chat';
$string['supports_embedding'] = 'Støttar embedding';
$string['supports_image'] = 'Støttar bilete';
$string['supports_audio_transcriptions'] = 'Støttar lydtranskripsjonar';
$string['supports_tts'] = 'Støttar tekst-til-tale';
$string['provider_supports'] = 'Leverandørkapasitetar';
$string['default_action_providers'] = 'Standard handlingsleverandørinstansar';
$string['here_you_define_default_action_providers'] = 'Her definerer du kva leverandørinstansar som skal brukast som standard for kvar handling.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Du har konfigurert ein leverandørinstans og sett standard leverandørinstans for alle handlingar. Du er no klar til å bruke AI-funksjonar i AI-tillegga dine! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Du har enno ikkje konfigurert nokon AI-leverandørinstansar. Legg til minst éin leverandør <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">her</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Du har enno ikkje konfigurert standard leverandørinstansar for alle handlingar. Konfigurer standard leverandørinstansar <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">her</a>.';
$string['no_available_providers'] = 'Ingen tilgjengelege leverandørinstansar';
$string['this_provider_is_preconfigured_no_modify'] = 'Denne leverandørinstansen er førehandskonfigurert og kan ikkje endrast.';

// Settings
$string['settings:manage_page'] = 'Administrer AI-innstillingar';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Administrer konfigurasjonen for Moxis AI Manager';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Denne tabellen lagrar loggar over bruk av funksjonshandlingar for Moxis AI Manager-tillegget.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'ID';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'ID-en til AI-funksjonen som vart brukt.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'JSON-førespurnaden som vart sendt til AI-leverandøren.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'JSON-svaret som vart motteke frå AI-leverandøren.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'Talet på inndatatokenar brukte i førespurnaden.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'Talet på utdatatokenar mottekne i svaret.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'Sesjons-ID knytt til førespurnaden.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'ID-en til brukaren som gjorde førespurnaden.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'Tidsstempelet då loggoppføringa vart oppretta.';
