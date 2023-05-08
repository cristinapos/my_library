<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CountiesFixture
 */
class CountiesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'country_id' => 1,
                'created' => '2023-05-07 01:00:33',
                'modified' => '2023-05-07 01:00:33',
            ],
        ];
        parent::init();
    }
}
