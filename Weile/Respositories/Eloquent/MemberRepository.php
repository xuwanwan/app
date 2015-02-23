<?php

namespace Weile\Repositories\Eloquent;

use Weile\Member;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


use Weile\Services\Forms\SettingsForm;
use Weile\Services\Forms\RegistrationForm;
use Weile\Exceptions\MemberNotFoundException;
use Weile\Repositories\MemberRepositoryInterface;

class MemberRepository extends AbstractRepository implements MemberRepositoryInterface
{
    public function __construct(Member $member)
    {
        $this->model = $member;
    }

    public function findAllPaginated($perPage = 200)
    {
        return $this->model
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    public function findByUsername($username)
    {
        return $this->model->whereUsername($username)->first();
    }

    public function findByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

    public function findByPhone($phone)
    {
        return $this->model->wherePhone($phone)->first();
    }

    public function findById($id)
    {
        return $this->model->whereId($id)->first();
    }


    public function requireByUsername($username)
    {
        if (! is_null($user = $this->findByUsername($username))) {
            return $user;
        }

        throw new UserNotFoundException('The user "' . $username . '" does not exist!');
    }

    public function create(array $data)
    {
        $member = $this->getNew();

        $member->phone = $data['phone'];
        $member->username = $data['username'];
        $member->password = $data['password'];
        $member->save();

        //处理关联粉丝
        $invite_member = $this->findByPhone($data['invite_phone']);
        $member->addFriend($invite_member);

        //增加粉丝数
        $this->incrementFansCount($member->id);        

        return $member;
    }

    protected function incrementFansCount($id) {
        $current_id = $id;
        $i = 0;
        while ($friend = $this->findById($current_id)->friends->first()) {
            if ($i == 0) {
               $friend->increment('fans_direct');
            } elseif ($i > 0) {
               $friend->increment('fans_related');
            }
            $i++;
            $current_id = $friend->id;
        }
    }



    protected function usernameIsAllowed($username)
    {
        return ! in_array(strtolower($username), Config::get('config.forbidden_usernames'));
    }

    public function updateSettings(Member $member, array $data)
    {
        $user->username = $data['username'];
        $user->password = ($data['password'] != '') ? Hash::make($data['password']) : $user->password;

        if ($data['avatar'] != '') {
            File::move(public_path().'/img/avatar/temp/'.$data['avatar'], 'img/avatar/'.$data['avatar']);

            if ($user->photo) {
                File::delete(public_path().'/img/avatar/'.$user->photo);
            }

            $user->photo = $data['avatar'];
        }

        return $user->save();
    }


    public function getRegistrationForm()
    {
        return app('Weile\Services\Forms\RegistrationForm');
    }

    public function getSettingsForm()
    {
        return app('Tricks\Services\Forms\SettingsForm');
    }
}
