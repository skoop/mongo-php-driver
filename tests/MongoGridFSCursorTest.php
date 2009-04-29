<?php
require_once 'PHPUnit/Framework.php';

require_once 'Mongo/GridFS/Cursor.php';

/**
 * Test class for Mongo.
 * Generated by PHPUnit on 2009-04-09 at 18:09:02.
 */
class MongoGridFSCursorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    MongoGridFSFile
     * @access protected
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        $db = $this->sharedFixture->selectDB('phpunit');
        $grid = $db->getGridFS();
        $grid->drop();
        $grid->storeFile('./somefile');
        $this->object = $grid->find();
    }

    public function testGetNext() {
        $obj = $this->object->getNext();
        $this->assertTrue($obj instanceof MongoGridFSFile);
    }

    public function testCurrent() {
        $this->assertEquals($this->object->current(), null);
        $this->object->next();
        $obj = $this->object->current();
        $this->assertNotNull($obj);
        $this->assertTrue($obj instanceof MongoGridFSFile);
    }

    public function testKey() {
        foreach ($this->object as $k => $v) {
            $this->assertEquals($k, './somefile');
        }
    }
}
?>