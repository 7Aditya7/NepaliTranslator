
# Nepali Translator - AI-Powered English to Nepali Translation

**Nepali Translator**, made by **Aditya Khadka**, is an AI-driven, ultra-fast translation package designed for the Laravel framework. This powerful package seamlessly converts English text into **natural, culturally accurate Nepali**, harnessing the latest in AI technology. It’s not just translation – it’s context-aware, human-like interpretation. Whether you're translating a single line or localizing an entire web app, **Nepali Translator** is the professional-grade tool you've been waiting for.

## Why Nepali Translator?

In a world of automated translation, accuracy and cultural sensitivity often fall by the wayside. **Nepali Translator** changes the game, utilizing state-of-the-art **Groq LLaMA 3 AI** to deliver translations that feel like they were written by a native speaker.

- **Precision Translations**: Translates English text to Nepali with remarkable fluency and accuracy.
- **AI-Powered Contextual Understanding**: The translation is based on understanding the context, ensuring that sentences aren't just translated word for word.
- **Super Fast**: Thanks to **built-in caching**, translations are lightning fast. Your frequently translated phrases are cached for **instant** responses.
- **Error-Free**: Extensive error handling ensures that even if the API or network fails, the original text is returned, preventing your application from breaking.

## Installation

Install via Composer:

```bash
composer require 7aditya7/nepali-translator
```

### Step 2: Publish the Configuration File

To configure the API and cache settings, publish the configuration file with this command:

```bash
php artisan vendor:publish --provider="Aditya7\NepaliTranslator\NepaliTranslatorServiceProvider" --tag="config"
```

This will create a `nepalitranslator.php` configuration file in your `config` directory.

### Step 3: Add API Credentials

To use the **Nepali Translator** package, you'll need to create an API key from the Groq platform.

1. Visit [Groq Console](https://console.groq.com/keys).
2. On the left-hand section, navigate to **API Keys**.
3. Create a new API key and copy it.
4. Add the key to your `.env` file as follows:

```env
NEPALI_TRANSLATOR_API_KEY=your_api_key_here


You can fine-tune additional settings, such as timeouts and caching, in the configuration file.

## Usage

Using the **Nepali Translator** is incredibly simple! Just call the Facade to translate any string.

```php
use Aditya7\NepaliTranslator\Facades\NepaliTranslator;

$translatedText = NepaliTranslator::translate('Hello. My name is Aditya.');
echo $translatedText; // Output: हेलो. मेरो नाम आदित्य हो।
```

It’s that easy! The AI engine will automatically detect the context of your message and return the most accurate translation possible.

## Caching for Lightning Fast Translations

Speed is critical. That’s why **Nepali Translator** caches every translation for 24 hours by default. This means repeated translations are nearly **instantaneous**. The next time you translate a common phrase, it’s pulled directly from the cache, eliminating unnecessary API calls and saving on rate limits.

Want to clear the cache? No problem! If for any reason a cached translation doesn't seem correct, simply run:

```bash
php artisan cache:clear
```

This will reset the cache, and the next request will pull fresh translations from the API.


## Error Handling 

**Nepali Translator** includes robust error handling. If anything goes wrong with the API, whether it’s a timeout or a network issue, the package automatically returns the original English text. This ensures your application **never breaks** due to a failed translation.

In case of an error, detailed logs are stored for your review:

```php
try {
    $translation = NepaliTranslator::translate('Hello, world!');
} catch (\Exception $e) {
    Log::error('Translation failed: ' . $e->getMessage());
}
```

**Pro Tip**: Always check your logs for any issues with translation requests.

## Future-Proof

We’ve designed **Nepali Translator** to be ready for the future. The AI engine is constantly evolving, and we’re continuously adding new features to make your translation process even smoother. In future updates, expect features like **batch translations** for handling multiple texts at once and more advanced language settings.

## Wow-Factor: Why This is THE Translation Package

This isn’t just another translation tool – **Nepali Translator** is a step into the future of AI-driven translations. With its deep contextual understanding, **lightning-fast** performance thanks to intelligent caching, and seamless integration with your Laravel app, this package will leave you wondering how you ever managed without it.

Here’s why **Nepali Translator** stands out:

- **Unmatched Accuracy**: This isn’t a simple word-for-word translation. The AI model understands your text’s meaning and delivers translations that make sense.
- **Plug & Play**: It’s as simple as installing and calling the Facade. No complex setup.
- **Mind-Blowing Performance**: With built-in caching, translations are super fast. Your app will feel snappy even when handling high volumes of translations.
- **Battle-Tested**: Designed to handle both small and large applications without missing a beat.

## Testing


We take testing seriously so that you can trust this package in production environments.

## Contributing

We welcome contributions from the community! Found a bug or have a feature request? Feel free to open an issue or submit a pull request on [GitHub](https://github.com/7aditya7/nepali-translator).

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Conclusion

When it comes to translating English to Nepali, **Nepali Translator** is your go-to solution. Harnessing the power of AI, this package brings natural, accurate translations to your fingertips, elevating your app's global reach. Fast, reliable, and incredibly easy to use – it's time to step into the future of translations with **Nepali Translator**.
