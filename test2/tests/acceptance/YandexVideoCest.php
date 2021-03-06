<?php
use Page\YandexVideoMain as YP; //simple PO implementation

class YandexVideoCest
{
    public function tryToTest(Tester $I)
    {
        $I->wantTo('Autotest to check the presence of a video trailer');

        $I->amGoingTo('open yandex video');
        $I->amOnPage(YP::$URL);

        $I->amGoingTo('search “hurricane”');
        $I->fillField(YP::$searchField, 'ураган');
        $I->seeElement(YP::$suggestionItem); //assert that suggestions is visible
        $I->clickWithLeftButton(YP::$searchButton);

        $I->amGoingTo('wait for the search results');
        $I->seeElement(YP::$searchResultBlock); //assert that search results is loaded

        $I->amGoingTo('move the mouse over any video from the left block');
        $I->seeElement(YP::$videoResultBlock);
        $I->dontSeeElement(YP::$videoResultPreview); //verify that video-preview is not visible
        $I->moveMouseOver(YP::$videoResultBlock); //hover mouse to start video

        $I->amGoingTo('check that the video has a trailer (the preview image changes)');
        $I->waitForElementVisible(YP::$videoResultPreview, 2); //explicitly wait for video-preview to start
        $I->seeElement(YP::$videoResultPreview); //assert that video is visible (viewable when started)

    }
}
