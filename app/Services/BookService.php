<?php

namespace App\Services;

use App\Contracts\BookRepositoryInterface;
use App\Contracts\BookServiceInterface;
use App\Repositories\BookRepository;

class BookService extends BaseService implements BookServiceInterface
{
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    )
    {
        parent::__construct($bookRepository);
    }

}
