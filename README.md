# laravel-data-encryption
A trait to encrypt data models in Laravel, this automatically encrypt and decrypt model data overriding getAttribute an setAttribute methods of Eloquent Model.
## How to install
Run composer installation
```bash
    composer require waseem/laravel-data-encryption
```
    
Add ServiceProvider to your app/config.php file
```php
    'providers' => [
        ...
        \Waseem\Encipher\EncipherServiceProvider::class,
    ],
```
Publish configuration file, this will create config/encrypt.php 
```bash
     php artisan vendor:publish --provider=Waseem\Encipher\EncipherServiceProvider
``` 

## How to use

1.  You must add `SECRET_ENCRYPT_KEY` and `ENCRYPT_PREFIX` in your .env file or set it in your `config/encrypt.php` file

2. Use the `Waseem\Encipher\Encipher` trait:
    
    ```php
    use Waseem\Encipher\Encipher;
    ```  
    
3. Set the `$encipher` array on your Model.

    ```php
    protected $encipher = ['encrypted_property'];
    ```
    
4. Here's a complete example:

    ```php
    <?php
    
    namespace App;
    
    use Illuminate\Database\Eloquent\Model;
    use Waseem\Encipher\Encipher;
    
    class User extends Model
    {
    
        use Encipher;
    
        /**
         * The attributes that should be encrypted when stored.
         *
         * @var array
         */
        protected $encipher = [ 'email', 'name' , 'mobile'];
     
        /**
        * Optionally you can define the attributes that should be converted to camelcase when retrieve.
        *
        * @var array
        */
         protected $camelcase = ['name'];
    }
    ```
5. Optional. Encryption your current data

    if your lavarel application version 5.8+

    If you have current data in your database you can encrypt it with the: `php artisan encipher:encryptionModel 'App\Models\User'` command.
    
    Additionally you can decrypt it using the:`php artisan encipher:decryptionModel 'App\Models\User'` command.
    
    Note: You must implement first the `Encipher` trait and set `$encipher` attributes
6. If you are using exists and unique rules with encrypted values replace it with exists_encrypted and unique_encrypted 
    ```php      
   $validator = validator(['email'=>'wasi@demo.com'], ['email'=>'exists_encrypted:users,email']);
    ```
    OR
    ```php      
    $rules=array(
        'email' => 'required|unique_encrypted:users,email'
    );
    $messages=array(
        "email.unique_encrypted"=>"The email has already been taken."
    );
    ```
7. You can still use `where` functions 
   ```php      
   $validator = User::where('email','wasi@demo.com')->first();
   ```
   Automatically `wasi@demo.com` will be encrypted and pass it to the query builder.
   

