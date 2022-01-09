<div class="user-section">
  <h1>Profil de <?= $user->getFullname() ?></h1>
  <div class="mg-top-xl mg-bottom-xl">
    <h2>Description : <?= $user->getDescription() ?></h2>
  </div>
  <a href=<?= '/user/edit' ?> class="btn mg-left-xs">Modifier mon profil</a>
</div>