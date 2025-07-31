<div class="fade-in">
    <div class="card-header">
        <h1 class="card-title">
            <i class="fas fa-plus"></i>
            Ajouter un nouveau véhicule
        </h1>
        <div class="table-actions">
            <a href="/admin/cars" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="form-container">
        <form action="/cars" method="POST" class="car-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="marque" class="form-label">
                        <i class="fas fa-tag"></i>
                        Marque *
                    </label>
                    <input 
                        type="text" 
                        id="marque" 
                        name="marque" 
                        class="form-input" 
                        required 
                        maxlength="100"
                        placeholder="Ex: Peugeot, Renault, BMW..."
                    >
                </div>

                <div class="form-group">
                    <label for="modele" class="form-label">
                        <i class="fas fa-car"></i>
                        Modèle *
                    </label>
                    <input 
                        type="text" 
                        id="modele" 
                        name="modele" 
                        class="form-input" 
                        required 
                        maxlength="100"
                        placeholder="Ex: 308, Clio, X3..."
                    >
                </div>

                <div class="form-group">
                    <label for="annee" class="form-label">
                        <i class="fas fa-calendar"></i>
                        Année *
                    </label>
                    <input 
                        type="number" 
                        id="annee" 
                        name="annee" 
                        class="form-input" 
                        required 
                        min="1900" 
                        max="<?= date('Y') + 1 ?>"
                        placeholder="<?= date('Y') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="couleur" class="form-label">
                        <i class="fas fa-palette"></i>
                        Couleur *
                    </label>
                    <input 
                        type="text" 
                        id="couleur" 
                        name="couleur" 
                        class="form-input" 
                        required 
                        maxlength="50"
                        placeholder="Ex: Bleu, Rouge, Noir..."
                    >
                </div>

                <div class="form-group">
                    <label for="immatriculation" class="form-label">
                        <i class="fas fa-id-card"></i>
                        Immatriculation *
                    </label>
                    <input 
                        type="text" 
                        id="immatriculation" 
                        name="immatriculation" 
                        class="form-input" 
                        required 
                        maxlength="20"
                        placeholder="Ex: AB-123-CD"
                        style="text-transform: uppercase;"
                    >
                </div>

                <div class="form-group">
                    <label for="prix" class="form-label">
                        <i class="fas fa-euro-sign"></i>
                        Prix *
                    </label>
                    <input 
                        type="number" 
                        id="prix" 
                        name="prix" 
                        class="form-input" 
                        required 
                        min="0" 
                        step="0.01"
                        placeholder="15000.00"
                    >
                </div>

                <div class="form-group full-width">
                    <label for="status" class="form-label">
                        <i class="fas fa-info-circle"></i>
                        Statut
                    </label>
                    <select id="status" name="status" class="form-input">
                        <option value="disponible" selected>Disponible</option>
                        <option value="vendu">Vendu</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i>
                    Enregistrer le véhicule
                </button>
                <a href="/admin/cars" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.car-form {
    width: 100%;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #374151;
}

.form-input {
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1rem;
    border-top: 1px solid #e5e7eb;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>