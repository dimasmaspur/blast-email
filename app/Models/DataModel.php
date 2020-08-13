<?php namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'data_miner';   
    protected $allowedFields = ['user_id','nama','email','barcode','no_undian','terkirim','status'];

    public function getData()
    {
        return $this->findAll();
    }

 
    // public function getDataExist($email){
    //     return $this->where(['email'=>$email])
    // }

    // public function insertToDb(){
    //     $resp = file_get_contents("https://devapi.splashminer.com:8187/api/values/1");
	// 	$setDecode = json_decode($resp, true);



    //     foreach ($setDecode as $key => $value) {

    //         $data = [
    //             'user_id'=> $value['userid'],
    //             'nama'=> $value['nama'],
    //             'email'=> $value['email'],
    //             'barcode'=> $value['barcode'],
    //             'no_undian'=> 0,
    //             'terkirim'=> 0,
    //             'status'=> 0,
    //         ];
            
    //         $this->db->insert('data',$data);
	// 	}
    // }
    

}