<h2>Contact Details</h2>

<?php if (!isset($contact)): ?>
    <div class="alert error">Contact not found.</div>
    <a href="/?page=contact" class="btn">← Back to List</a>
    <?php return; ?>
<?php endif; ?>

<div class="person-card">
    <span class="tag"><?= $contact->getType() ? 'Phone' : 'Email' ?></span>
    <div class="person-card-content">
        <h3><?= htmlspecialchars($contact->getDescription()) ?></h3>
        <p><strong>Type:</strong> <?= $contact->getType() ? 'Phone' : 'Email' ?></p>
        <p><strong>Person:</strong> <?= htmlspecialchars($contact->getPerson()->getName()) ?> (<?= $contact->getPerson()->getCpf() ?>)</p>
    </div>
</div>

<div style="margin-top: 20px;">
    <a href="/?page=contact" class="btn">← Back to List</a>
    <a href="/?page=contact&action=edit&id=<?= $contact->getId() ?>" class="btn">Edit</a>
    <a href="/?page=contact&action=delete&id=<?= $contact->getId() ?>" class="btn" style="background-color: #dc3545;" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
</div>
