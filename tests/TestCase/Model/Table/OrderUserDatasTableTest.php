<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderUserDatasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderUserDatasTable Test Case
 */
class OrderUserDatasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderUserDatasTable
     */
    protected $OrderUserDatas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OrderUserDatas',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderUserDatas') ? [] : ['className' => OrderUserDatasTable::class];
        $this->OrderUserDatas = $this->getTableLocator()->get('OrderUserDatas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderUserDatas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderUserDatasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderUserDatasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
