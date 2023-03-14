<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample() : void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Correo electrónico');
        });
    }


//    public function testLogin(): void
//    {
//
//        $user = User::factory()->create([
//            'name' => 'John Doe',
//            'email' => 'johndoe@test.com',
//        ]);
//
//        $this->browse(function (Browser $browser) use ($user){
//            $browser->visit('/login')
//                ->type('email', $user->email)
//                ->type('password', 'password')
//                ->press('Log in')
//                ->assertPathIs('/');
//        });
//    }
}
