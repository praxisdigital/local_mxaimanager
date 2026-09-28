<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Aquesta configuració et permet definir quins proveïdors d'IA (OpenAI, Mistral, etc.) estan disponibles al teu lloc.</p><p>També podràs configurar:</p><ul><li>Quina instància de proveïdor s'ha d'utilitzar per defecte.</li><li>Quin model ha d'utilitzar una instància de proveïdor per defecte.</li><li>Quin model i/o quina instància de proveïdor s'ha d'utilitzar per a una funció d'IA específica al teu connector d'IA.</li></ul>";
$string['manage_providers:title'] = 'Instàncies de proveïdor d\'IA';
$string['manage_providers:table:name'] = "Nom de la instància";
$string['manage_providers:table:classname'] = "Tipus de proveïdor";
$string['manage_providers:table:supported_actions'] = "Accions compatibles";
$string['manage_providers:table:actions'] = "Accions";
$string['manage_providers:form:name'] = 'Nom';
$string['manage_providers:form:type'] = 'Tipus';
$string['manage_providers:add_provider'] = 'Afegeix una instància de proveïdor d\'IA';
$string['manage_providers:edit_provider'] = 'Edita la instància de proveïdor d\'IA';
$string['manage_providers:delete_provider'] = 'Suprimeix la instància de proveïdor d\'IA: "{$a}"';
$string['manage_providers:delete_confirm'] = 'Segur que vols suprimir aquesta instància de proveïdor? Aquesta acció no es pot desfer.';
$string['here_you_define_providers'] = 'Aquí defines les instàncies de proveïdor d\'IA que estaran disponibles al teu lloc.';
$string['set_as_default'] = 'Establir com a predeterminat?';
$string['in_use'] = 'Ja en ús';

// Provider options help texts
$string['openai_chat_model'] = 'Model de xat d\'OpenAI';
$string['openai_chat_model_help'] = 'Aquí pots especificar el model de xat que s\'ha d\'utilitzar. Per exemple: <strong>gpt-4</strong>, <strong>gpt-3.5-turbo</strong>, etc. Consulta la documentació d\'OpenAI per veure els models disponibles.';
$string['mistral_chat_model'] = 'Model de xat de Mistral';
$string['mistral_chat_model_help'] = 'Aquí pots especificar el model de xat que s\'ha d\'utilitzar. Per exemple: <strong>mistral-large</strong>, <strong>mistral-small</strong>, etc. Consulta la documentació de Mistral per veure els models disponibles.';
$string['ollama_chat_model'] = 'Model de xat d\'Ollama';
$string['ollama_chat_model_help'] = 'Aquí pots especificar el model de xat que s\'ha d\'utilitzar. Per exemple: <strong>llama2</strong>, <strong>vicuna</strong>, etc. Consulta el teu proveïdor d\'Ollama per veure els models disponibles.';
$string['nebius_chat_model'] = 'Model de xat de Nebius';
$string['nebius_chat_model_help'] = 'Aquí pots especificar el model de xat que s\'ha d\'utilitzar. Per exemple: <strong>Qwen/Qwen3-32B-fast</strong>, <strong>Qwen/Qwen3-30B-A3B-Instruct-2507</strong>, etc. Consulta la documentació de Nebius per veure els models disponibles.';
$string['openai_embedding_model'] = 'Model d\'embedding d\'OpenAI';
$string['openai_embedding_model_help'] = 'Aquí pots especificar el model d\'embedding que s\'ha d\'utilitzar. Per exemple: <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong>, etc. Consulta la documentació d\'OpenAI per veure els models d\'embedding disponibles.';
$string['mistral_embedding_model'] = 'Model d\'embedding de Mistral';
$string['mistral_embedding_model_help'] = 'Aquí pots especificar el model d\'embedding que s\'ha d\'utilitzar. Per exemple: <strong>mistral-embed</strong>, etc. Consulta la documentació de Mistral per veure els models d\'embedding disponibles.';
$string['ollama_embedding_model'] = 'Model d\'embedding d\'Ollama';
$string['ollama_embedding_model_help'] = 'Aquí pots especificar el model d\'embedding que s\'ha d\'utilitzar. Per exemple: <strong>nomic-embed-text</strong>, etc. Consulta el teu proveïdor d\'Ollama per veure els models d\'embedding disponibles.';
$string['nebius_embedding_model'] = 'Model d\'embedding de Nebius';
$string['nebius_embedding_model_help'] = 'Aquí pots especificar el model d\'embedding que s\'ha d\'utilitzar. Per exemple: <strong>Qwen/Qwen3-Embedding-8B</strong>, etc. Consulta la documentació de Nebius per veure els models d\'embedding disponibles.';
$string['openai_image_model'] = 'Model d\'imatge d\'OpenAI';
$string['openai_image_model_help'] = 'Aquí pots especificar el model de generació d\'imatges que s\'ha d\'utilitzar. Per exemple: <strong>dall-e-3</strong>, <strong>dall-e-2</strong>, etc. Consulta la documentació d\'OpenAI per veure els models de generació d\'imatges disponibles.';
$string['nebius_image_model'] = 'Model d\'imatge de Nebius';
$string['nebius_image_model_help'] = 'Aquí pots especificar el model de generació d\'imatges que s\'ha d\'utilitzar. Per exemple: <strong>black-forest-labs/flux-dev</strong>. Consulta la documentació de Nebius per veure els models de generació d\'imatges disponibles.';
$string['openai_transcription_model'] = 'Model de transcripció d\'OpenAI';
$string['openai_transcription_model_help'] = 'Aquí pots especificar el model de transcripció que s\'ha d\'utilitzar. Per exemple: <strong>whisper-1</strong>. Consulta la documentació d\'OpenAI per veure els models de transcripció disponibles.';
$string['mistral_transcription_model'] = 'Model de transcripció de Mistral';
$string['mistral_transcription_model_help'] = 'Aquí pots especificar el model de transcripció que s\'ha d\'utilitzar. Per exemple: <strong>mistral-whisper</strong>. Consulta la documentació de Mistral per veure els models de transcripció disponibles.';
$string['openai_tts_model'] = 'Model Text-to-Speech d\'OpenAI';
$string['openai_tts_model_help'] = 'Aquí pots especificar el model TTS (text-to-speech) que s\'ha d\'utilitzar. Per exemple: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Consulta la documentació d\'OpenAI per veure els models disponibles.';
$string['openai_tts_voice'] = 'Veu Text-to-Speech d\'OpenAI';
$string['openai_tts_voice_help'] = 'Veu utilitzada per sintetitzar l\'àudio. OpenAI suporta actualment: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
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

// Manage Features
$string['manage_features:title'] = 'Funcions d\'IA';
$string['manage_features:table:component'] = 'Component';
$string['manage_features:table:name'] = 'Nom';
$string['manage_features:table:description'] = 'Descripció';
$string['manage_features:table:ai_actions'] = 'Accions d\'IA requerides';
$string['manage_features:table:actions'] = 'Accions';
$string['manage_features:edit_feature_settings'] = 'Edita la configuració de la funció d\'IA: "{$a}"';
$string['manage_features:form:provider_id'] = 'Instància de proveïdor';
$string['here_you_can_see_all_components_ai_features'] = 'Aquí pots veure totes les funcions d\'IA dels components disponibles al teu lloc. Pots sobreescriure la instància de proveïdor per defecte i/o la configuració de cada funció.';
$string['uses_chat'] = 'Xat';
$string['uses_embedding'] = 'Embeddings';
$string['uses_image'] = 'Imatge';
$string['uses_audio_transcriptions'] = 'Transcripcions d\'àudio';
$string['uses_tts'] = 'Text-to-Speech';

$string['base_url'] = 'URL base';
$string['api_key'] = 'Clau API';
$string['default_chat_model'] = 'Model de xat per defecte';
$string['default_embedding_model'] = 'Model d\'embedding per defecte';
$string['default_image_model'] = 'Model d\'imatge per defecte';
$string['default_transcription_model'] = 'Model de transcripció per defecte';
$string['default_tts_model'] = 'Model Text-to-Speech per defecte';
$string['default_tts_voice'] = 'Veu Text-to-Speech per defecte';
$string['default_tts_format'] = 'Format Text-to-Speech per defecte';
$string['provider_settings'] = 'Configuració del proveïdor';
$string['supports_chat'] = 'Suporta xat';
$string['supports_embedding'] = 'Suporta embedding';
$string['supports_image'] = 'Suporta imatge';
$string['supports_audio_transcriptions'] = 'Suporta transcripcions d\'àudio';
$string['supports_tts'] = 'Suporta Text-to-Speech';
$string['provider_supports'] = 'Capacitats del proveïdor';
$string['default_action_providers'] = 'Instàncies de proveïdor d\'acció per defecte';
$string['here_you_define_default_action_providers'] = 'Aquí defines quines instàncies de proveïdor s\'han d\'utilitzar per defecte per a cada acció.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Has configurat una instància de proveïdor i has establert la instància de proveïdor per defecte per a totes les accions. Ara ja estàs a punt per utilitzar les funcions d\'IA als teus connectors d\'IA! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Encara no has configurat cap instància de proveïdor d\'IA. Afegeix almenys un proveïdor <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">aquí</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Encara no has configurat les instàncies de proveïdor per defecte per a totes les accions. Configura les instàncies de proveïdor per defecte <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">aquí</a>.';
$string['no_available_providers'] = 'No hi ha instàncies de proveïdor disponibles';
$string['this_provider_is_preconfigured_no_modify'] = 'Aquesta instància de proveïdor està preconfigurada i no es pot modificar.';

// Settings
$string['settings:manage_page'] = 'Gestiona la configuració d\'IA';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Gestiona la configuració de Moxis AI Manager';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Aquesta taula emmagatzema els registres d\'ús d\'accions de funcions del connector Moxis AI Manager.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'ID';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'L\'ID de la funció d\'IA que s\'ha utilitzat.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'La petició JSON enviada al proveïdor d\'IA.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'La resposta JSON rebuda del proveïdor d\'IA.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'El nombre de tokens d\'entrada utilitzats a la petició.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'El nombre de tokens de sortida rebuts a la resposta.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'L\'ID de sessió associat a la petició.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'L\'ID de l\'usuari que ha fet la petició.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'La marca de temps en què es va crear l\'entrada del registre.';
