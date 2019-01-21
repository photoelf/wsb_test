<?php
use Page\YaVidMain as YP; //simple PO implementation

class YandexVideoCest
{
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('watch some hurricanes at Yandex Video');
        $I->amOnUrl('https://yandex.ru/video/');
        $I->submitForm(YP::$searchForm, array('text' => 'ураган')); //enter search query and submit
        $I->waitForElementClickable(YP::$videoBlock); //wait for element to be ready for interaction
        $I->waitForElementNotVisible(YP::$videoPreview); //verify that video-preview is not visible
        $I->moveMouseOver(YP::$videoBlock); //hover mouse to start video
        $I->waitForElementVisible(YP::$videoPreview); //verify that video is visible (started and viewable)
    }
}
