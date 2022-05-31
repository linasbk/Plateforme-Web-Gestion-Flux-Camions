<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
require __DIR__ . '/../../src/approve.php';
?>

<?php view('header', ['title' => 'Gérer les utilisateurs', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar', ['titre' => 'Gérer les utilisateurs']) ?>





    <?php
    $users = find_users();
    if (users_exist() <= 0) echo "<titre style='margin-top: 8em;;color:#f77d18;'>Aucun résultat trouvée<titre>";
    else {
        echo '
        <table>
        <tr>
            <th>Id</th>
            <th>Nom d\'utilisateur</th>
            <th>E-mail</th>
            <th>Action</th>
        </tr>';
        foreach ($users as $user) {
            $labelname = rand(5, 50000);

            echo '<tr>
                    <td>' . $user["id"] . '</td>
                    <td>' . $user["username"] . '</td>
                    <td>' . $user["email"] . '</td>

                    <td>

                        <form method="post" class="modifier">';

            if (!check_approval($user["id"]))

                echo '<label style="color:red !important" for="' . $labelname . '"><i  class="bi bi-lock">';

            else echo '<label  style="color:green !important"  for="' . $labelname . '"<i class="bi bi-unlock">';

            echo ' </i><input class="ver" type="submit" id="' . $labelname . '" name="submit"></label>
                            <input type="hidden" name="id" value="' . $user["id"] . '">';


            echo '<label for="delete"><i class="bx bxs-trash"></i></label>
                            <input class="trashcan" type="submit" id="delete" name="delete">

                        </form>          

                        </td>';
        }
        echo '</tr>
    
        </table>';
    } ?>

</div>

<?php view('footer') ?>