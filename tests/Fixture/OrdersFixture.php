<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'total_price' => 1,
                'created' => '2023-05-07 02:38:47',
                'modified' => '2023-05-07 02:38:47',
            ],
        ];
        parent::init();
    }
}
