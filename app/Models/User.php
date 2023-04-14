<?php
namespace App\Models;

use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    public $transformer = UserTransformer::class;

    protected $table = 'users';
    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false';

    const permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // datos que se deben de convertir
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // esto es un mutador de laravel, que antes de cada que se le asigna el valor a la propiedad name, el se la asigna en minuscula el valor que llega
    public function setNameAttribute($valor){
        $this->attributes['name'] = strtolower($valor);
    }

     // esto es un mutador de laravel, que antes de cada que se le asigna el valor a la propiedad name, el se la asigna en minuscula el valor que llega
     public function getNameAttribute($valor){
        return  ucwords($valor);
    }

    public function esVerificado(){
        return $this->verified == User::USUARIO_VERIFICADO ? true : false;
    }

    public function esAdministrador(){
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generarVerificationToken(){
        return self::generate_string(User::permitted_chars);
    }

    private static function generate_string ($input, $strength = 100) {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

}
