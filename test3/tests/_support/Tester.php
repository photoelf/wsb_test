<?php

use Codeception\Actor;
use Page\YandexVideoMain as YVP; //simple PO implementation

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class Tester extends Actor
{
    use _generated\AcceptanceTesterActions;

    public function amSearchForVideoAbout($query)
    {
        $I = $this;

        $I->amGoingTo('open yandex video');
        $I->amOnPage(YVP::$URL);

        $I->amGoingTo('search for query');
        $I->fillField(YVP::$searchField, $query);
        $I->seeElement(YVP::$suggestionItem); //assert that suggestions is visible
        $I->clickWithLeftButton(YVP::$searchButton);

        $I->amGoingTo('wait for the search results');
        $I->seeElement(YVP::$searchResultBlock); //assert that search results is loaded

    }
}
