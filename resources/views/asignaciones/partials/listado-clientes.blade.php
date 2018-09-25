

<pre>

    ACÁ VA LA TABLA DE CLIENTES (DATOS) --> aparece en el index / desaparece luego de presionado el botón 'aceptar'

    - Nombre del cliente
    - Columna que indique si está asignado o no
    - Operador al que está asignado (si lo estuviese)
    - Columna de tipo (con valores 'pendiente' o 'activo')
    - Columna de 'Última llamada'
    - Checkbox de selección de cliente

    - Botón (arriba o abajo de la tabla) para confirmar los datos seleccionados para asignar.

    - El tbody de la tabla debe tener dentro de sí un formulario que tendrá los clientes.

    <code>

        < table>
            < thead>
                - Código del header de la tabla
            < /thead>
            < tbody>
                < form>
                    < tr>
                        < td>< /td>
                        < td>< /td>
                        < td>< /td>
                        < td> Aquí iría el checkbox < /td>
                    < /tr>
                    < tr>
                        Aquí iría el botón de aceptar (por fuera del foreach)
                    < /tr>
                < /form>
            < /tbody>
        < /table>

    </code>

</pre>

