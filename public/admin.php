<?php

require __DIR__ . '/../src/bootstrap.php';
require_admin();
require __DIR__ . '/../src/approve.php';
?>

<?php view('header', ['title' => 'Admin']) ?>

<p>hello admin</p>

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
                        <button id="submit" name="submit">approuver</button>
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    </form>

                </td>



            </tr>
    </table>

<?php } ?>
</div>


<?php view('footer') ?>