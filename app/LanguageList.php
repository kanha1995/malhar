<?php

namespace App;

use Illuminate\Http\Request;

class LanguageList
{
    public static $language =
    array(
            "aa"=>    "Afar",
            "ab"=>    "Abkhazian",
            "af"=>    "Afrikaans",
            "am"=>    "Amharic",
            "ar"=>    "Arabic",
            "as"=>    "Assamese",
            "ay"=>    "Aymara",
            "az"=>    "Azeri",
            "ba"=>    "Bashkir",
            "be"=>    "Belarusian",
            "bg"=>    "Bulgarian",
            "bh"=>    "Bihari",
            "bi"=>    "Bislama",
            "bn"=>    "Bengali",
            "bo"=>    "Tibetan",
            "br"=>    "Breton",
            "ca"=>    "Catalan",
            "co"=>    "Corsican",
            "cs"=>    "Czech",
            "cy"=>    "Welsh",
            "da"=>    "Danish",
            "de"=>    "German",
            "div"=>   "Divehi",
            "dz"=>    "Bhutani",
            "el"=>    "Greek",
            "en"=>    "English",
            "eo"=>    "Esperanto",
            "es"=>    "Spanish",
            "et"=>    "Estonian",
            "eu"=>    "Basque",
            "fa"=>    "Farsi",
            "fi"=>    "Finnish",
            "fj"=>    "Fiji",
            "fo"=>    "Faeroese",
            "fr"=>    "French",
            "fy"=>    "Frisian",
            "ga"=>    "Irish",
            "gd"=>    "Gaelic",
            "gl"=>    "Galician",
            "gn"=>    "Guarani",
            "gu"=>    "Gujarati",
            "ha"=>    "Hausa",
            "he"=>    "Hebrew",
            "hi"=>    "Hindi",
            "hr"=>    "Croatian",
            "hu"=>    "Hungarian",
            "hy"=>    "Armenian",
            "ia"=>    "Interlingua",
            "id"=>    "Indonesian",
            "ie"=>    "Interlingue",
            "ik"=>    "Inupiak",
            "in"=>    "Indonesian",
            "is"=>    "Icelandic",
            "it"=>    "Italian",
            "iw"=>    "Hebrew",
            "ja"=>    "Japanese",
            "ji"=>    "Yiddish",
            "jw"=>    "Javanese",
            "ka"=>    "Georgian",
            "kk"=>    "Kazakh",
            "kl"=>    "Greenlandic",
            "km"=>    "Cambodian",
            "kn"=>    "Kannada",
            "ko"=>    "Korean",
            "kok"=>   "Konkani",
            "ks"=>    "Kashmiri",
            "ku"=>    "Kurdish",
            "ky"=>    "Kirghiz",
            "kz"=>    "Kyrgyz",
            "la"=>    "Latin",
            "ln"=>    "Lingala",
            "lo"=>    "Laothian",
            "ls"=>    "Slovenian",
            "lt"=>    "Lithuanian",
            "lv"=>    "Latvian",
            "mg"=>    "Malagasy",
            "mi"=>    "Maori",
            "mk"=>    "FYRO Macedonian",
            "ml"=>    "Malayalam",
            "mn"=>    "Mongolian",
            "mo"=>    "Moldavian",
            "mr"=>    "Marathi",
            "ms"=>    "Malay",
            "mt"=>    "Maltese",
            "my"=>    "Burmese",
            "na"=>    "Nauru",
            "nb-no"=> "Norwegian (Bokmal)",
            "ne"=>    "Nepali (India)",
            "nl"=>    "Dutch",
            "nl-be"=> "Dutch (Belgium)",
            "nn-no"=> "Norwegian",
            "no"=>    "Norwegian (Bokmal)",
            "oc"=>    "Occitan",
            "om"=>    "(Afan)/Oromoor/Oriya",
            "or"=>    "Odia",
            "pa"=>    "Punjabi",
            "pl"=>    "Polish",
            "ps"=>    "Pashto/Pushto",
            "pt"=>    "Portuguese",
            "qu"=>    "Quechua",
            "rm"=>    "Rhaeto-Romanic",
            "rn"=>    "Kirundi",
            "ro"=>    "Romanian",
            "ru"=>    "Russian",
            "rw"=>    "Kinyarwanda",
            "sa"=>    "Sanskrit",
            "sb"=>    "Sorbian",
            "sd"=>    "Sindhi",
            "sg"=>    "Sangro",
            "sh"=>    "Serbo-Croatian",
            "si"=>    "Singhalese",
            "sk"=>    "Slovak",
            "sl"=>    "Slovenian",
            "sm"=>    "Samoan",
            "sn"=>    "Shona",
            "so"=>    "Somali",
            "sq"=>    "Albanian",
            "sr"=>    "Serbian",
            "ss"=>    "Siswati",
            "st"=>    "Sesotho",
            "su"=>    "Sundanese",
            "sv"=>    "Swedish",
            "sw"=>    "Swahili",
            "sx"=>    "Sutu",
            "syr"=>    "Syriac",
            "ta"=>    "Tamil",
            "te"=>    "Telugu",
            "tg"=>    "Tajik",
            "th"=>    "Thai",
            "ti"=>    "Tigrinya",
            "tk"=>    "Turkmen",
            "tl"=>    "Tagalog",
            "tn"=>    "Tswana",
            "to"=>    "Tonga",
            "tr"=>    "Turkish",
            "ts"=>    "Tsonga",
            "tt"=>    "Tatar",
            "tw"=>    "Twi",
            "uk"=>    "Ukrainian",
            "ur"=>    "Urdu",
            "us"=>    "English",
            "uz"=>    "Uzbek",
            "vi"=>    "Vietnamese",
            "vo"=>    "Volapuk",
            "wo"=>    "Wolof",
            "xh"=>    "Xhosa",
            "yi"=>    "Yiddish",
            "yo"=>    "Yoruba",
            "zh"=>    "Chinese",
            "zu"=>    "Zulu"
        );

    public static function getLanguageList(){

        $countryKeys = array_keys(LanguageList::$language);
        $countryValues = array_values(LanguageList::$language);

        $finalCountryList = array();

        for($index = 0; $index < count(LanguageList::$language); $index++){

            $currentCountry = (object) array('id'=>$countryKeys[$index], 'value'=>$countryValues[$index]);
            array_push($finalCountryList, $currentCountry);
        }
        return $finalCountryList;
    }

    public static function getLanguageDetails(Request $request){

        $value = LanguageList::$language[$request->all()['lang_code']];
        $id = array_search($value, LanguageList::$language);
        $currentCountry = (object) array('id'=>$id, 'value'=>$value);
        
        return $currentCountry;

    }
}
?>
