<?php

namespace Weile\Repositories;


interface SellerRepositoryInterface
{
    public function findAllPaginated($perPage = 9);

    public function findMostRecent($perPage = 9);

    public function findByKeywordPaginated($q, $perPage=9);
}
