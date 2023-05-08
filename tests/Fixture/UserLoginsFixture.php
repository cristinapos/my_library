<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserLoginsFixture
 */
class UserLoginsFixture extends TestFixture
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
                'timestamp' => 1683438080,
                'ip' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-05-07 05:41:20',
                'modified' => '2023-05-07 05:41:20',
            ],
        ];
        parent::init();
    }
}
