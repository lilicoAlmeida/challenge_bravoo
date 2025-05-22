<h2>Contact List</h2>

<div class="search-bar">
    <form method="get" action="/" style="display: flex;">
        <input type="hidden" name="page" value="contact">
        <input type="text" name="search" placeholder="Search contacts by person name" maxlength="255"
               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
    </form>
</div>

<a href="/?page=contact&action=create" class="btn">+ Add New Contact</a>

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

<?php if (!isset($_GET['search']) && isset($totalPages) && $totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/?page=contact&pageNum=<?= $i ?>"
               style="margin: 0 5px; padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px;
                      text-decoration: none; <?= ($i == ($_GET['pageNum'] ?? 1)) ? 'background-color:#f24b14;color:white;' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>
