<h2>Person List</h2>

<div class="search-bar">
    <form method="get" action="/" style="display: flex;">
        <input type="hidden" name="page" value="person">
        <input type="text" name="search" placeholder="Search by name" maxlength="255"
               value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
    </form>
</div>

<a href="/?page=person&action=create" class="btn">+ Add New Person</a>

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

<?php if (!isset($_GET['search']) && isset($totalPages) && $totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/?page=person&pageNum=<?= $i ?>"
               style="margin: 0 5px; padding: 6px 12px; border: 1px solid #ccc; border-radius: 4px;
                      text-decoration: none; <?= ($i == ($_GET['pageNum'] ?? 1)) ? 'background-color:#f24b14;color:white;' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>
