<?php

use Codeception\Example;
use Page\YandexMain as YP;
use Page\YandexVideoMain as YVP;

class VideoSearchFeatureCest
{
    /**
     * @example { "query": "ураган" }
     */
    public function videoTabSearch(Tester $I, Example $example)
    {
        $I->wantTo('Autotest to check the video tab search');

        $I->amSearchForVideoAbout($example['query']);

        $I->amGoingTo('check if query is persistent in search field');
        $I->seeInField(YVP::$searchField, $example['query']); //assert same query in search field

        $I->amGoingTo('check if query is persistent in search results');
        $I->see($example['query'], YVP::$videoResultBlock); //assert search result block has query

    }

    /**
     * @example { "query": "ураган" }
     */
    public function queryPersistency(Tester $I, Example $example)
    {
        $I->wantTo('Autotest to check the persistency of query on Video tab after search in Main tab');

        $I->amGoingTo('open yandex');
        $I->amOnPage(YP::$URL);

        $I->amGoingTo('search for query');
        $I->fillField(YP::$searchField, $example['query']);
        $I->clickWithLeftButton(YP::$searchButton);

        $I->amGoingTo('click on Video tab');
        $I->clickWithLeftButton(YP::$videoTab);
        $I->switchToNextTab(); //move to the Video tab
        $I->seeInCurrentUrl(YVP::$URL); //assert that Video tab is open and active

        $I->amGoingTo('check if query is persistent in search field');
        $I->seeInField(YVP::$searchField, $example['query']); //assert same query in search field

        $I->amGoingTo('check if query is persistent in search results');
        $I->see($example['query'], YVP::$videoResultBlock); //assert search result block has query
    }
}
