<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdersBooksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdersBooksTable Test Case
 */
class OrdersBooksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdersBooksTable
     */
    protected $OrdersBooks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OrdersBooks',
        'app.Orders',
        'app.Books',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrdersBooks') ? [] : ['className' => OrdersBooksTable::class];
        $this->OrdersBooks = $this->getTableLocator()->get('OrdersBooks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrdersBooks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrdersBooksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrdersBooksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
