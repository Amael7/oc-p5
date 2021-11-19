<p>Inscription/edit</p>
<div class="form-section"> 
  <form action="/registration" method="post">
    <label for="first_name">Prénom</label>
    <input type="text" name="first_name" id="first_name" placeholder="Prénom" required="required">

    <label for="last_name">Nom de famille</label>
    <input type="text" name="last_name" id="last_name" placeholder="Nom de famille" required="required">
    
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Email" required="required">
    
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required="required">

    <label for="password">Confirmer mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Confirmer mot de passe" required="required">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="15" rows="3" placeholder="Description" required="required"></textarea>
    
    <button type="submit" name="login">Inscription</button>
  </form>
</div>