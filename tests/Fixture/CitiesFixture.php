<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CitiesFixture
 */
class CitiesFixture extends TestFixture
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
                'county_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-05-07 01:22:25',
                'modified' => '2023-05-07 01:22:25',
            ],
        ];
        parent::init();
    }
}
