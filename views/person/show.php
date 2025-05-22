<h2>Person Details</h2>

<?php if (!isset($person)): ?>
    <div class="alert error">Person not found.</div>
    <a href="/?page=person" class="btn">← Back to List</a>
    <?php return; ?>
<?php endif; ?>

<div class="person-card">
    <span class="tag">Person</span>
    <div class="person-card-content">
        <h3><?= htmlspecialchars($person->getName()) ?></h3>
        <p><strong>CPF:</strong> <?= htmlspecialchars($person->getCpf()) ?></p>
    </div>
</div>

<div style="margin-top: 20px;">
    <a href="/?page=person" class="btn">← Back to List</a>
    <a href="/?page=person&action=edit&id=<?= $person->getId() ?>" class="btn">Edit</a>
    <a href="/?page=person&action=delete&id=<?= $person->getId() ?>" class="btn" style="background-color: #dc3545;" onclick="return confirm('Are you sure you want to delete this person?');">Delete</a>
</div>
