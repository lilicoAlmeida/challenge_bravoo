<h2>Edit Person</h2>

<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <div class="alert success">Person updated successfully!</div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<form action="/?page=person&action=update" method="POST" class="form">
    <input type="hidden" name="id" value="<?= $person->getId() ?>">

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" maxlength="255" value="<?= htmlspecialchars($person->getName()) ?>" required>
    </div>

    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required maxlength="14" value="<?= htmlspecialchars($person->getCpf()) ?>" oninput="formatCpf(this)">
    </div>

    <button type="submit" class="btn">Update</button>
</form>

<script>
function formatCpf(input) {
    let value = input.value.replace(/\\D/g, '').slice(0, 11);
    value = value.replace(/(\\d{3})(\\d)/, '$1.$2');
    value = value.replace(/(\\d{3})(\\d)/, '$1.$2');
    value = value.replace(/(\\d{3})(\\d{1,2})$/, '$1-$2');
    input.value = value;
}
</script>
