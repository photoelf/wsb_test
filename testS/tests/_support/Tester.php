<?php

use Codeception\Actor;
use Page\TrySQL as TS;

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
    use _generated\TesterActions;

    public function amRunningTheSqlStatement($query)
    {
        $I = $this;

        $I->amGoingTo('open TrySQL page');
        $I->amOnPage(TS::$URL);

        $I->amGoingTo('run SQL');
        $I->executeJS("window.editor.setValue('" . $query . "')");
        $I->clickWithLeftButton(TS::$runButton);

        $I->amGoingTo('expect Result');
        $I->seeElement(TS::$resultBlock); //assert that search results is loaded

    }

    public function amSelectingAllCustomers()
    {
        $I = $this;

        $I->amRunningTheSqlStatement("SELECT * FROM Customers;");

    }

    public function seeDatabaseChangedSuccessfuly()
    {
        $I = $this;

        $I->amGoingTo('check if insert was successful');
        $I->canSee('You have made changes to the database. Rows affected: 1', TS::$resultConfirmBlock); //Can be reduced to int via regEx

    }
}
