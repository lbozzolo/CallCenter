@extends('emails.base')

@section('content')


    <!-- === BODY === -->
    <tr>
        <td align="center" valign="top"  bgcolor="#ffffff">
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="em_main_table" style="table-layout:fixed;">

                <tr>
                    <td height="40" class="em_height">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center"><a href="#" target="_blank" style="text-decoration:none;"><img src="{{ asset('/img/logo.png') }}" alt="Logo smartline" width="200px" style="display:block;font-family: Arial, sans-serif; font-size:15px; line-height:18px; color:#30373b;  font-weight:bold;" border="0" alt="LoGo Here" /></a></td>
                </tr>
                <tr>
                    <td height="30" class="em_height">&nbsp;</td>
                </tr>

                <tr>
                    <td height="1" bgcolor="#fed69c" style="font-size:0px; line-height:0px;"><img src="{{ asset('/img/spacer.gif') }}" width="1" height="1" style="display:block;" border="0" alt="" /></td>
                </tr>
                <tr>
                    <td height="14" style="font-size:1px; line-height:1px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="font-family:'Open Sans', Arial, sans-serif; font-size:15px; line-height:18px; color:#30373b; text-transform:uppercase; font-weight:bold;" class="em_font">
                        <a hef="#" target="_blank" style="text-decoration:none; color:#30373b;">Confirmación de Usuario</a>
                    </td>
                </tr>
                <tr>
                    <td height="14" style="font-size:1px; line-height:1px;">&nbsp;</td>
                </tr>
                <tr>
                    <td height="1" bgcolor="#fed69c" style="font-size:0px; line-height:0px;"><img src="{{ asset('/img/spacer.gif') }}" width="1" height="1" style="display:block;" border="0" alt="" /></td>
                </tr>
                <tr>
                    <td valign="top" class="em_aside">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" valign="top">
                                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="10" class="em_space">&nbsp;</td>
                                            <td align="center" valign="top">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="35" class="em_height">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top" style="font-family:'Open Sans', Arial, sans-serif; font-size:20px; line-height:22px; color:#30373b; text-transform:uppercase;">
                                                            Su usuario ha sido confirmado por un administrador.<br>
                                                            A partir de ahora puede ingresar al sistema y operar con normalidad.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="12" style="line-height:1px; font-size:1px;">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td height="40" class="em_height">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="10" class="em_space">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#d8d9da" style="line-height:0px; font-size:0px;"><img src="{{ asset('/img/spacer.gif') }}" width="1" height="1" style="display:block;" border="0" alt="" /></td>
                            </tr>
                            <tr>
                                <td height="30" class="em_height">&nbsp;</td>
                            </tr>

                            <tr>
                                <td height="30" class="em_height">&nbsp;</td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" bgcolor="#feae39">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="10">&nbsp;</td>
                                            <td align="center" valign="top">
                                                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">


                                                    <tr>
                                                        <td height="21" class="em_height">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td height="18" style="line-height:1px; font-size:1px;" class="em_height">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td  align="center"  style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:24px; color:#ffffff; font-style:italic;">
                                                            <p>Haga click en el siguiente link para iniciar sesión</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="23" class="em_height">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top">
                                                            <table width="210" bgcolor="#ffffff" align="center" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td height="45" align="center" valign="middle" style="font-family:'Open Sans', Arial, sans-serif; font-size:17px;color:#feae39; font-weight:bold; text-transform:uppercase;"><a href="{{ route('login') }}" target="_blank" style="text-decoration:none; color:#feae39; line-height:45px; display:block;">Ingrese aqui</a></td>
                                                                </tr>

                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="38" class="em_height">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="10">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="33" class="em_height">&nbsp;</td>
                            </tr>



                            <tr>
                                <td height="42" class="em_height">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- === //BODY === -->


@endsection
