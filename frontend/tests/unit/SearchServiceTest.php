<?php namespace frontend\tests;

use frontend\components\Finder;
use frontend\components\Search;
use frontend\components\SearchService;


class SearchServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testFind()
    {
        $finder = $this->getMockBuilder(Finder::class)
            ->setMethods(['find'])->getMock();

        $finder->expects($this->once())->method('find')
            ->with('Nikolay')->willReturn('Zatonski');
        $searchServ = new SearchService($finder);

        expect($searchServ)->isInstanceOf(Search::class);

        $secondName = $searchServ->find('Nikolay');

        expect($secondName)->notNull();

        expect($secondName)->equals('Zatonski');
    }
}