<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderUserData Entity
 *
 * @property int $id
 * @property int $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $country
 * @property string $county
 * @property string $city
 * @property string $street
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Order $order
 */
class OrderUserData extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'order_id' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'country' => true,
        'county' => true,
        'city' => true,
        'street' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
    ];
}
