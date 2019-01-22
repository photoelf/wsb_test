<?php
namespace Page;

class YaVidMain
{
    // include url of current page
    public static $URL = '/video/';

    public static $searchField = 'input[name="text"]';
    public static $suggestionItem = 'li.suggest2-item:nth-child(2)';
    public static $searchButton = 'button.websearch-button.suggest2-form__button';
    public static $searchResulBlock = 'div.serp-list.serp-list_type_search';
    public static $videoBlock = 'div.serp-item_pos_3';
    public static $videoPreview = 'div.serp-item_pos_3>div>div>div.thumb-image__preview.thumb-preview__target>video';


}
