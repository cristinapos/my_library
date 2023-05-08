<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int $author_id
 * @property int $location_id
 * @property int $user_id
 * @property string $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Author $author
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\User $user
 */
class Book extends Entity
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
        'isbn' => true,
        'title' => true,
        'description' => true,
        'category_id' => true,
        'author_id' => true,
        'tag_id' => true,
        'user_id' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'category' => true,
        'author' => true,
        'location' => true,
        'user' => true,
        'price' => true,
    ];
}
