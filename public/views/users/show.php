<h1>profil de <?= $user->getFullname() ?></h1>
<li><a href=<?= '/blog/user-' . $user->getId() . '/edit' ?> >Modifier mon profil</a></li>