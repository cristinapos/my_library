<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Author[] $authors
 * @property \App\Model\Entity\Book[] $books
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Tags[] $tags
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'email' => true,
        'password' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'authors' => true,
        'books' => true,
        'categories' => true,
        'tags' => true,
        'recovery_hash' => true,
        'username' => true,
        'group_id' => true,
        'first_name' => true,
        'last_name' => true,
        'country' => true,
        'county' => true,
        'city' => true,
        'street' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
