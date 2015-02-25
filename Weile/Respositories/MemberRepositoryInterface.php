<?php

namespace Weile\Repositories;

use Weile\Member;

interface MemberRepositoryInterface
{
    public function findAllPaginated($perPage = 200);

    public function findByUsername($username);

    public function findByEmail($email);


    public function create(array $data);




    public function createDelivery(Member $member, array $data);
    public function getRegistrationForm();

    public function getMemberDeliveryForm();
}

