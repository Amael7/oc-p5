
<?php 
$title = 'Nouvelle Article';
// $form = new App\Models\Form($_POST);
// dump($form->input('title', 'Titre', ['type' => 'text']));
?>
<form action="/blog/post/new" method="post">
  <?php 
    $form->input('title', 'Titre');
    $form->input('subtitle', 'Sous-titre');
    $form->input('content', 'Content');
    $form->input('photo', 'Photo');
    $form->submit('Ajouter');
  ?>
</form>