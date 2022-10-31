<?php $pageName = 'Profil'; ?>
<?php include '../../@/inc/header.php'; ?>

<div class="w-100 p-5 my-6 m-auto bg-light table-responsive rounded-3 h-100">
<h1>Bonjour, <?= $_SESSION['auth']->username ?></h1>
<br>
<h4>Page du Profil</h4>
<br>

<table class="table align-middle ">
  <thead>
    <tr>
      <th scope="col">Prénom</th>
      <th scope="col">Nom</th>
      <th scope="col">Adresse Email</th>
      <th scope="col">Création du compte</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= $_SESSION['auth']->username ?></td>
      <td><?= $_SESSION['auth']->surname ?></td>
      <td><?= $_SESSION['auth']->email ?></td>
      <td class="text-success"><?= $_SESSION['auth']->confirmed_at ?></td>
    </tr>
  </tbody>
</table>
</div>

<?php include '../../@/inc/footer.php'; ?>
