<?php

namespace Page;

class YandexVideoMain
{
    // include url of current page
    public static $URL = '/video/';

    public static $searchField = 'input[name="text"]';
    public static $suggestionItem = 'li.suggest2-item:nth-child(2)';
    public static $searchButton = 'button.websearch-button.suggest2-form__button';
    public static $searchResultBlock = 'div.serp-list.serp-list_type_search';
    public static $videoResultBlock = 'div.serp-item_pos_3';
    public static $videoResultPreview = 'div.serp-item_pos_3>a>div>div>div.thumb-image__preview.thumb-preview__target>video';
    public static $videoBigPreview = 'div.pane__preview>div.preview_prerender';
    public static $videoBigPreviewStarted = 'div.pane__preview>div.preview_prerender.preview_playing_yes';
}
