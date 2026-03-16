<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Ces parametres vous permettent de definir quels fournisseurs d'IA (OpenAI, Mistral, etc.) sont disponibles sur votre site.</p><p>Vous pourrez egalement configurer :</p><ul><li>Quelle instance de fournisseur doit etre utilisee par defaut.</li><li>Quel modele une instance de fournisseur doit utiliser par defaut.</li><li>Quel modele et/ou quelle instance de fournisseur doit etre utilise pour une fonctionnalite IA specifique.</li></ul>";
$string['manage_providers:title'] = 'Instances de fournisseurs IA';
$string['manage_providers:table:name'] = 'Nom de l\'instance';
$string['manage_providers:table:classname'] = 'Type de fournisseur';
$string['manage_providers:table:supported_actions'] = 'Actions supportees';
$string['manage_providers:table:actions'] = 'Actions';
$string['manage_providers:form:name'] = 'Nom';
$string['manage_providers:form:type'] = 'Type';
$string['manage_providers:add_provider'] = 'Ajouter une instance de fournisseur IA';
$string['manage_providers:edit_provider'] = 'Modifier une instance de fournisseur IA';
$string['manage_providers:delete_provider'] = 'Supprimer l\'instance de fournisseur IA : "{$a}"';
$string['manage_providers:delete_confirm'] = 'Etes-vous sur de vouloir supprimer cette instance de fournisseur ? Cette action est irreversible.';
$string['here_you_define_providers'] = 'Definissez ici les instances de fournisseurs IA disponibles sur votre site.';
$string['set_as_default'] = 'Definir par defaut ?';
$string['in_use'] = 'Deja utilise';

// Provider options help texts
$string['openai_chat_model'] = 'Modele Chat OpenAI';
$string['openai_chat_model_help'] = 'Specifiez le modele de chat a utiliser. Par exemple : <strong>gpt-5</strong>, <strong>gpt-4.1</strong>, etc. Consultez la documentation OpenAI pour les modeles disponibles.';
$string['mistral_chat_model'] = 'Modele Chat Mistral';
$string['mistral_chat_model_help'] = 'Specifiez le modele de chat a utiliser. Par exemple : <strong>mistral-large-3-25-12</strong>, <strong>mistral-small-3-2-25-06</strong>, etc. Consultez la documentation Mistral pour les modeles disponibles.';
$string['ollama_chat_model'] = 'Modele Chat Ollama';
$string['ollama_chat_model_help'] = 'Specifiez le modele de chat a utiliser. Par exemple : <strong>llama3.1</strong>, <strong>mistral</strong>, etc. Consultez votre fournisseur Ollama pour les modeles disponibles.';
$string['nebius_chat_model'] = 'Modele Chat Nebius';
$string['nebius_chat_model_help'] = 'Specifiez le modele de chat a utiliser. Par exemple : <strong>Qwen/Qwen3-32B-fast</strong>, etc. Consultez la documentation Nebius pour les modeles disponibles.';
$string['openai_embedding_model'] = 'Modele Embedding OpenAI';
$string['openai_embedding_model_help'] = 'Specifiez le modele d\'embedding a utiliser. Par exemple : <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong>, etc.';
$string['mistral_embedding_model'] = 'Modele Embedding Mistral';
$string['mistral_embedding_model_help'] = 'Specifiez le modele d\'embedding a utiliser. Par exemple : <strong>mistral-embed-23-12</strong>, etc.';
$string['ollama_embedding_model'] = 'Modele Embedding Ollama';
$string['ollama_embedding_model_help'] = 'Specifiez le modele d\'embedding a utiliser. Par exemple : <strong>nomic-embed-text</strong>, etc.';
$string['nebius_embedding_model'] = 'Modele Embedding Nebius';
$string['nebius_embedding_model_help'] = 'Specifiez le modele d\'embedding a utiliser. Par exemple : <strong>BAAI/bge-en-icl</strong>, etc.';
$string['openai_image_model'] = 'Modele Image OpenAI';
$string['openai_image_model_help'] = 'Specifiez le modele de generation d\'images a utiliser. Par exemple : <strong>gpt-image-1.5</strong>, <strong>dall-e-3</strong>, etc.';
$string['nebius_image_model'] = 'Modele Image Nebius';
$string['nebius_image_model_help'] = 'Specifiez le modele de generation d\'images a utiliser. Par exemple : <strong>black-forest-labs/FLUX.1-schnell</strong>.';
$string['openai_transcription_model'] = 'Modele Transcription OpenAI';
$string['openai_transcription_model_help'] = 'Specifiez le modele de transcription a utiliser. Par exemple : <strong>gpt-4o-transcribe</strong>, <strong>whisper-1</strong>.';
$string['mistral_transcription_model'] = 'Modele Transcription Mistral';
$string['mistral_transcription_model_help'] = 'Specifiez le modele de transcription a utiliser. Par exemple : <strong>voxtral-mini-transcribe-26-02</strong>.';

// Manage Features
$string['manage_features:title'] = 'Fonctionnalites IA';
$string['manage_features:table:component'] = 'Composant';
$string['manage_features:table:name'] = 'Nom';
$string['manage_features:table:description'] = 'Description';
$string['manage_features:table:ai_actions'] = 'Actions IA requises';
$string['manage_features:table:actions'] = 'Actions';
$string['manage_features:edit_feature_settings'] = 'Modifier les parametres de la fonctionnalite IA : "{$a}"';
$string['manage_features:form:provider_id'] = 'Instance de fournisseur';
$string['here_you_can_see_all_components_ai_features'] = 'Voici toutes les fonctionnalites IA des composants disponibles sur votre site. Vous pouvez remplacer l\'instance de fournisseur par defaut et/ou les parametres pour chaque fonctionnalite.';
$string['uses_chat'] = 'Chat';
$string['uses_embedding'] = 'Embeddings';
$string['uses_image'] = 'Image';
$string['uses_audio_transcriptions'] = 'Transcription audio';

$string['base_url'] = 'URL de base';
$string['api_key'] = 'Cle API';
$string['model_type_or_select'] = 'Selectionnez un modele ou saisissez-en un...';
$string['default_chat_model'] = 'Modele Chat par defaut';
$string['default_embedding_model'] = 'Modele Embedding par defaut';
$string['default_image_model'] = 'Modele Image par defaut';
$string['default_transcription_model'] = 'Modele Transcription par defaut';
$string['provider_settings'] = 'Parametres du fournisseur';
$string['supports_chat'] = 'Supporte le Chat';
$string['supports_embedding'] = 'Supporte l\'Embedding';
$string['supports_image'] = 'Supporte l\'Image';
$string['supports_audio_transcriptions'] = 'Supporte la Transcription audio';
$string['provider_supports'] = 'Capacites du fournisseur';
$string['default_action_providers'] = 'Instances de fournisseurs par defaut';
$string['here_you_define_default_action_providers'] = 'Definissez ici quelles instances de fournisseurs doivent etre utilisees par defaut pour chaque action.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Vous avez configure une instance de fournisseur et defini le fournisseur par defaut pour toutes les actions. Vous etes pret a utiliser les fonctionnalites IA ! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Vous n\'avez pas encore configure d\'instance de fournisseur IA. Veuillez en ajouter au moins une <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">ici</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Vous n\'avez pas encore configure les fournisseurs par defaut pour toutes les actions. Veuillez les configurer <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">ici</a>.';
$string['no_available_providers'] = 'Aucune instance de fournisseur disponible';
$string['this_provider_is_preconfigured_no_modify'] = 'Cette instance de fournisseur est preconfiguree et ne peut pas etre modifiee.';

// Settings
$string['settings:manage_page'] = 'Gerer les parametres IA';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Gerer la configuration de Moxis AI Manager';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Cette table stocke les logs d\'utilisation des actions IA du plugin Moxis AI Manager.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'ID';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'L\'ID de la fonctionnalite IA utilisee.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'La requete JSON envoyee au fournisseur IA.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'La reponse JSON recue du fournisseur IA.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'Le nombre de tokens d\'entree utilises dans la requete.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'Le nombre de tokens de sortie recus dans la reponse.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'L\'ID de session associe a la requete.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'L\'ID de l\'utilisateur ayant effectue la requete.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'L\'horodatage de creation de l\'entree de log.';
