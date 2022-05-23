<?php

require __DIR__ . '/../../src/bootstrap.php';
require_admin();
require __DIR__ . '/../../src/approve.php';
?>

<?php view('header', ['title' => 'Gérer les utilisateurs']) ?>


<div class="main">
    <?php view('sidebar') ?>
    <div class="background">
        <div class="contenue">

            <titre>
                <strong>Gérer les utilisateurs</strong>
            </titre>

            <table>

                <tr>
                    <th>Id</th>
                    <th>Nom d'utilisateur</th>
                    <th>E-mail</th>
                    <th>Action</th>

                </tr>

                <?php
                $users = find_unnapproved_users();
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

                                    echo '<label for="' . $labelname . '"><i class="bi bi-lock">';
                                else echo '<label for="' . $labelname . '"<i class="bi bi-unlock">';
                                ?>

                                </i><input class="ver" type="submit" id="<?php echo $labelname ?>" name="submit"></label>
                                <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                            </form>

                        </td>

                    </tr>
                <?php } ?>
            </table>



        </div>


        <?php view('footer') ?>
    </div>
</div>