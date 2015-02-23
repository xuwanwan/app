<?php
namespace Weile;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Weile\Services\Textmessage\RemindableTrait;
use Weile\Services\Textmessage\RemindableInterface;
use Carbon\Carbon;

class Member extends \Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    protected $guarded = [];



    //邀请人
    public function friends()
    {
        return $this->belongsToMany('Weile\Member', 'friends_users', 'member_id', 'friend_id');
    }

    public function addFriend(Member $user)
    {
        $this->friends()->attach($user->id, ['updated_at' => new Carbon]);
        //昨日新增粉丝数处理
        $user->newfans_yesterday += 1;
        //srcore加10
        $user->score += 10;
        $user->save();

    }

    public function removeFriend(Member $user)
    {
        $this->friends()->detach($user->id);
    }

    //受邀请人
    public function reverseFriends()
    {
        return $this->belongsToMany('Weile\Member', 'friends_users', 'friend_id', 'member_id');
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function getPhotoAttribute() {
        return $this->attributes['photo'] = asset($this->attributes['photo']);
    }

    public function detail() {
        return $this->hasOne('Weile\MemberDetail', 'member_id', 'id');
    }
    public function delivery() {
        return $this->hasMany('Weile\MemberDelivery', 'member_id', 'id');
    }

}
