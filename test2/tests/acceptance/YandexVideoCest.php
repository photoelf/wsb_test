<?php
use Page\YaVidMain as YP; //simple PO implementation

class YandexVideoCest
{
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Autotest to check the presence of a video trailer');

        $I->amGoingTo('open https://yandex.ru/video/');
        $I->amOnPage(YP::$URL);

        $I->amGoingTo('search “hurricane”');
        $I->fillField(YP::$searchField, 'ураган');
        $I->seeElement(YP::$suggestionItem); //assert that suggestions is visible
        $I->clickWithLeftButton(YP::$searchButton);

        $I->amGoingTo('wait for the search results');
        $I->seeElement(YP::$searchResulBlock); //assert that search results is loaded
        $I->seeInTitle('Ураган');

        $I->amGoingTo('move the mouse over any video from the left block');
        $I->seeElement(YP::$videoBlock);
        $I->dontSeeElement(YP::$videoPreview); //verify that video-preview is not visible
        $I->moveMouseOver(YP::$videoBlock); //hover mouse to start video

        $I->amGoingTo('check that the video has a trailer (the preview image changes)');
        $I->waitForElementVisible(YP::$videoPreview, 2); //explicitly wait for video-preview to start
        $I->seeElement(YP::$videoPreview); //assert that video is visible (started and viewable)

    }
}
