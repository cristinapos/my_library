<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersBooksFixture
 */
class OrdersBooksFixture extends TestFixture
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
                'order_id' => 1,
                'book_id' => 1,
                'quantity' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'price' => 1,
                'created' => '2023-05-07 02:58:22',
                'modifed' => '2023-05-07 02:58:22',
            ],
        ];
        parent::init();
    }
}
