<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    //
    protected $table = "admin_roles";

    /*
     * 当前用户的所有权限
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\AdminPermissions::class,'admin_permission_role','role_id','permission_id')->withPivot(['permission_id','role_id']);
    }

    /*
     * 给角色赋予权限
     */
    public function grantPermission($permission){
        return $this->permissions()->save($permission);
    }

    /*
     * 取消角色赋予的权限
     */
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }
    
    /*
     * 判断角色是否有权限
     */
    public function hasPermission($permission)
    {
        return $this->permissions->contaims($permission);
    }
}
