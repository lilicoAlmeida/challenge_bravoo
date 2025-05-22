<div class="container">
    <h2>Dashboard</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <form method="get" action="/" style="display: flex; gap: 12px; align-items: center;">
            <input type="hidden" name="page" value="home">
            <input type="text"
                   name="search"
                   placeholder="Search people or contacts..."
                   maxlength="255"
                   value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                   style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; min-width: 280px;">
            <button type="submit" class="btn">Search</button>
        </form>

        <a href="/?page=person&action=create" class="btn btn-add">+ Add New Person</a>
    </div>

    <h3>People</h3>
    <div class="card-grid">
        <?php foreach ($people as $person): ?>
            <div class="person-card">
                <span class="tag">Person</span>
                <div class="person-card-content">
                    <p><strong><?= htmlspecialchars($person->getName()) ?></strong></p>
                    <p><strong>CPF:</strong> <?= htmlspecialchars($person->getCpf()) ?></p>
                    <a class="btn btn-view" href="/?page=person&action=show&id=<?= $person->getId() ?>">View</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h3>Contacts</h3>
    <div class="card-grid">
        <?php foreach ($contacts as $contact): ?>
            <div class="person-card">
                <span class="tag">Contact</span>
                <span class="tag"><?= $contact->getType() ? 'Phone' : 'Email' ?></span>
                <div class="person-card-content">
                    <p><strong><?= htmlspecialchars($contact->getDescription()) ?></strong></p>
                    <p><strong>Person:</strong> <?= htmlspecialchars($contact->getPerson()->getName()) ?></p>
                    <a class="btn btn-view" href="/?page=contact&action=show&id=<?= $contact->getId() ?>">View</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
