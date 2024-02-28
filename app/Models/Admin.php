<?php



namespace App\Models;



use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable

{

    use HasApiTokens ;


    protected $guard = 'Admin';

    protected $table = 'admin';


    protected $fillable = [
        'name', 'email', 'password','phone'
    ];



        public function roles()

    {

        return $this->belongsToMany('App\Models\role', 'admin_role', 'admin_id', 'role_id');

    }





  public function hasAnyRole($roles)

  {



    

    if(is_array($roles))

    {

        foreach ($roles as $role) {

            if($this->hasRole($role)){

                return true;

            }

        }

    }else{



        if($this->hasRole($roles)){

            return true;

        }



    }



  }





  public function hasRole($roles){

    if($this->roles()->where('name',$roles)->first()){

        return true;

    }



    return false;

  }





  public static function checkRoles($user,$roles)

  {



    

    if(is_array($roles))

    {

        foreach ($roles as $role) {

            if($user->hasRole($role)){

                return true;

            }

        }

    }else{



        if($user->hasRole($roles)){

            return true;

        }



    }

  }



    use Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */


 



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];

}

