<?php



class NavbarTest extends TestCase
{

    //Visualización de links

    public function testUsersLink()
    {
        //Usuario invitado
        $this->visit('/')
            ->dontSee('Usuarios');

        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('/')
            ->see('Usuarios');

        $this->click('Usuarios')
            ->seePageIs('usuarios')
            ->see('USUARIOS habilitados')
            ->see($user->email)
            ->see('buscar')
            ->see('Habilitados')
            ->see('Deshabilitados');

        $this->click('Habilitados')
            ->seePageIs('usuarios');

        $user->delete();

        $this->click('Deshabilitados')
            ->seePageIs('usuarios/deshabilitados')
            ->see($user->email);

        //Elimino el usuario
        $user->restore();
        $user->forceDelete();

    }

    public function testProfileLink()
    {
        //Usuario invitado
        $this->visit('/')
            ->dontSee('Perfil');

        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('/')
            ->see('Mi perfil');

        $this->click('Mi perfil')
            ->seePageIs('perfil/'.$user->id)
            ->see('Mi perfil');

        //Elimino el usuario
        $user->forceDelete();

    }

}