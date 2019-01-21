<?php
namespace Page;

class YaVidMain
{
    // include url of current page
    public static $URL = 'https://yandex.ru/video/';

    public static $searchForm = 'form.search2';
    public static $videoBlock = 'div.serp-item_pos_3';
    public static $videoPreview = 'div.serp-item_pos_3>div>div>div.thumb-image__preview.thumb-preview__target>video';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
