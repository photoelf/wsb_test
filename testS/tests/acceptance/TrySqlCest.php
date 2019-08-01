<?php

use Page\TrySQL as TS;

class TrySqlCest
{
    public function giovanniIsOnLudovico(Tester $I)
    {
        $I->wantTo('Test that Giovanni lives on Via Ludovico');

        $I->amSelectingAllCustomers();

        $I->amGoingTo('check if ContactName=СGiovanni Rovelli has Address=Via Ludovico il Moro 22');
        $I->canSee('Via Ludovico il Moro 22', "//td[contains(text(), 'Giovanni Rovelli')]/following-sibling::td[1]"); //Address is next td after ContactName

    }

    public function countCustomersFromLondon(Tester $I)
    {
        $I->wantTo('Test that we have 6 customers from London');

        $I->amRunningTheSqlStatement('SELECT * FROM Customers WHERE City = "London";');

        $I->amGoingTo('check if we have only 6 customers from London');
        $I->canSee('Number of Records: 6', TS::$resultCount); //Can be reduced to int via regEx

    }

    public function createNewRecord(Tester $I)
    {
        $I->wantTo('Test new record insetrtion');

        $I->amRunningTheSqlStatement('INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country) VALUES ("Aname", "Aname", "Some 21", "Liss", "4606", "Noway");');
        $I->seeDatabaseChangedSuccessfuly();

        $I->amGoingTo('check if it was created properly');
        $I->amSelectingAllCustomers();
        $I->canSee('Liss', "//td[contains(text(), 'Some 21')]/following-sibling::td[1]");
        $I->canSee('Noway', "//td[contains(text(), '4606')]/following-sibling::td[1]");
    }

    public function updateOneRecord(Tester $I)
    {
        $I->wantTo('Test old record updating');

        $I->amRunningTheSqlStatement('UPDATE Customers SET CustomerName="Ivan", ContactName="Pony", Address="Some str. 0092", City="Luleå", PostalCode="0", Country="Lio" WHERE CustomerID="7";');
        $I->seeDatabaseChangedSuccessfuly();

        $I->amGoingTo('check if it was updated properly');
        $I->amSelectingAllCustomers();
        $I->canSee('7', "//td[contains(text(), 'Ivan')]/preceding-sibling::td[1]");
        $I->canSee('Some str. 0092', "//td[contains(text(), 'Pony')]/following-sibling::td[1]");
        $I->canSee('0', "//td[contains(text(), 'Lio')]/preceding-sibling::td[1]");
    }
}
