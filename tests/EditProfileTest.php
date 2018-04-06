<?php

use Faker\Factory as Faker;

class EditProfileTest extends TestCase
{

    public function testEditProfile()
    {
        $user = $this->createUser();
        $faker = Faker::create();
        $name = $faker->name;
        $lastname = $faker->lastName;
        $email = $faker->email;

        $this->actingAs($user)
            ->visit('perfil/'.$user->id)
            ->click('Editar')
            ->seePageIs('perfil/'.$user->id.'/editar')
            ->see('Editar perfil')
            ->type($name, 'nombre')
            ->type($lastname, 'apellido')
            ->type($email, 'email')
            ->press('Guardar cambios')
            ->seePageIs('perfil/'.$user->id)
            ->see('Se han guardado los cambios con éxito');

        $user = CallCenter\User::find($user->id);

        $this->seeInDatabase('users', ['nombre' => $name]);
        $this->seeInDatabase('users', ['apellido' => $lastname]);
        $this->seeInDatabase('users', ['email' => $email]);

        $user->delete();
    }

}