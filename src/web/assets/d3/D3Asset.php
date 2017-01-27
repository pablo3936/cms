<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\web\assets\d3;

use Craft;
use craft\web\AssetBundle;
use craft\web\View;
use craft\helpers\ChartHelper;
use craft\helpers\Json;

/**
 * D3 asset bundle.
 */
class D3Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@bower/d3';

        $this->js = [
            'd3'.$this->dotJs(),
        ];

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);


        // Figure out which D3 i18n script to load

        $language = Craft::$app->language;

        if (in_array($language, ['ca-ES', 'de-CH', 'de-DE', 'en-CA', 'en-GB', 'en-US', 'es-ES', 'fi-FI', 'fr-CA', 'fr-FR', 'he-IL', 'hu-HU', 'it-IT', 'ja-JP', 'ko-KR', 'nl-NL', 'pl-PL', 'pt-BR', 'ru-RU', 'sv-SE', 'zh-CN'], true)) {
            $d3Language = $language;
        } else {
            $languageId = Craft::$app->getLocale()->getLanguageID();

            $d3LanguageIds = [
                'ca' => 'ca-ES',
                'de' => 'de-DE',
                'en' => 'en-US',
                'es' => 'es-ES',
                'fi' => 'fi-FI',
                'fr' => 'fr-FR',
                'he' => 'he-IL',
                'hu' => 'hu-HU',
                'it' => 'it-IT',
                'ja' => 'ja-JP',
                'ko' => 'ko-KR',
                'nl' => 'nl-NL',
                'pl' => 'pl-PL',
                'pt' => 'pt-BR',
                'ru' => 'ru-RU',
                'sv' => 'sv-SE',
                'zh' => 'zh-CN',
            ];

            if (array_key_exists($languageId, $d3LanguageIds)) {
                $d3Language = $d3LanguageIds[$languageId];
            } else {
                $d3Language = 'en-US';
            }
        }


        // Retrieve locale files

        $formatLocalePath = Craft::getAlias('@bower')."/d3-format/locale/{$d3Language}.json";
        $timeFormatLocalePath = Craft::getAlias('@bower')."/d3-time-format/locale/{$d3Language}.json";


        // Add locale definition JS variables

        $js = 'window.d3FormatLocaleDefinition = '.file_get_contents($formatLocalePath).';';
        $js .= 'window.d3TimeFormatLocaleDefinition = '.file_get_contents($timeFormatLocalePath).';';
        $js .= 'window.d3Formats = '.Json::encode(ChartHelper::formats()).';';

        $view->registerJs($js, View::POS_BEGIN);
    }
}
