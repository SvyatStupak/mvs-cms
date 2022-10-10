<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

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
}
