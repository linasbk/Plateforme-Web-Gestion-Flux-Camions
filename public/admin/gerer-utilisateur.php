<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
require __DIR__ . '/../../src/approve.php';
?>

<?php view('header', ['title' => 'Gérer les utilisateurs', 'js' => 'vehicule']) ?>


<div class="main">
    <?php view('sidebar', ['titre' => 'Gérer les utilisateurs']) ?>



    <table>

        <tr>
            <th>Id</th>
            <th>Nom d'utilisateur</th>
            <th>E-mail</th>
            <th>Action</th>

        </tr>

        <?php
        $users = find_users();
        foreach ($users as $user) {
        ?>

            <tr>

                <td><?php echo $user['id']; ?></td>
                <td><?php echo  $user['username']; ?></td>
                <td><?php echo  $user['email']; ?></td>

                <td>

                    <form method="post" class="modifier">
                        <?php $labelname = rand(5, 50000);
                        if (!check_approval($user['id']))

                            echo '<label style="color:red !important" for="' . $labelname . '"><i  class="bi bi-lock">';
                        else echo '<label  style="color:green !important"  for="' . $labelname . '"<i class="bi bi-unlock">';
                        ?>

                        </i><input class="ver" type="submit" id="<?php echo $labelname ?>" name="submit"></label>
                        <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">


                        <label for="delete"><i class="bx bxs-trash"></i></label>
                        <input class="trashcan" type="submit" id="delete" name="delete">

                    </form>



                </td>

            </tr>
        <?php } ?>
    </table>

</div>

<?php view('footer') ?>