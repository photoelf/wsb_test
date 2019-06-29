<?php

namespace Page;

class YandexMain
{
    // include url of current page
    public static $URL = '/';

    public static $searchField = 'input[name="text"]';
    public static $suggestionItem = 'li.suggest2-item:nth-child(2)';
    public static $searchButton = 'button.button_theme_websearch.suggest2-form__button';
    public static $searchResultBlock = 'div.serp-list.serp-list_type_search';
    public static $videoTab = 'div.service_name_video>a';


}
