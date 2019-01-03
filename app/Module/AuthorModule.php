<?php
/**
 * Created by PhpStorm.
 * User: qw
 * Date: 2019/1/2
 * Time: 22:36
 */

namespace App\Module;


use App\Model\Author;

class AuthorModule
{
    public static function getList($pageNum = 1, $perPage = 20)
    {
        $offset = ($pageNum - 1) * $perPage;
        return Author::skip($offset)->take($perPage)->get();
    }

    public static function insertAuthor($name,$desc = '',$dynastyId)
    {
        $exist = Author::where("name",$name)->where("dynasty_id",$dynastyId)->exists();
        if(!$exist)
            Author::insert(['name'=>$name,'dynasty_id'=>$dynastyId,'desc'=>$desc]);
    }
}