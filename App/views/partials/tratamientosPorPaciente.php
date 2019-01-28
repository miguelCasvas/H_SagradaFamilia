<tr data-idpaciente="<?php echo $data['idPaciente']?>" data-idciudadp="<?php echo $data['id_ciudad']?>">
    <td><?php echo $data['identificacion']?></td>
    <td><?php echo $data['nombresApellidos']?></td>
    <td><?php echo $data['ciudad']?></td>
    <td><?php echo $data['tratamiento']?></td>
    <td>$<?php echo number_format($data['vlrTratamiento'], 0)?></td>
</tr>