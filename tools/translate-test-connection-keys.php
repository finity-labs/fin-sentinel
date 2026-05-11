<?php

declare(strict_types=1);

// One-shot bootstrap: writes the 5 settings.ai.test_connection_* keys into every non-English locale.
// Run from the package root: php tools/translate-test-connection-keys.php
// Re-runnable. Existing settings.ai.test_connection_* keys are overwritten; other keys are preserved.

$translations = [
    'am' => ['ሙከራ', 'የAI ግንኙነት ይሰራል።', 'የAI ግንኙነት አልተሳካም።', 'ግንኙነቱን ለመሞከር አቅራቢ፣ ሞዴል እና API ቁልፍ ያስፈልጋሉ።', 'AI SDK (laravel/ai) አልተጫነም።'],
    'ar' => ['اختبار', 'اتصال الذكاء الاصطناعي يعمل.', 'فشل اتصال الذكاء الاصطناعي.', 'يجب توفير المزوّد والنموذج ومفتاح الـ API لاختبار الاتصال.', 'لم يتم تثبيت SDK الذكاء الاصطناعي (laravel/ai).'],
    'az' => ['Test et', 'AI bağlantısı işləyir.', 'AI bağlantısı uğursuz oldu.', 'Bağlantını test etmək üçün təminatçı, model və API açarı tələb olunur.', 'AI SDK (laravel/ai) quraşdırılmayıb.'],
    'bg' => ['Тествай', 'AI връзката работи.', 'AI връзката е неуспешна.', 'Доставчик, модел и API ключ са необходими за тестване на връзката.', 'AI SDK (laravel/ai) не е инсталиран.'],
    'bn' => ['পরীক্ষা', 'AI সংযোগ কাজ করছে।', 'AI সংযোগ ব্যর্থ হয়েছে।', 'সংযোগ পরীক্ষা করতে প্রদানকারী, মডেল এবং API কী প্রয়োজন।', 'AI SDK (laravel/ai) ইনস্টল করা নেই।'],
    'bs' => ['Testiraj', 'AI veza radi.', 'AI veza nije uspjela.', 'Pružatelj, model i API ključ su obavezni za testiranje veze.', 'AI SDK (laravel/ai) nije instaliran.'],
    'ca' => ['Prova', 'La connexió IA funciona.', 'La connexió IA ha fallat.', 'Cal proveïdor, model i clau API per provar la connexió.', "El SDK d'IA (laravel/ai) no està instal·lat."],
    'ckb' => ['تاقیکردنەوە', 'پەیوەندی AI کاردەکات.', 'پەیوەندی AI سەرکەوتوو نەبوو.', 'بۆ تاقیکردنەوەی پەیوەندی پێویستە دابینکار و مۆدێل و کلیلی API.', 'AI SDK (laravel/ai) دانەنراوە.'],
    'cs' => ['Otestovat', 'Spojení s AI funguje.', 'Spojení s AI selhalo.', 'Pro otestování spojení jsou vyžadováni poskytovatel, model a klíč API.', 'AI SDK (laravel/ai) není nainstalován.'],
    'da' => ['Test', 'AI-forbindelsen virker.', 'AI-forbindelsen mislykkedes.', 'Udbyder, model og API-nøgle kræves for at teste forbindelsen.', 'AI SDK (laravel/ai) er ikke installeret.'],
    'de' => ['Testen', 'KI-Verbindung funktioniert.', 'KI-Verbindung fehlgeschlagen.', 'Anbieter, Modell und API-Schlüssel sind zum Testen der Verbindung erforderlich.', 'KI-SDK (laravel/ai) ist nicht installiert.'],
    'el' => ['Δοκιμή', 'Η σύνδεση AI λειτουργεί.', 'Η σύνδεση AI απέτυχε.', 'Απαιτούνται πάροχος, μοντέλο και κλειδί API για τη δοκιμή της σύνδεσης.', 'Το AI SDK (laravel/ai) δεν είναι εγκατεστημένο.'],
    'es' => ['Probar', 'La conexión de IA funciona.', 'La conexión de IA falló.', 'Se requieren proveedor, modelo y clave API para probar la conexión.', 'El SDK de IA (laravel/ai) no está instalado.'],
    'fa' => ['آزمایش', 'اتصال هوش مصنوعی کار می‌کند.', 'اتصال هوش مصنوعی ناموفق بود.', 'برای آزمایش اتصال، ارائه‌دهنده، مدل و کلید API لازم است.', 'SDK هوش مصنوعی (laravel/ai) نصب نشده است.'],
    'fi' => ['Testaa', 'Tekoälyn yhteys toimii.', 'Tekoälyn yhteys epäonnistui.', 'Yhteyden testaamiseen tarvitaan palveluntarjoaja, malli ja API-avain.', 'Tekoälyn SDK (laravel/ai) ei ole asennettu.'],
    'fr' => ['Tester', 'La connexion IA fonctionne.', 'Échec de la connexion IA.', 'Fournisseur, modèle et clé API sont requis pour tester la connexion.', "Le SDK IA (laravel/ai) n'est pas installé."],
    'he' => ['בדוק', 'חיבור ה-AI פועל.', 'חיבור ה-AI נכשל.', 'נדרשים ספק, מודל ומפתח API כדי לבדוק את החיבור.', 'AI SDK (laravel/ai) אינו מותקן.'],
    'hi' => ['परीक्षण', 'AI कनेक्शन काम कर रहा है।', 'AI कनेक्शन विफल हुआ।', 'कनेक्शन का परीक्षण करने के लिए प्रदाता, मॉडल और API कुंजी आवश्यक हैं।', 'AI SDK (laravel/ai) स्थापित नहीं है।'],
    'hr' => ['Testiraj', 'AI veza radi.', 'AI veza nije uspjela.', 'Pružatelj, model i API ključ obvezni su za testiranje veze.', 'AI SDK (laravel/ai) nije instaliran.'],
    'hu' => ['Tesztelés', 'AI-kapcsolat működik.', 'AI-kapcsolat sikertelen.', 'A kapcsolat teszteléséhez szolgáltató, modell és API-kulcs szükséges.', 'Az AI SDK (laravel/ai) nincs telepítve.'],
    'id' => ['Uji', 'Koneksi AI berfungsi.', 'Koneksi AI gagal.', 'Penyedia, model, dan kunci API diperlukan untuk menguji koneksi.', 'AI SDK (laravel/ai) belum terpasang.'],
    'it' => ['Prova', 'Connessione IA funzionante.', 'Connessione IA fallita.', 'Provider, modello e chiave API sono richiesti per testare la connessione.', 'Il SDK IA (laravel/ai) non è installato.'],
    'ja' => ['テスト', 'AI接続は正常です。', 'AI接続に失敗しました。', '接続をテストするには、プロバイダー、モデル、APIキーが必要です。', 'AI SDK (laravel/ai) がインストールされていません。'],
    'ka' => ['ტესტი', 'AI კავშირი მუშაობს.', 'AI კავშირი ვერ მოხერხდა.', 'კავშირის შესამოწმებლად საჭიროა მომწოდებელი, მოდელი და API გასაღები.', 'AI SDK (laravel/ai) არ არის დაყენებული.'],
    'km' => ['សាកល្បង', 'ការតភ្ជាប់ AI ដំណើរការ។', 'ការតភ្ជាប់ AI បានបរាជ័យ។', 'ត្រូវការអ្នកផ្គត់ផ្គង់ ម៉ូដែល និងសោ API ដើម្បីសាកល្បងការតភ្ជាប់។', 'AI SDK (laravel/ai) មិនបានដំឡើង។'],
    'ko' => ['테스트', 'AI 연결이 정상입니다.', 'AI 연결에 실패했습니다.', '연결을 테스트하려면 공급자, 모델, API 키가 필요합니다.', 'AI SDK (laravel/ai)가 설치되어 있지 않습니다.'],
    'ku' => ['Tîst', 'Girêdana AI dixebite.', 'Girêdana AI têk çû.', 'Dabînker, model û mifteya API ji bo testkirina girêdanê pêwîst in.', 'AI SDK (laravel/ai) nehatiye sazkirin.'],
    'lt' => ['Testuoti', 'AI ryšys veikia.', 'AI ryšys nepavyko.', 'Norint patikrinti ryšį, reikalingas tiekėjas, modelis ir API raktas.', 'AI SDK (laravel/ai) neįdiegtas.'],
    'lus' => ['Sai', 'AI inkawmna a thawk a.', 'AI inkawmna a chhuahsuak.', 'Inkawmna sai nan provider, model leh API key a ngai.', 'AI SDK (laravel/ai) install lo.'],
    'lv' => ['Pārbaudīt', 'AI savienojums darbojas.', 'AI savienojums neizdevās.', 'Lai pārbaudītu savienojumu, ir nepieciešams pakalpojumu sniedzējs, modelis un API atslēga.', 'AI SDK (laravel/ai) nav instalēts.'],
    'mk' => ['Тестирај', 'AI врската работи.', 'AI врската не успеа.', 'За тестирање на врската се потребни провајдер, модел и API клуч.', 'AI SDK (laravel/ai) не е инсталиран.'],
    'mn' => ['Туршиx', 'ИИ холболт ажиллаж байна.', 'ИИ холболт амжилтгүй.', 'Холболтыг шалгахын тулд үйлчилгээ үзүүлэгч, загвар, API түлхүүр шаардлагатай.', 'ИИ SDK (laravel/ai) суулгаагүй байна.'],
    'ms' => ['Uji', 'Sambungan AI berfungsi.', 'Sambungan AI gagal.', 'Pembekal, model, dan kunci API diperlukan untuk menguji sambungan.', 'AI SDK (laravel/ai) belum dipasang.'],
    'my' => ['စမ်းသပ်ပါ', 'AI ချိတ်ဆက်မှု အလုပ်လုပ်နေသည်။', 'AI ချိတ်ဆက်မှု မအောင်မြင်ပါ။', 'ချိတ်ဆက်မှုကို စမ်းသပ်ရန် ဝန်ဆောင်မှုပေးသူ၊ မော်ဒယ် နှင့် API ကီး လိုအပ်သည်။', 'AI SDK (laravel/ai) ကို မထည့်သွင်းရသေးပါ။'],
    'nb' => ['Test', 'AI-tilkoblingen fungerer.', 'AI-tilkoblingen mislyktes.', 'Leverandør, modell og API-nøkkel kreves for å teste tilkoblingen.', 'AI SDK (laravel/ai) er ikke installert.'],
    'ne' => ['परीक्षण', 'AI जडान काम गरिरहेको छ।', 'AI जडान असफल भयो।', 'जडान परीक्षण गर्न प्रदायक, मोडेल र API कुञ्जी आवश्यक छ।', 'AI SDK (laravel/ai) स्थापित छैन।'],
    'nl' => ['Testen', 'AI-verbinding werkt.', 'AI-verbinding mislukt.', 'Provider, model en API-sleutel zijn vereist om de verbinding te testen.', 'AI SDK (laravel/ai) is niet geïnstalleerd.'],
    'pl' => ['Testuj', 'Połączenie AI działa.', 'Błąd połączenia AI.', 'Dostawca, model i klucz API są wymagane do przetestowania połączenia.', 'SDK AI (laravel/ai) nie jest zainstalowany.'],
    'pt' => ['Testar', 'A ligação à IA funciona.', 'Falha na ligação à IA.', 'Fornecedor, modelo e chave de API são obrigatórios para testar a ligação.', 'O SDK de IA (laravel/ai) não está instalado.'],
    'pt_BR' => ['Testar', 'A conexão de IA funciona.', 'Falha na conexão de IA.', 'Fornecedor, modelo e chave da API são obrigatórios para testar a conexão.', 'O SDK de IA (laravel/ai) não está instalado.'],
    'ro' => ['Testează', 'Conexiunea AI funcționează.', 'Conexiunea AI a eșuat.', 'Furnizorul, modelul și cheia API sunt necesare pentru a testa conexiunea.', 'SDK-ul AI (laravel/ai) nu este instalat.'],
    'ru' => ['Тест', 'Подключение к ИИ работает.', 'Ошибка подключения к ИИ.', 'Для проверки подключения требуются провайдер, модель и API-ключ.', 'SDK ИИ (laravel/ai) не установлен.'],
    'sk' => ['Otestovať', 'Spojenie s AI funguje.', 'Spojenie s AI zlyhalo.', 'Pre otestovanie spojenia sú vyžadovaní poskytovateľ, model a API kľúč.', 'AI SDK (laravel/ai) nie je nainštalovaný.'],
    'sl' => ['Testiraj', 'AI povezava deluje.', 'AI povezava ni uspela.', 'Za testiranje povezave so potrebni ponudnik, model in API ključ.', 'AI SDK (laravel/ai) ni nameščen.'],
    'sq' => ['Testo', 'Lidhja e AI funksionon.', 'Lidhja e AI dështoi.', 'Ofruesi, modeli dhe çelësi API janë të nevojshëm për të testuar lidhjen.', 'AI SDK (laravel/ai) nuk është i instaluar.'],
    'sr_Cyrl' => ['Тестирај', 'AI веза ради.', 'AI веза није успела.', 'Провајдер, модел и API кључ су обавезни за тестирање везе.', 'AI SDK (laravel/ai) није инсталиран.'],
    'sr_Latn' => ['Testiraj', 'AI veza radi.', 'AI veza nije uspela.', 'Provajder, model i API ključ su obavezni za testiranje veze.', 'AI SDK (laravel/ai) nije instaliran.'],
    'sv' => ['Testa', 'AI-anslutningen fungerar.', 'AI-anslutningen misslyckades.', 'Leverantör, modell och API-nyckel krävs för att testa anslutningen.', 'AI SDK (laravel/ai) är inte installerat.'],
    'sw' => ['Jaribu', 'Muunganisho wa AI unafanya kazi.', 'Muunganisho wa AI umeshindwa.', 'Mtoa huduma, modeli, na ufunguo wa API zinahitajika kujaribu muunganisho.', 'AI SDK (laravel/ai) haijasakinishwa.'],
    'th' => ['ทดสอบ', 'การเชื่อมต่อ AI ทำงานปกติ', 'การเชื่อมต่อ AI ล้มเหลว', 'ต้องระบุผู้ให้บริการ โมเดล และคีย์ API เพื่อทดสอบการเชื่อมต่อ', 'ยังไม่ได้ติดตั้ง AI SDK (laravel/ai)'],
    'tr' => ['Test Et', 'AI bağlantısı çalışıyor.', 'AI bağlantısı başarısız.', 'Bağlantıyı test etmek için sağlayıcı, model ve API anahtarı gerekli.', 'AI SDK (laravel/ai) yüklü değil.'],
    'uk' => ['Тест', "З'єднання з ШІ працює.", "З'єднання з ШІ не вдалося.", "Для перевірки з'єднання потрібні постачальник, модель та API-ключ.", 'SDK ШІ (laravel/ai) не встановлено.'],
    'ur' => ['ٹیسٹ کریں', 'AI کنکشن کام کر رہا ہے۔', 'AI کنکشن ناکام ہو گیا۔', 'کنکشن ٹیسٹ کرنے کے لیے فراہم کنندہ، ماڈل، اور API کلید درکار ہیں۔', 'AI SDK (laravel/ai) انسٹال نہیں ہے۔'],
    'uz' => ["Sinab ko'rish", 'AI ulanishi ishlamoqda.', 'AI ulanishi muvaffaqiyatsiz.', "Ulanishni sinab ko'rish uchun provayder, model va API kalit kerak.", "AI SDK (laravel/ai) o'rnatilmagan."],
    'vi' => ['Kiểm tra', 'Kết nối AI hoạt động.', 'Kết nối AI thất bại.', 'Cần có nhà cung cấp, mô hình và khóa API để kiểm tra kết nối.', 'Chưa cài đặt AI SDK (laravel/ai).'],
    'zh_CN' => ['测试', 'AI 连接正常。', 'AI 连接失败。', '需要提供商、模型和 API 密钥才能测试连接。', '未安装 AI SDK (laravel/ai)。'],
    'zh_HK' => ['測試', 'AI 連線正常。', 'AI 連線失敗。', '需要提供者、模型及 API 金鑰才能測試連線。', '未安裝 AI SDK (laravel/ai)。'],
    'zh_TW' => ['測試', 'AI 連線正常。', 'AI 連線失敗。', '需要提供者、模型及 API 金鑰才能測試連線。', '尚未安裝 AI SDK (laravel/ai)。'],
];

$keys = ['test_connection', 'test_connection_success', 'test_connection_failed', 'test_connection_missing', 'test_connection_no_sdk'];

$base = __DIR__.'/../resources/lang';
$wrote = 0;
$skipped = 0;

foreach ($translations as $locale => $values) {
    $file = $base.'/'.$locale.'/fin-sentinel.php';
    if (! is_file($file)) {
        echo "SKIP missing: {$file}\n";
        $skipped++;

        continue;
    }

    $existing = require $file;

    if (! is_array($existing) || ! isset($existing['settings']) || ! is_array($existing['settings'])) {
        echo "SKIP malformed: {$file}\n";
        $skipped++;

        continue;
    }

    $aiBlock = $existing['settings']['ai'] ?? [];
    foreach ($keys as $i => $key) {
        $aiBlock[$key] = $values[$i];
    }
    $existing['settings']['ai'] = $aiBlock;

    $php = "<?php\n\ndeclare(strict_types=1);\n\nreturn ".var_export_short($existing, 0).";\n";
    file_put_contents($file, $php);
    echo "WROTE: {$file}\n";
    $wrote++;
}

echo "\nDone: {$wrote} written, {$skipped} skipped.\n";

function var_export_short(mixed $value, int $indent): string
{
    if (is_array($value)) {
        if ($value === []) {
            return '[]';
        }

        $isList = array_is_list($value);
        $pad = str_repeat('    ', $indent);
        $padInner = str_repeat('    ', $indent + 1);
        $parts = [];

        foreach ($value as $k => $v) {
            $key = $isList
                ? ''
                : (is_int($k) ? $k.' => ' : "'".addcslashes((string) $k, "'\\")."' => ");
            $parts[] = $padInner.$key.var_export_short($v, $indent + 1);
        }

        return "[\n".implode(",\n", $parts).",\n".$pad.']';
    }

    if (is_string($value)) {
        return "'".addcslashes($value, "'\\")."'";
    }

    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    if ($value === null) {
        return 'null';
    }

    return var_export($value, true);
}
