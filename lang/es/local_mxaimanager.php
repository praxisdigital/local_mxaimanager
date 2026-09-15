<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Esta configuración te permite definir qué proveedores de IA (OpenAI, Mistral, etc.) están disponibles en tu sitio.</p><p>También podrás configurar:</p><ul><li>Qué instancia de proveedor se debe usar por defecto.</li><li>Qué modelo debe usar una instancia de proveedor por defecto.</li><li>Qué modelo y/o qué instancia de proveedor se debe usar para una función de IA específica en tu plugin de IA.</li></ul>";
$string['manage_providers:title'] = 'Instancias de proveedor de IA';
$string['manage_providers:table:name'] = "Nombre de la instancia";
$string['manage_providers:table:classname'] = "Tipo de proveedor";
$string['manage_providers:table:supported_actions'] = "Acciones compatibles";
$string['manage_providers:table:actions'] = "Acciones";
$string['manage_providers:form:name'] = 'Nombre';
$string['manage_providers:form:type'] = 'Tipo';
$string['manage_providers:add_provider'] = 'Añadir instancia de proveedor de IA';
$string['manage_providers:edit_provider'] = 'Editar instancia de proveedor de IA';
$string['manage_providers:delete_provider'] = 'Eliminar instancia de proveedor de IA: "{$a}"';
$string['manage_providers:delete_confirm'] = '¿Seguro que quieres eliminar esta instancia de proveedor? Esta acción no se puede deshacer.';
$string['here_you_define_providers'] = 'Aquí defines las instancias de proveedor de IA que estarán disponibles en tu sitio.';
$string['set_as_default'] = '¿Establecer como predeterminado?';
$string['in_use'] = 'Ya en uso';

// Provider options help texts
$string['openai_chat_model'] = 'Modelo de chat de OpenAI';
$string['openai_chat_model_help'] = 'Aquí puedes especificar el modelo de chat que se debe usar. Por ejemplo: <strong>gpt-4</strong>, <strong>gpt-3.5-turbo</strong>, etc. Consulta la documentación de OpenAI para ver los modelos disponibles.';
$string['mistral_chat_model'] = 'Modelo de chat de Mistral';
$string['mistral_chat_model_help'] = 'Aquí puedes especificar el modelo de chat que se debe usar. Por ejemplo: <strong>mistral-large</strong>, <strong>mistral-small</strong>, etc. Consulta la documentación de Mistral para ver los modelos disponibles.';
$string['ollama_chat_model'] = 'Modelo de chat de Ollama';
$string['ollama_chat_model_help'] = 'Aquí puedes especificar el modelo de chat que se debe usar. Por ejemplo: <strong>llama2</strong>, <strong>vicuna</strong>, etc. Consulta tu proveedor de Ollama para ver los modelos disponibles.';
$string['nebius_chat_model'] = 'Modelo de chat de Nebius';
$string['nebius_chat_model_help'] = 'Aquí puedes especificar el modelo de chat que se debe usar. Por ejemplo: <strong>Qwen/Qwen3-32B-fast</strong>, <strong>Qwen/Qwen3-30B-A3B-Instruct-2507</strong>, etc. Consulta la documentación de Nebius para ver los modelos disponibles.';
$string['openai_embedding_model'] = 'Modelo de embedding de OpenAI';
$string['openai_embedding_model_help'] = 'Aquí puedes especificar el modelo de embedding que se debe usar. Por ejemplo: <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong>, etc. Consulta la documentación de OpenAI para ver los modelos de embedding disponibles.';
$string['mistral_embedding_model'] = 'Modelo de embedding de Mistral';
$string['mistral_embedding_model_help'] = 'Aquí puedes especificar el modelo de embedding que se debe usar. Por ejemplo: <strong>mistral-embed</strong>, etc. Consulta la documentación de Mistral para ver los modelos de embedding disponibles.';
$string['ollama_embedding_model'] = 'Modelo de embedding de Ollama';
$string['ollama_embedding_model_help'] = 'Aquí puedes especificar el modelo de embedding que se debe usar. Por ejemplo: <strong>nomic-embed-text</strong>, etc. Consulta tu proveedor de Ollama para ver los modelos de embedding disponibles.';
$string['nebius_embedding_model'] = 'Modelo de embedding de Nebius';
$string['nebius_embedding_model_help'] = 'Aquí puedes especificar el modelo de embedding que se debe usar. Por ejemplo: <strong>Qwen/Qwen3-Embedding-8B</strong>, etc. Consulta la documentación de Nebius para ver los modelos de embedding disponibles.';
$string['openai_image_model'] = 'Modelo de imagen de OpenAI';
$string['openai_image_model_help'] = 'Aquí puedes especificar el modelo de generación de imágenes que se debe usar. Por ejemplo: <strong>dall-e-3</strong>, <strong>dall-e-2</strong>, etc. Consulta la documentación de OpenAI para ver los modelos de generación de imágenes disponibles.';
$string['nebius_image_model'] = 'Modelo de imagen de Nebius';
$string['nebius_image_model_help'] = 'Aquí puedes especificar el modelo de generación de imágenes que se debe usar. Por ejemplo: <strong>black-forest-labs/flux-dev</strong>. Consulta la documentación de Nebius para ver los modelos de generación de imágenes disponibles.';
$string['openai_transcription_model'] = 'Modelo de transcripción de OpenAI';
$string['openai_transcription_model_help'] = 'Aquí puedes especificar el modelo de transcripción que se debe usar. Por ejemplo: <strong>whisper-1</strong>. Consulta la documentación de OpenAI para ver los modelos de transcripción disponibles.';
$string['mistral_transcription_model'] = 'Modelo de transcripción de Mistral';
$string['mistral_transcription_model_help'] = 'Aquí puedes especificar el modelo de transcripción que se debe usar. Por ejemplo: <strong>mistral-whisper</strong>. Consulta la documentación de Mistral para ver los modelos de transcripción disponibles.';
$string['openai_tts_model'] = 'Modelo Text-to-Speech de OpenAI';
$string['openai_tts_model_help'] = 'Aquí puedes especificar el modelo TTS (text-to-speech) a utilizar. Por ejemplo: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Consulta la documentación de OpenAI para ver los modelos disponibles.';
$string['openai_tts_voice'] = 'Voz Text-to-Speech de OpenAI';
$string['openai_tts_voice_help'] = 'Voz utilizada para sintetizar el audio. OpenAI soporta actualmente: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
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

// Manage Features
$string['manage_features:title'] = 'Funciones de IA';
$string['manage_features:table:component'] = 'Componente';
$string['manage_features:table:name'] = 'Nombre';
$string['manage_features:table:description'] = 'Descripción';
$string['manage_features:table:ai_actions'] = 'Acciones de IA requeridas';
$string['manage_features:table:actions'] = 'Acciones';
$string['manage_features:edit_feature_settings'] = 'Editar configuración de la función de IA: "{$a}"';
$string['manage_features:form:provider_id'] = 'Instancia de proveedor';
$string['here_you_can_see_all_components_ai_features'] = 'Aquí puedes ver todas las funciones de IA de los componentes disponibles en tu sitio. Puedes sobrescribir la instancia de proveedor por defecto y/o la configuración de cada función.';
$string['uses_chat'] = 'Chat';
$string['uses_embedding'] = 'Embeddings';
$string['uses_image'] = 'Imagen';
$string['uses_audio_transcriptions'] = 'Transcripciones de audio';
$string['uses_tts'] = 'Text-to-Speech';

$string['base_url'] = 'URL base';
$string['api_key'] = 'Clave API';
$string['default_chat_model'] = 'Modelo de chat por defecto';
$string['default_embedding_model'] = 'Modelo de embedding por defecto';
$string['default_image_model'] = 'Modelo de imagen por defecto';
$string['default_transcription_model'] = 'Modelo de transcripción por defecto';
$string['default_tts_model'] = 'Modelo Text-to-Speech por defecto';
$string['default_tts_voice'] = 'Voz Text-to-Speech por defecto';
$string['default_tts_format'] = 'Formato Text-to-Speech por defecto';
$string['provider_settings'] = 'Configuración del proveedor';
$string['supports_chat'] = 'Soporta chat';
$string['supports_embedding'] = 'Soporta embedding';
$string['supports_image'] = 'Soporta imagen';
$string['supports_audio_transcriptions'] = 'Soporta transcripciones de audio';
$string['supports_tts'] = 'Soporta Text-to-Speech';
$string['provider_supports'] = 'Capacidades del proveedor';
$string['default_action_providers'] = 'Instancias de proveedor de acción por defecto';
$string['here_you_define_default_action_providers'] = 'Aquí defines qué instancias de proveedor se deben usar por defecto para cada acción.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Has configurado una instancia de proveedor y has establecido la instancia de proveedor por defecto para todas las acciones. ¡Ya estás listo para usar las funciones de IA en tus plugins de IA! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Aún no has configurado ninguna instancia de proveedor de IA. Añade al menos un proveedor <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">aquí</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Aún no has configurado las instancias de proveedor por defecto para todas las acciones. Configura las instancias de proveedor por defecto <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">aquí</a>.';
$string['no_available_providers'] = 'No hay instancias de proveedor disponibles';
$string['this_provider_is_preconfigured_no_modify'] = 'Esta instancia de proveedor está preconfigurada y no se puede modificar.';

// Settings
$string['settings:manage_page'] = 'Gestionar configuración de IA';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Gestionar la configuración de Moxis AI Manager';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Esta tabla almacena los registros de uso de acciones de funciones del plugin Moxis AI Manager.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'ID';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'El ID de la función de IA que se utilizó.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'La petición JSON enviada al proveedor de IA.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'La respuesta JSON recibida del proveedor de IA.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'El número de tokens de entrada usados en la petición.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'El número de tokens de salida recibidos en la respuesta.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'El ID de sesión asociado a la petición.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'El ID del usuario que realizó la petición.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'La marca de tiempo en la que se creó la entrada del registro.';
