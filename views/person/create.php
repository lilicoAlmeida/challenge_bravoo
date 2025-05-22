<h2>Register New Person</h2>

<?php if (isset($_GET['success']) && $_GET['success'] === '1'): ?>
    <div class="alert success">Person successfully created!</div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert error"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<form action="/?page=person&action=store" method="POST" class="form">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" maxlength="255" required placeholder="Full name">
    </div>

    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required placeholder="000.000.000-00" maxlength="14" oninput="formatCpf(this)">
    </div>

    <button type="submit" class="btn">Save</button>
</form>

<script>
function formatCpf(input) {
    let value = input.value.replace(/\D/g, '').slice(0, 11);
    value = value.replace(/(\\d{3})(\\d)/, '$1.$2');
    value = value.replace(/(\\d{3})(\\d)/, '$1.$2');
    value = value.replace(/(\\d{3})(\\d{1,2})$/, '$1-$2');
    input.value = value;
}
</script>
