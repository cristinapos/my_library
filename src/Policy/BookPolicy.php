<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Book;
use Authorization\IdentityInterface;

/**
 * Book policy
 */
class BookPolicy
{
    /**
     * Check if $user can add Book
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Book $book
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Book $book)
    {
        return true;
    }

    /**
     * Check if $user can edit Book
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Book $book
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Book $book)
    {
        return $this->isAuthor($user, $book);
    }

    /**
     * Check if $user can delete Book
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Book $book
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Book $book)
    {
        return $this->isAuthor($user, $book);
    }

    protected function isAuthor(IdentityInterface $user, Article $book)
    {
        return $book->user_id === $user->getIdentifier();
    }
}
