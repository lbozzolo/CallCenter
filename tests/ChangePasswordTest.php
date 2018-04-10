<?php

class ChangePasswordTest extends TestCase
{

    public function testChangePassword()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('perfil/'.$user->id)
            ->click('Cambiar contraseña')
            ->seePageIs('perfil/'.$user->id.'/password')
            ->see('Cambiar contraseña')
            ->type('123456', 'current_password')
            ->type('newpassword', 'password')
            ->type('newpassword', 'password_confirmation')
            ->press('Cambiar contraseña')
            ->seePageIs('perfil/'.$user->id)
            ->see('Tu contraseña ha sido cambiada exitosamente');

        $user = CallCenter\User::find($user->id);

        $this->assertTrue(
            Hash::check('newpassword', $user->password),
            'No se pudo cambiar la contraseña'
        );

        $user->forceDelete();
    }

}