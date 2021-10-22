<div class="form-section">  
  <form action="/blog/post/new" method="post">
  
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" placeholder="Titre" required="required" value="">
    
    <label for="subTitle">Sous-titre</label>
    <input type="text" name="subTitle" id="subTitle" placeholder="Sous-titre" required="required" value="">
    
    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="15" rows="3" required="required"></textarea>

    <label for="photo">Photo</label>
    <input type="text" name="photo" id="photo" placeholder="Photo" value="">
    
    <button type="submit">Ajouter</button>
  </form>
</div>