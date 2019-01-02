<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{

    protected $table="admin_users";


    /*
     * 用户有哪些角色
     */
    public function roles()
    {
        return $this->belongsToMany(\App\AdminRoles::class,'admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    /*
     * 判断是否有某些角色
     */
    public function isInRoles($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    /*
     * 给用户分配角色
     */
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }

    /*
     * 取消用户分配的角色
     */
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }

    /*
     * 用户是否有权限
     */
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }
}
