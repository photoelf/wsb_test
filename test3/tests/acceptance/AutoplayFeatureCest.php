<?php

use Codeception\Example;
use Page\YandexVideoMain as YVP;

class AutoplayFeatureCest
{
    /**
     * @example { "query": "ураган" }
     */
    public function noAutoplayRightAfterSearch(Tester $I, Example $example)
    {
        $I->wantTo('Autotest to check the autoplay feature after search');

        $I->amSearchForVideoAbout($example['query']);

        $I->amGoingTo('check that video is not started');
        $I->seeElement(YVP::$videoBigPreview); //video has preview
        $I->dontSeeElement(YVP::$videoBigPreviewStarted); //video is not started
    }

    /**
     * @example { "query": "ураган" }
     */
    public function startAutoplayAfterPickingResult(Tester $I, Example $example)
    {
        $I->wantTo('Autotest to check the autoplay feature after result picking');

        $I->amSearchForVideoAbout($example['query']);

        $I->amGoingTo('pick one of search results');
        $I->clickWithLeftButton(YVP::$videoResultBlock);

        $I->amGoingTo('check that video is started');
        $I->seeElement(YVP::$videoBigPreview); //video has preview
        $I->seeElement(YVP::$videoBigPreviewStarted); //video is not started

    }
}
