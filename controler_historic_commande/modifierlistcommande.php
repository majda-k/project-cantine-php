<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col">
            <h2 class="h3">Bonjour <?= $_SESSION['prenom'] ?? 'Client' ?></h2>
        </div>
    </div>
    <!-- fin header -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Informations de commande</h3>
                    <div class="form-group">
                        <label for="plat" class="font-weight-bold">Plat</label>
                        <input type="text" class="form-control" id="plat" name="plat" value="Burger chicken" disabled />
                    </div>
                    <div class="form-group">
                        <label for="heure" class="font-weight-bold">L'Heure</label>
                        <input type="text" class="form-control" id="heure" name="heure" value="12h45" disabled />
                    </div>
                    <div class="form-group">
                        <label for="Qte" class="font-weight-bold">Quantite</label>
                        <input type="text" class="form-control" id="Qte" name="Qte" value="6" disabled />
                    </div>
                    <div class="form-group">
                        <label for="prix" class="font-weight-bold">Prix d'une commande</label>
                        <input type="text" class="form-control" id="prix" name="prix" value="26 MAD" disabled />
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Jour de commande</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="lun" value="Lun" disabled>
                            <label class="form-check-label" for="lun">Lun</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="mar" value="Mar" disabled>
                            <label class="form-check-label" for="mar">Mar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="mer" value="Mer" disabled>
                            <label class="form-check-label" for="mer">Mer</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="jeu" value="Jeu" disabled>
                            <label class="form-check-label" for="jeu">Jeu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="ven" value="Ven" disabled>
                            <label class="form-check-label" for="ven">Ven</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="sam" value="Sam" disabled>
                            <label class="form-check-label" for="sam">Sam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jour" id="dim" value="Dim" disabled>
                            <label class="form-check-label" for="dim">Dim</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Informations Client</h3>
                    <div class="form-group">
                        <label class="font-weight-bold">Nom et Prenom :</label>
                        <span>Amira Kdaouri</span>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Adresse :</label>
                        <span>Hay el Kodess 144 ETG 2 N 23</span>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Numero de telephone</label>
                        <span>0678898778</span>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Changer le Statut de Commande</h3>
                    <form action="your_form_action.php" method="post">
                    <label for="Statut">Choissisez le statut convenable :</label>
                    <select name="Statut" id="statut" class="form-control">
                        <option value="Commande En Cours de preparation">En Cours de preparation</option>
                        <option value="Commande Passer">Commande Passer</option>
                        <option value="Commande Annuler">Commande Annuler</option>
                    </select>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- fin content8 commande employer -->
</div>