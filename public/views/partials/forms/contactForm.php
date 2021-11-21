<p>Vous pouvez me contacter ici</p>
<div class="form-section"> 
  <form action="/contactForm" method="post">
    <label for="visitorName">Votre nom prénom</label>
    <input type="text" name="visitorName" id="visitorName" placeholder="Votre nom prénom" required="required">
    <br>
    <label for="mailObject">Objet</label>
    <input type="text" name="mailObject" id="mailObject" placeholder="Objet" required="required">
    <br>
    <label for="visitorEmail">Votre Email</label>
    <input type="text" name="visitorEmail" id="visitorEmail" placeholder="Votre Email" required="required">
    <br>
    <label for="message">Votre message</label>
    <textarea name="message" id="message" cols="30" rows="7" required="required"></textarea>
    <br>
    
    <button type="submit">Envoyer</button>
  </form>

  <?php if (isset($_SESSION['contactFormSend'])): ?>
    <h2>Email Envoyé</h2>
  <?php endif; ?>
</div>