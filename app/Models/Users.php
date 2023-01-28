<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAllUsers($filters = [], $keywords = null, $sortByArr = null, $perPage = null){
        $users = DB::table($this->table)
        ->select('users.*', 'groups.name as group_name')
        ->join('groups', 'users.group_id', '=', 'groups.id')
        ->where('trash', 0);

        $orderBy = 'users.create_at';
        $orderType = 'DESC';

        if(!empty($sortByArr) && is_array($sortByArr)){
            if(!empty($sortByArr['sortBy']) && !empty($sortByArr['sortType'])){
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }

        $users = $users->orderBy($orderBy, $orderType);

        if(!empty($filters)){
            $users = $users->where($filters);
        }

        if(!empty($keywords)){
            $users = $users->where(function($query) use($keywords) {
                $query->orWhere('fullname', 'like', '%'.$keywords.'%');
            });
        }

        if(!empty($perPage)){
            $users = $users->paginate($perPage)->withQueryString(); // 3 bản ghi trên 1 trang
        }else{
            $users = $users->get();
        }

        return $users;
    }

    public function addUser($data){
        // DB::insert('INSERT INTO users (fullname, email, create_at) VALUES (?, ?, ?)', $data);

        return DB::table($this->table)->insert($data);
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' WHERE id=?', [$id]);
    }

    public function updateUser($data, $id){
        // $data[] = $id;

        // return DB::update('UPDATE '.$this->table.' SET fullname=?, email=?, update_at=? WHERE id=?', $data);

        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deleteUser($id){
        // return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
        return DB::table($this->table)->where('id', $id)->delete();
    }

    public function statementUser($sql){
        return DB::statement($sql);
    }

    public function learnQueryBuilder(){
        DB::enableQueryLog();

        // Lấy tất cả bản ghi của table
        // $list = DB::table($this->table)
        // ->select('fullname as hoten', 'email', 'id')
        // ->where('id', 1)
        // ->where(function($query){
        //     $query->where('id', '<', 10);
        //     $query->where('id', '>', 2);
        // })
        // ->whereDate('update_at','2022-04-14')
        // ->get();
        // dd($list);

        // $status = DB::table($this->table)->insert([
        //     'fullname' => 'Nguyễn Văn A',
        //     'email' => 'nguyenvanA@gmail.com',
        //     'create_at' => date('Y-m-d H:i:s'),
        // ]);

        // dd($lastId);

        // $lastId = DB::getPdo()->lastInsertId();
        // dd($status);

        // $lastId = DB::table($this->table)->insertGetId([
        //     'fullname' => 'Nguyễn Văn B',
        //     'email' => 'nguyenvanB@gmail.com',
        //     'create_at' => date('Y-m-d H:i:s'),
        // ]);

        // dd($lastId);

        // $status = DB::table($this->table)
        // ->where('id', 8)
        // ->update([
        //     'fullname' => 'Nguyễn Chí Hiếu',
        //     'email' => 'chihieu@gmail.com',
        //     'update_at' => date('Y-m-d H:i:s'),
        // ]);

        $data = DB::table($this->table)
        // ->select(
        //     DB::raw('fullname, email')
        // )
        // // ->groupBy('email')
        // // ->groupBy('fullname')
        // ->whereRaw('id > ?', [2])
        
        // ->where(
        //     'group_id', '=', function($query){
        //         $query->select('id')
        //         ->from('groups')
        //         ->where('name', '=', 'Administrator');
        //     }
        // )

        ->select('email', DB::raw('(SELECT count(id) FROM `groups`) as group_count'))
        ->get();

        dd($data);

        $sql = DB::getQueryLog();
        dd($sql);

        // Lấy 1 bản ghi đầu tiên của table
        // $detail = DB::table($this->table)->first();
    }
}
