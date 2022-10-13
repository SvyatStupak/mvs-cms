<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use modules\page\models\Page;

require '/Applications/MAMP/htdocs/project/src/Entity.php';
require '/Applications/MAMP/htdocs/project/modules/page/models/Page.php';

class FakeStmt
{
    function execute() {}
    function fetchAll()
    {
        return [
            ['id' => 12, 'title' => 'test title', 'content' => 'test content'],
            ['id' => 2, 'title' => 'test title2', 'content' => 'test content2'],
        ];
    }
}

class FakeDatabaseConection
{
    function prepare() 
    {
        return new FakeStmt();
    }
}

final class ActiveRecordTest extends TestCase
{
    public function testFindAll(): void
    {
        $dbc = new FakeDatabaseConection();
        $page = new Page($dbc);
        $results = $page->findAll();

        $this->assertEquals(2, count($results));
        $this->assertEquals(12, $results[0]->id);
    }

    public function testFindBy(): void
    {
        $dbc = new FakeDatabaseConection();
        $page = new Page($dbc);
        $page->findBy('id', 12);

        $this->assertEquals(12, $page->id);
        
    }

    public function testSave(): void
    {
        $mockDatabase = $this->getMockBuilder(Observer::class)
            ->enableProxyingToOriginalMethods()
            ->getMock();

        $mockDatabase->expects($this->exactly(2))
             ->method('prepare')
            ->with(
                $this->logicalOr(
                    $this->equalTo("SELECT FROM pages WHERE id = :id"),
                    $this->equalTo("UPDATE pages SET title = :title, content = :content WHERE id = :id")
                )
            );

        $page = new Page($mockDatabase);
        $page->findBy('id', 2);

        $page->title = 'New title';
        $page->save();
    }
}
