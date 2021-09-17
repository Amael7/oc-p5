<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
  <div class="main-title">
    <h1>Mon premier blog en PhP!</h1>
  </div>  
  <div class="home-container">
    
    <img src="app/assets/images/pp.jpg" alt="Photo de Profil" style="width: 350px; height: 400px;">
    
    <div class="my-infos">
      
      <h3>Montoro Stéphane</h3>
      
      <p>
        Bonjour Je suis un ancien Boulanger/Pâtissier 
        reconvertis en Développeur web depuis octobre 2019 !
      </p>
      
      <a href="app/assets/pdf/cv.pdf" target="blank">Voici mon C.V</a>
      
      <div class="social_link">
        <h3>Mes Réseaux sociaux</h3>
        <ul>
          <li><a href="https://www.linkedin.com/in/stephane-montoro/" target="blank">Mon LinkedIn</a></li>
          <li><a href="https://github.com/Amael7" target="blank">Mon GitHub</a></li>
          <li><a href="https://twitter.com/MontoroStephane" target="blank">Mon Twitter</a></li>
        </ul>
      </div>
    </div>
  </div>
  
  <div class="contact-form">
    <?php // require('app/views/forms/contact_form.php'); ?>
    <p>le formulaire de contact est à venir !</p>
  </div>
  
<?php $content = ob_get_clean(); ?>

<?php require('app/views/layouts/template.php'); ?>