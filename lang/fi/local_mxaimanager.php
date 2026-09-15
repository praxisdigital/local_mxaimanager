<?php

$string['pluginname'] = 'Moxis AI Manager';

// Manage Providers
$string['manage:info'] = "<p>Näillä asetuksilla voit määrittää, mitkä tekoälypalveluntarjoajat (OpenAI, Mistral jne.) ovat käytettävissä sivustollasi.</p><p>Voit myös määrittää:</p><ul><li>Mitä palveluntarjoajan instanssia käytetään oletuksena.</li><li>Mitä mallia palveluntarjoajan instanssi käyttää oletuksena.</li><li>Mitä mallia ja/tai mitä palveluntarjoajan instanssia käytetään tietyssä tekoälyominaisuudessa AI-lisäosassasi.</li></ul>";
$string['manage_providers:title'] = 'Tekoälypalveluntarjoajien instanssit';
$string['manage_providers:table:name'] = "Instanssin nimi";
$string['manage_providers:table:classname'] = "Palveluntarjoajan tyyppi";
$string['manage_providers:table:supported_actions'] = "Tuetut toiminnot";
$string['manage_providers:table:actions'] = "Toiminnot";
$string['manage_providers:form:name'] = 'Nimi';
$string['manage_providers:form:type'] = 'Tyyppi';
$string['manage_providers:add_provider'] = 'Lisää tekoälypalveluntarjoajan instanssi';
$string['manage_providers:edit_provider'] = 'Muokkaa tekoälypalveluntarjoajan instanssia';
$string['manage_providers:delete_provider'] = 'Poista tekoälypalveluntarjoajan instanssi: "{$a}"';
$string['manage_providers:delete_confirm'] = 'Haluatko varmasti poistaa tämän palveluntarjoajan instanssin? Tätä toimintoa ei voi perua.';
$string['here_you_define_providers'] = 'Tässä määrität tekoälypalveluntarjoajien instanssit, jotka ovat käytettävissä sivustollasi.';
$string['set_as_default'] = 'Aseta oletukseksi?';
$string['in_use'] = 'Jo käytössä';

// Provider options help texts
$string['openai_chat_model'] = 'OpenAI-keskustelumalli';
$string['openai_chat_model_help'] = 'Tässä voit määrittää käytettävän keskustelumallin. Esimerkiksi: <strong>gpt-4</strong>, <strong>gpt-3.5-turbo</strong> jne. Katso saatavilla olevat mallit OpenAI:n dokumentaatiosta.';
$string['mistral_chat_model'] = 'Mistral-keskustelumalli';
$string['mistral_chat_model_help'] = 'Tässä voit määrittää käytettävän keskustelumallin. Esimerkiksi: <strong>mistral-large</strong>, <strong>mistral-small</strong> jne. Katso saatavilla olevat mallit Mistralin dokumentaatiosta.';
$string['ollama_chat_model'] = 'Ollama-keskustelumalli';
$string['ollama_chat_model_help'] = 'Tässä voit määrittää käytettävän keskustelumallin. Esimerkiksi: <strong>llama2</strong>, <strong>vicuna</strong> jne. Katso saatavilla olevat mallit Ollama-palveluntarjoajaltasi.';
$string['nebius_chat_model'] = 'Nebius-keskustelumalli';
$string['nebius_chat_model_help'] = 'Tässä voit määrittää käytettävän keskustelumallin. Esimerkiksi: <strong>Qwen/Qwen3-32B-fast</strong>, <strong>Qwen/Qwen3-30B-A3B-Instruct-2507</strong> jne. Katso saatavilla olevat mallit Nebiuksen dokumentaatiosta.';
$string['openai_embedding_model'] = 'OpenAI-upotusmalli';
$string['openai_embedding_model_help'] = 'Tässä voit määrittää käytettävän upotusmallin. Esimerkiksi: <strong>text-embedding-3-small</strong>, <strong>text-embedding-3-large</strong> jne. Katso saatavilla olevat upotusmallit OpenAI:n dokumentaatiosta.';
$string['mistral_embedding_model'] = 'Mistral-upotusmalli';
$string['mistral_embedding_model_help'] = 'Tässä voit määrittää käytettävän upotusmallin. Esimerkiksi: <strong>mistral-embed</strong> jne. Katso saatavilla olevat upotusmallit Mistralin dokumentaatiosta.';
$string['ollama_embedding_model'] = 'Ollama-upotusmalli';
$string['ollama_embedding_model_help'] = 'Tässä voit määrittää käytettävän upotusmallin. Esimerkiksi: <strong>nomic-embed-text</strong> jne. Katso saatavilla olevat upotusmallit Ollama-palveluntarjoajaltasi.';
$string['nebius_embedding_model'] = 'Nebius-upotusmalli';
$string['nebius_embedding_model_help'] = 'Tässä voit määrittää käytettävän upotusmallin. Esimerkiksi: <strong>Qwen/Qwen3-Embedding-8B</strong> jne. Katso saatavilla olevat upotusmallit Nebiuksen dokumentaatiosta.';
$string['openai_image_model'] = 'OpenAI-kuvamalli';
$string['openai_image_model_help'] = 'Tässä voit määrittää käytettävän kuvagenerointimallin. Esimerkiksi: <strong>dall-e-3</strong>, <strong>dall-e-2</strong> jne. Katso saatavilla olevat kuvagenerointimallit OpenAI:n dokumentaatiosta.';
$string['nebius_image_model'] = 'Nebius-kuvamalli';
$string['nebius_image_model_help'] = 'Tässä voit määrittää käytettävän kuvagenerointimallin. Esimerkiksi: <strong>black-forest-labs/flux-dev</strong>. Katso saatavilla olevat kuvagenerointimallit Nebiuksen dokumentaatiosta.';
$string['openai_transcription_model'] = 'OpenAI-litterointimalli';
$string['openai_transcription_model_help'] = 'Tässä voit määrittää käytettävän litterointimallin. Esimerkiksi: <strong>whisper-1</strong>. Katso saatavilla olevat litterointimallit OpenAI:n dokumentaatiosta.';
$string['mistral_transcription_model'] = 'Mistral-litterointimalli';
$string['mistral_transcription_model_help'] = 'Tässä voit määrittää käytettävän litterointimallin. Esimerkiksi: <strong>mistral-whisper</strong>. Katso saatavilla olevat litterointimallit Mistralin dokumentaatiosta.';
$string['openai_tts_model'] = 'OpenAI tekstistä puheeksi -malli';
$string['openai_tts_model_help'] = 'Tässä voit määrittää käytettävän TTS-mallin (tekstistä puheeksi). Esimerkiksi: <strong>tts-1</strong>, <strong>tts-1-hd</strong>. Katso saatavilla olevat TTS-mallit OpenAI:n dokumentaatiosta.';
$string['openai_tts_voice'] = 'OpenAI tekstistä puheeksi -ääni';
$string['openai_tts_voice_help'] = 'Ääni, jota käytetään audion syntetisointiin. OpenAI tukee tällä hetkellä: <strong>alloy</strong>, <strong>echo</strong>, <strong>fable</strong>, <strong>onyx</strong>, <strong>nova</strong>, <strong>shimmer</strong>.';
$string['openai_tts_format'] = 'OpenAI tekstistä puheeksi -muoto';
$string['openai_tts_format_help'] = 'OpenAI:n palauttama äänisäilömuoto. <strong>mp3</strong> on turvallisin valinta HTML5 audio -elementille; myös <strong>opus</strong>, <strong>aac</strong>, <strong>flac</strong>, <strong>wav</strong> ja <strong>pcm</strong> tuetaan.';
$string['elevenlabs_api_key'] = 'ElevenLabs API-avain';
$string['elevenlabs_api_key_help'] = 'API-avain ElevenLabs-tililtä (otsake <strong>xi-api-key</strong>). Löydät avaimet osoitteesta https://elevenlabs.io/app/settings/api-keys';
$string['elevenlabs_tts_voice'] = 'ElevenLabs-ääni-ID';
$string['elevenlabs_tts_voice_help'] = 'ElevenLabsin <strong>voice_id</strong>, jota käytetään tekstistä puheeksi -toimintoon ja Conversational AI -agenttien oletusäänenä. Löydät äänet osoitteesta https://elevenlabs.io/app/voice-lab';
$string['elevenlabs_tts_model'] = 'ElevenLabs TTS-malli';
$string['elevenlabs_tts_model_help'] = 'Mallitunnus puhesynteesiin, esim. <strong>eleven_multilingual_v2</strong> tai <strong>eleven_turbo_v2_5</strong>.';
$string['elevenlabs_tts_format'] = 'ElevenLabs TTS-tulostemuoto';
$string['elevenlabs_tts_format_help'] = 'Puhe-API:n tulostemuoto, esim. <strong>mp3_44100_128</strong>. Katso saatavilla olevat muodot ElevenLabsin dokumentaatiosta.';

// Manage Features
$string['manage_features:title'] = 'Tekoälyominaisuudet';
$string['manage_features:table:component'] = 'Komponentti';
$string['manage_features:table:name'] = 'Nimi';
$string['manage_features:table:description'] = 'Kuvaus';
$string['manage_features:table:ai_actions'] = 'Vaaditut tekoälytoiminnot';
$string['manage_features:table:actions'] = 'Toiminnot';
$string['manage_features:edit_feature_settings'] = 'Muokkaa tekoälyominaisuuden asetuksia: "{$a}"';
$string['manage_features:form:provider_id'] = 'Palveluntarjoajan instanssi';
$string['here_you_can_see_all_components_ai_features'] = 'Tässä näet kaikkien komponenttien tekoälyominaisuudet, jotka ovat käytettävissä sivustollasi. Voit ohittaa oletuspalveluntarjoajan instanssin ja/tai asetukset kullekin ominaisuudelle.';
$string['uses_chat'] = 'Keskustelu';
$string['uses_embedding'] = 'Upotukset';
$string['uses_image'] = 'Kuva';
$string['uses_audio_transcriptions'] = 'Äänilitteroinnit';
$string['uses_tts'] = 'Tekstistä puheeksi';

$string['base_url'] = 'Perus-URL';
$string['api_key'] = 'API-avain';
$string['default_chat_model'] = 'Oletuskeskustelumalli';
$string['default_embedding_model'] = 'Oletusupotusmalli';
$string['default_image_model'] = 'Oletuskuvamalli';
$string['default_transcription_model'] = 'Oletuslitterointimalli';
$string['default_tts_model'] = 'Oletus tekstistä puheeksi -malli';
$string['default_tts_voice'] = 'Oletus tekstistä puheeksi -ääni';
$string['default_tts_format'] = 'Oletus tekstistä puheeksi -muoto';
$string['provider_settings'] = 'Palveluntarjoajan asetukset';
$string['supports_chat'] = 'Tukee keskustelua';
$string['supports_embedding'] = 'Tukee upotusta';
$string['supports_image'] = 'Tukee kuvaa';
$string['supports_audio_transcriptions'] = 'Tukee äänilitterointeja';
$string['supports_tts'] = 'Tukee tekstistä puheeksi -toimintoa';
$string['provider_supports'] = 'Palveluntarjoajan ominaisuudet';
$string['default_action_providers'] = 'Toimintojen oletuspalveluntarjoajien instanssit';
$string['here_you_define_default_action_providers'] = 'Tässä määrität, mitä palveluntarjoajien instansseja käytetään oletuksena kullekin toiminnolle.';
$string['you_have_configured_a_provider_and_set_the_default'] = 'Olet määrittänyt palveluntarjoajan instanssin ja asettanut oletuspalveluntarjoajan instanssin kaikille toiminnoille. Olet nyt valmis käyttämään tekoälyominaisuuksia AI-lisäosissasi! :)';
$string['you_have_not_yet_configured_any_providers'] = 'Et ole vielä määrittänyt yhtään tekoälypalveluntarjoajan instanssia. Lisää vähintään yksi palveluntarjoaja <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">täällä</a>.';
$string['you_have_not_yet_configured_default_providers'] = 'Et ole vielä määrittänyt oletuspalveluntarjoajien instansseja kaikille toiminnoille. Määritä oletuspalveluntarjoajien instanssit <a href="/local/mxaimanager/view.php?view=manage_providers&action=browse">täällä</a>.';
$string['no_available_providers'] = 'Ei käytettävissä olevia palveluntarjoajien instansseja';
$string['this_provider_is_preconfigured_no_modify'] = 'Tämä palveluntarjoajan instanssi on esikonfiguroitu, eikä sitä voi muokata.';

// Settings
$string['settings:manage_page'] = 'Hallitse tekoälyasetuksia';

// Capabilities
$string['mxaimanager:manage_configuration'] = 'Hallitse Moxis AI Manager -määrityksiä';

// Privacy
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs'] = 'Tähän tauluun tallennetaan Moxis AI Manager -lisäosan ominaisuuskäytön lokit.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:id'] = 'Tunnus';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:feature_id'] = 'Käytetyn tekoälyominaisuuden tunnus.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:request_json'] = 'Tekoälypalveluntarjoajalle lähetetty JSON-pyyntö.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:response_json'] = 'Tekoälypalveluntarjoajalta vastaanotettu JSON-vastaus.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:input_tokens'] = 'Pyynnössä käytettyjen syötetokenien määrä.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:output_tokens'] = 'Vastauksessa vastaanotettujen tulostetokenien määrä.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:session_id'] = 'Pyyntöön liittyvä istuntotunnus.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:user_id'] = 'Pyynnön tehneen käyttäjän tunnus.';
$string['privacy:metadata:local_mxaimanager_feature_action_usage_logs:timecreated'] = 'Aikaleima, jolloin lokimerkintä luotiin.';
