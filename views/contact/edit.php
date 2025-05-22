<h2>Edit Contact</h2>

<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <div class="alert success">Contact successfully updated!</div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<form action="/?page=contact&action=update" method="POST" class="form">
    <input type="hidden" name="id" value="<?= $contact->getId() ?>">

    <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" maxlength="255" required
               value="<?= htmlspecialchars($contact->getDescription()) ?>">
    </div>

    <div class="form-group">
        <label for="type">Type:</label>
        <select name="type" id="type" required>
            <option value="">Select type</option>
            <option value="0" <?= $contact->getType() == 0 ? 'selected' : '' ?>>Email</option>
            <option value="1" <?= $contact->getType() == 1 ? 'selected' : '' ?>>Phone</option>
        </select>
    </div>

    <div class="form-group">
        <label for="person_id">Person:</label>
        <select name="person_id" id="person_id" required>
            <option value="">Select a person</option>
            <?php foreach ($people as $person): ?>
                <option value="<?= $person->getId() ?>"
                    <?= $person->getId() == $contact->getPerson()->getId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($person->getName()) ?> (<?= $person->getCpf() ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn">Update</button>
</form>
